<?php
// app/Http/Controllers/AdminController.php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\User;
use App\Models\Registration;
use App\Models\Payment;
use App\Models\Cancellation;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Dashboard - Estatísticas gerais
    public function dashboard()
    {
        $stats = [
            'total_events' => Event::count(),
            'active_events' => Event::where('is_active', true)->where('is_completed', false)->count(),
            'completed_events' => Event::where('is_completed', true)->count(),
            'total_users' => User::whereIn('user_type', ['aluno', 'servidor_iffar', 'externo'])->count(),
            'total_registrations' => Registration::where('status', 'confirmed')->count(),
            'total_revenue' => Payment::where('status', 'paid')->sum('amount'),
            'paid_events' => Event::where('price', '>', 0)->count(),
        ];

        $recent_events = Event::withCount('registrations')
                             ->orderBy('created_at', 'desc')
                             ->limit(5)
                             ->get();

        return response()->json([
            'stats' => $stats,
            'recent_events' => $recent_events
        ]);
    }

    // Buscar inscrições de um evento
    public function getEventRegistrations($eventId)
    {
        $event = Event::findOrFail($eventId);
        
        $registrations = Registration::where('event_id', $eventId)
            ->where('status', '!=', 'cancelled')
            ->with(['user', 'payment', 'certificate'])
            ->get();

        return response()->json($registrations);
    }

    // Detalhes de evento concluído para admin
    public function completedEventDetails($eventId)
    {
        $event = Event::with([
            'registrations.user',
            'registrations.payment',
            'registrations.certificate'
        ])->findOrFail($eventId);

        // Formatar dados dos estudantes
        $students = $event->registrations->map(function($registration) use ($event) {
            $payment = $registration->payment;

            return [
                'id' => $registration->user->id,
                'name' => $registration->user->name,
                'email' => $registration->user->email,
                'registration_number' => $registration->user->registration_number,
                'course' => $registration->user->course,
                'semester' => $registration->user->semester,
                'payment_status' => $payment ? $payment->status : ($event->isFree() ? 'paid' : 'not_paid'),
                'checked_in' => $registration->checked_in,
                'check_in_time' => $registration->check_in_time,
                'certificate_issued' => $registration->certificate ? true : false,
                'certificate_code' => $registration->certificate ? $registration->certificate->certificate_code : null,
            ];
        });

        return response()->json([
            'event' => $event,
            'students' => $students,
            'statistics' => [
                'total_registered' => $students->count(),
                'total_present' => $students->where('checked_in', true)->count(),
                'total_absent' => $students->where('checked_in', false)->count(),
                'total_paid' => $students->where('payment_status', 'paid')->count(),
                'total_pending' => $students->where('payment_status', 'pending')->count(),
                'total_not_paid' => $students->where('payment_status', 'not_paid')->count(),
                'certificates_issued' => $students->where('certificate_issued', true)->count(),
            ]
        ]);
    }

    // Marcar evento como concluído
    public function completeEvent($eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->update(['is_completed' => true]);

        return response()->json([
            'message' => 'Evento marcado como concluído',
            'event' => $event,
        ]);
    }

    // Exportar relatório CSV
    public function exportReport($eventId)
    {
        $event = Event::with(['registrations.user', 'registrations.payment'])
                     ->findOrFail($eventId);

        $filename = "evento_{$event->id}_relatorio.csv";
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function() use ($event) {
            $file = fopen('php://output', 'w');

            // Cabeçalhos CSV
            fputcsv($file, [
                'Nome',
                'Matrícula',
                'Email',
                'Curso',
                'Semestre',
                'Status Pagamento',
                'Check-in',
                'Horário Check-in',
                'Certificado Emitido',
                'Código Certificado'
            ]);

            // Dados
            foreach ($event->registrations as $registration) {
                $payment = $registration->payment;

                fputcsv($file, [
                    $registration->user->name,
                    $registration->user->registration_number,
                    $registration->user->email,
                    $registration->user->course,
                    $registration->user->semester,
                    $payment ? $payment->status : ($event->isFree() ? 'Gratuito' : 'Não Pago'),
                    $registration->checked_in ? 'Sim' : 'Não',
                    $registration->check_in_time ? $registration->check_in_time->format('d/m/Y H:i') : '',
                    $registration->certificate ? 'Sim' : 'Não',
                    $registration->certificate ? $registration->certificate->certificate_code : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Listar cancelamentos
    public function cancellations()
    {
        $cancellations = Cancellation::with(['user', 'event', 'registration'])
                                    ->orderBy('created_at', 'desc')
                                    ->get();

        return response()->json($cancellations);
    }

    // Aprovar cancelamento
    public function approveCancellation($cancellationId)
    {
        $cancellation = Cancellation::findOrFail($cancellationId);
        
        // Atualizar status do cancelamento
        $cancellation->update(['status' => 'approved']);

        // Cancelar a inscrição
        $registration = Registration::find($cancellation->registration_id);
        if ($registration) {
            $registration->update(['status' => 'cancelled']);
        }

        return response()->json([
            'message' => 'Cancelamento aprovado com sucesso',
            'cancellation' => $cancellation
        ]);
    }

    // Rejeitar cancelamento
    public function rejectCancellation($cancellationId)
    {
        $cancellation = Cancellation::findOrFail($cancellationId);
        
        $cancellation->update(['status' => 'rejected']);

        return response()->json([
            'message' => 'Cancelamento rejeitado',
            'cancellation' => $cancellation
        ]);
    }
}