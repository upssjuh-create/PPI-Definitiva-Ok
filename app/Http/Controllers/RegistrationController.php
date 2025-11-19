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

        // Se o evento for pago, criar registro de pagamento
        if (!$event->isFree()) {
            Payment::create([
                'registration_id' => $registration->id,
                'user_id' => $user->id,
                'event_id' => $eventId,
                'amount' => $event->price,
                'status' => 'pending',
            ]);
        }

        return response()->json([
            'message' => 'Inscrição realizada com sucesso',
            'registration' => $registration->load(['event', 'payment']),
        ], 201);
    }

    // Check-in no evento
    public function checkIn(Request $request)
    {
        $validated = $request->validate([
            'check_in_code' => 'required|string',
        ]);

        $registration = Registration::where('check_in_code', $validated['check_in_code'])
                                   ->with(['user', 'event'])
                                   ->first();

        if (!$registration) {
            return response()->json([
                'message' => 'Código de check-in inválido'
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
        ]);
    }

    // Minhas inscrições
    public function myRegistrations(Request $request)
    {
        $user = Auth::user();

        $registrations = Registration::where('user_id', $user->id)
                                    ->with(['event', 'payment', 'certificate'])
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return response()->json($registrations);
    }

    // Cancelar inscrição
    public function cancel($registrationId)
    {
        $user = Auth::user();

        $registration = Registration::where('id', $registrationId)
                                   ->where('user_id', $user->id)
                                   ->firstOrFail();

        $registration->update(['status' => 'cancelled']);

        return response()->json([
            'message' => 'Inscrição cancelada com sucesso'
        ]);
    }
}