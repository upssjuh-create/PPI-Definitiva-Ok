<?php
// app/Http/Controllers/CertificateController.php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    // Gerar certificado
    public function generate($registrationId)
    {
        $user = Auth::user();

        $registration = Registration::where('id', $registrationId)
                                   ->where('user_id', $user->id)
                                   ->with(['event', 'user'])
                                   ->firstOrFail();

        // Verificar se fez check-in
        if (!$registration->checked_in) {
            return response()->json([
                'message' => 'Você precisa fazer check-in no evento para gerar o certificado'
            ], 400);
        }

        // Verificar se o evento foi concluído
        if (!$registration->event->is_completed) {
            return response()->json([
                'message' => 'O evento ainda não foi concluído'
            ], 400);
        }

        // Verificar se já existe certificado
        $certificate = Certificate::where('registration_id', $registrationId)->first();

        if ($certificate) {
            return response()->json([
                'message' => 'Certificado já foi gerado',
                'certificate' => $certificate,
            ]);
        }

        // Criar certificado
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'event_id' => $registration->event_id,
            'registration_id' => $registration->id,
        ]);

        // Gerar PDF
        $this->generatePDF($certificate);

        return response()->json([
            'message' => 'Certificado gerado com sucesso',
            'certificate' => $certificate,
        ], 201);
    }

    // Gerar PDF do certificado
    private function generatePDF($certificate)
    {
        $certificate->load(['user', 'event']);

        $pdf = Pdf::loadView('certificates.template', [
            'certificate' => $certificate,
            'user' => $certificate->user,
            'event' => $certificate->event,
        ]);

        $filename = "certificate_{$certificate->id}.pdf";
        $path = "certificates/{$filename}";

        // Salvar PDF
        $pdf->save(storage_path("app/public/{$path}"));

        // Atualizar caminho no banco
        $certificate->update(['pdf_path' => $path]);
    }

    // Download do certificado
    public function download($certificateId)
    {
        $certificate = Certificate::where('id', $certificateId)
                                 ->where('user_id', Auth::id())
                                 ->firstOrFail();

        $path = storage_path("app/public/{$certificate->pdf_path}");

        if (!file_exists($path)) {
            return response()->json(['message' => 'Arquivo não encontrado'], 404);
        }

        return response()->download($path);
    }

    // Validar certificado (público)
    public function validate($code)
    {
        $certificate = Certificate::where('certificate_code', $code)
                                 ->with(['user', 'event'])
                                 ->first();

        if (!$certificate) {
            return response()->json([
                'valid' => false,
                'message' => 'Certificado não encontrado'
            ], 404);
        }

        // Incrementar contador de validações
        $certificate->incrementValidation();

        return response()->json([
            'valid' => true,
            'certificate' => [
                'code' => $certificate->certificate_code,
                'student_name' => $certificate->user->name,
                'event_title' => $certificate->event->title,
                'event_date' => $certificate->event->date,
                'issued_at' => $certificate->issued_at,
                'hours' => $certificate->event->certificate_hours,
            ]
        ]);
    }

    // Meus certificados
    public function myCertificates()
    {
        $certificates = Certificate::where('user_id', Auth::id())
                                  ->with(['event'])
                                  ->orderBy('issued_at', 'desc')
                                  ->get();

        return response()->json($certificates);
    }
}