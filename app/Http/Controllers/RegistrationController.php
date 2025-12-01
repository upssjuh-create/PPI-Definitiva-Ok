<?php
// app/Http/Controllers/RegistrationController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Registration;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    // Inscrever-se em um evento
    public function register(Request $request, $eventId)
    {
        $user = Auth::user();
        $event = Event::findOrFail($eventId);

        // Verificar se ainda há vagas
        if (!$event->hasAvailableSpots()) {
            return response()->json([
                'message' => 'Não há mais vagas disponíveis para este evento'
            ], 400);
        }

        // Verificar se já está inscrito
        $existingRegistration = Registration::where('user_id', $user->id)
                                           ->where('event_id', $eventId)
                                           ->first();

        if ($existingRegistration) {
            return response()->json([
                'message' => 'Você já está inscrito neste evento'
            ], 400);
        }

        // Criar inscrição
        $registration = Registration::create([
            'user_id' => $user->id,
            'event_id' => $eventId,
            'status' => $event->isFree() ? 'confirmed' : 'pending',
        ]);

        // Log para debug
        \Log::info('Criando inscrição', [
            'event_id' => $eventId,
            'event_price' => $event->price,
            'is_free' => $event->isFree(),
            'registration_id' => $registration->id,
        ]);

        // Se o evento for pago, criar registro de pagamento
        $payment = null;
        if (!$event->isFree()) {
            $payment = Payment::create([
                'registration_id' => $registration->id,
                'user_id' => $user->id,
                'event_id' => $eventId,
                'amount' => $event->price,
                'status' => 'pending',
            ]);
            
            \Log::info('Pagamento criado', [
                'payment_id' => $payment->id,
                'amount' => $payment->amount,
            ]);
        } else {
            \Log::info('Evento gratuito - pagamento não criado');
        }

        // Carregar relacionamentos
        $registration->load('event');
        
        return response()->json([
            'message' => 'Inscrição realizada com sucesso',
            'registration' => $registration,
            'payment' => $payment,
        ], 201);
    }

    // Check-in no evento com validação de código
    public function checkInWithCode(Request $request, $eventId)
    {
        $validated = $request->validate([
            'check_in_code' => 'required|string',
        ]);

        $user = Auth::user();
        $event = Event::findOrFail($eventId);

        // Validar o código do evento
        if ($event->check_in_code !== $validated['check_in_code']) {
            return response()->json([
                'message' => 'Código de check-in inválido para este evento'
            ], 400);
        }

        // Buscar inscrição do usuário neste evento
        $registration = Registration::where('user_id', $user->id)
                                   ->where('event_id', $eventId)
                                   ->where('status', 'confirmed')
                                   ->with(['user', 'event'])
                                   ->first();

        if (!$registration) {
            return response()->json([
                'message' => 'Você não está inscrito neste evento ou sua inscrição não foi confirmada'
            ], 404);
        }

        if ($registration->checked_in) {
            return response()->json([
                'message' => 'Check-in já realizado anteriormente',
                'check_in_time' => $registration->check_in_time,
            ], 400);
        }

        // Realizar check-in
        $registration->update([
            'checked_in' => true,
            'check_in_time' => now(),
        ]);

        return response()->json([
            'message' => 'Check-in realizado com sucesso',
            'registration' => $registration,
            'event' => $event,
        ]);
    }

    // Check-in no evento (método antigo - mantido para compatibilidade)
    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'check_in_code' => 'required|string',
            'registration_id' => 'nullable|integer',
        ]);

        $user = Auth::user();
        
        if (isset($validated['registration_id'])) {
            $registration = Registration::where('id', $validated['registration_id'])
                                       ->where('user_id', $user->id)
                                       ->with(['user', 'event'])
                                       ->first();
        } else {
            $registration = Registration::where('user_id', $user->id)
                                       ->where('checked_in', false)
                                       ->with(['user', 'event'])
                                       ->orderBy('created_at', 'desc')
                                       ->first();
        }

        if (!$registration) {
            return response()->json([
                'message' => 'Nenhuma inscrição encontrada para fazer check-in'
            ], 404);
        }

        if ($registration->checked_in) {
            return response()->json([
                'message' => 'Check-in já realizado anteriormente',
                'check_in_time' => $registration->check_in_time,
            ], 400);
        }

        $registration->update([
            'checked_in' => true,
            'check_in_time' => now(),
        ]);

        return response()->json([
            'message' => 'Check-in realizado com sucesso',
            'registration' => $registration,
        ]);
    }

    // Minhas inscrições
    public function myRegistrations(Request $request)
    {
        $user = Auth::user();

        $registrations = Registration::where('user_id', $user->id)
                                    ->where('status', '!=', 'cancelled')
                                    ->with(['event', 'payment', 'certificate'])
                                    ->orderBy('created_at', 'desc')
                                    ->get()
                                    ->map(function($registration) {
                                        // Adicionar payment_status calculado
                                        if ($registration->payment) {
                                            $registration->payment_status = $registration->payment->status;
                                        } else if ($registration->event && $registration->event->price == 0) {
                                            $registration->payment_status = 'paid'; // Evento gratuito
                                        } else {
                                            $registration->payment_status = 'not_paid';
                                        }
                                        
                                        return $registration;
                                    });

        return response()->json($registrations);
    }

    // Cancelar inscrição
    public function cancel(Request $request, $registrationId)
    {
        $user = Auth::user();

        $registration = Registration::where('id', $registrationId)
                                   ->where('user_id', $user->id)
                                   ->with('event')
                                   ->firstOrFail();

        $validated = $request->validate([
            'reason' => 'nullable|string|max:1000',
        ]);

        // Criar registro de cancelamento para o admin ver
        $cancellation = \App\Models\Cancellation::create([
            'registration_id' => $registration->id,
            'user_id' => $user->id,
            'event_id' => $registration->event_id,
            'reason' => $validated['reason'] ?? null,
            'status' => 'approved', // Já aprovado automaticamente
        ]);

        // Cancelar a inscrição imediatamente
        $registration->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Inscrição cancelada com sucesso',
            'cancellation' => $cancellation
        ]);
    }
}