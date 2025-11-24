<?php

namespace App\Http\Controllers;

use App\Models\Certificate;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class CertificateController extends Controller
{
    /**
     * Gerar certificado para uma inscrição
     */
    public function generate(Request $request, $registrationId)
    {
        $user = Auth::user();
        
        $registration = Registration::where('id', $registrationId)
            ->where('user_id', $user->id)
            ->with(['event', 'certificate'])
            ->firstOrFail();
        
        // Verificar se já fez check-in
        if (!$registration->checked_in) {
            return response()->json([
                'message' => 'Você precisa fazer check-in no evento antes de gerar o certificado'
            ], 400);
        }
        
        // Verificar se já existe certificado
        if ($registration->certificate) {
            return response()->json([
                'message' => 'Certificado já foi gerado',
                'certificate' => $registration->certificate
            ]);
        }
        
        // Criar certificado
        $certificate = Certificate::create([
            'user_id' => $user->id,
            'event_id' => $registration->event_id,
            'registration_id' => $registration->id,
        ]);
        
        return response()->json([
            'message' => 'Certificado gerado com sucesso',
            'certificate' => $certificate
        ], 201);
    }
    
    /**
     * Listar certificados do usuário
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        
        $certificates = Certificate::where('user_id', $user->id)
            ->with(['event', 'registration'])
            ->orderBy('issued_at', 'desc')
            ->get();
        
        return response()->json($certificates);
    }
    
    /**
     * Detalhes de um certificado
     */
    public function show($id)
    {
        // Buscar certificado com assinaturas
        $certificate = Certificate::where('id', $id)
            ->with(['event.signature1', 'event.signature2', 'registration', 'user'])
            ->firstOrFail();
        
        // Se for requisição API, verificar autenticação
        if (request()->expectsJson()) {
            $user = Auth::user();
            
            // Verificar se o certificado pertence ao usuário autenticado
            if (!$user || $certificate->user_id !== $user->id) {
                return response()->json([
                    'message' => 'Não autorizado'
                ], 403);
            }
            
            // Adicionar informações formatadas
            $certificate->formatted_date = $certificate->event->date->format('d/m/Y');
            $certificate->formatted_issued_at = $certificate->issued_at->format('d/m/Y');
            
            return response()->json($certificate);
        }
        
        // Para requisições web, permitir visualização (certificado é público)
        // Formatar data em português para a view
        $meses = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];
        
        $dia = $certificate->event->date->format('d');
        $mes = $meses[(int)$certificate->event->date->format('m')];
        $ano = $certificate->event->date->format('Y');
        $dataFormatada = "$dia de $mes de $ano";
        
        // Se for requisição web, retornar view
        return view('certificate', compact('certificate', 'dataFormatada'));
    }
    
    /**
     * Download do certificado (PDF)
     */
    public function download($id)
    {
        // Buscar certificado com assinaturas (permitir acesso público)
        $certificate = Certificate::where('id', $id)
            ->with(['event.signature1', 'event.signature2', 'user'])
            ->firstOrFail();
        
        // Debug: Verificar se as assinaturas foram carregadas
        \Log::info('=== CERTIFICADO DEBUG ===', [
            'event_id' => $certificate->event_id,
            'signature1_id' => $certificate->event->signature1_id,
            'signature2_id' => $certificate->event->signature2_id,
            'signature1_loaded' => $certificate->event->signature1 ? true : false,
            'signature2_loaded' => $certificate->event->signature2 ? true : false,
            'signature1_path' => $certificate->event->signature1 ? $certificate->event->signature1->image_path : null,
            'signature2_path' => $certificate->event->signature2 ? $certificate->event->signature2->image_path : null,
        ]);
        
        // Incrementar contador de validação
        $certificate->incrementValidation();
        
        // Formatar data em português
        $meses = [
            1 => 'Janeiro', 2 => 'Fevereiro', 3 => 'Março', 4 => 'Abril',
            5 => 'Maio', 6 => 'Junho', 7 => 'Julho', 8 => 'Agosto',
            9 => 'Setembro', 10 => 'Outubro', 11 => 'Novembro', 12 => 'Dezembro'
        ];
        
        $dia = $certificate->event->date->format('d');
        $mes = $meses[(int)$certificate->event->date->format('m')];
        $ano = $certificate->event->date->format('Y');
        $dataFormatada = "$dia de $mes de $ano";
        
        // Configurar PDF com orientação paisagem ANTES de carregar a view
        $pdf = Pdf::setOption('isHtml5ParserEnabled', true)
                  ->setOption('isRemoteEnabled', true)
                  ->setPaper([0, 0, 841.89, 595.28], 'landscape') // A4 paisagem em pontos
                  ->loadView('certificate-pdf', compact('certificate', 'dataFormatada'));
        
        // Nome do arquivo
        $fileName = 'Certificado_' . str_replace(' ', '_', $certificate->user->name) . '_' . $certificate->certificate_code . '.pdf';
        
        // Retornar PDF para download
        return $pdf->download($fileName);
    }
    
    /**
     * Validar certificado por código
     */
    public function validate($code)
    {
        $certificate = Certificate::where('certificate_code', strtoupper($code))
            ->with(['event', 'user'])
            ->first();
        
        if (!$certificate) {
            return response()->json([
                'valid' => false,
                'message' => 'Certificado não encontrado'
            ], 404);
        }
        
        // Incrementar contador de validação
        $certificate->incrementValidation();
        
        return response()->json([
            'valid' => true,
            'certificate' => $certificate
        ]);
    }
}
