<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PixService;
use App\Services\MercadoPagoPixService;
use Illuminate\Http\Request;

class PixController extends Controller
{
    private $mercadoPagoService;
    
    public function __construct(MercadoPagoPixService $mercadoPagoService)
    {
        $this->mercadoPagoService = $mercadoPagoService;
    }
    
    /**
     * Gera o QR Code PIX para um pagamento
     * Tenta usar Mercado Pago primeiro, se não configurado usa PIX manual
     */
    public function generatePixQRCode($paymentId)
    {
        $payment = Payment::with(['event', 'user', 'registration'])->findOrFail($paymentId);
        
        // Verificar se já foi pago
        if ($payment->status === 'paid') {
            return response()->json([
                'message' => 'Este pagamento já foi processado'
            ], 400);
        }
        
        // Verificar se o usuário é o dono do pagamento
        if ($payment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Você não tem permissão para acessar este pagamento'
            ], 403);
        }
        
        $event = $payment->event;
        $user = $payment->user;
        
        // Tentar usar Mercado Pago se configurado
        if (env('MERCADOPAGO_ACCESS_TOKEN')) {
            return $this->generateMercadoPagoPixQRCode($payment, $event, $user);
        }
        
        // Fallback: PIX manual
        return $this->generateManualPixQRCode($payment, $event);
    }
    
    /**
     * Gera QR Code PIX usando Mercado Pago (REAL)
     */
    private function generateMercadoPagoPixQRCode($payment, $event, $user)
    {
        try {
            \Log::info('Gerando PIX Mercado Pago', [
                'payment_id' => $payment->id,
                'user_id' => $user->id,
                'amount' => $payment->amount,
            ]);
            
            $description = "Inscricao - {$event->title}";
            
            // Preparar dados do pagador
            $payer = [
                'email' => $user->email,
                'first_name' => explode(' ', $user->name)[0] ?? $user->name,
                'last_name' => implode(' ', array_slice(explode(' ', $user->name), 1)) ?: $user->name,
                'cpf' => $user->cpf ?? '00000000000', // CPF padrão se não tiver
            ];
            
            \Log::info('Dados do pagador', $payer);
            
            // Criar pagamento no Mercado Pago
            $result = $this->mercadoPagoService->createPixPayment(
                $payment->amount,
                $description,
                $payer,
                $payment->id // External reference
            );
            
            if (!$result['success']) {
                return response()->json([
                    'message' => 'Erro ao gerar PIX: ' . $result['error']
                ], 500);
            }
            
            // Salvar dados do Mercado Pago no pagamento
            $payment->update([
                'mercadopago_payment_id' => $result['payment_id'],
                'pix_payload' => $result['qr_code'],
                'payment_method' => 'pix',
            ]);
            
            \Log::info('QR Code gerado com sucesso', [
                'payment_id' => $payment->id,
                'mercadopago_payment_id' => $result['payment_id'],
                'has_qr_code_base64' => !empty($result['qr_code_base64']),
            ]);
            
            return response()->json([
                'provider' => 'mercadopago',
                'pix_payload' => $result['qr_code'],
                'qr_code' => $result['qr_code_base64'],
                'payment_id' => $result['payment_id'],
                'amount' => $payment->amount,
                'description' => $description,
                'status' => $result['status'],
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erro ao gerar PIX Mercado Pago', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Erro ao gerar QR Code PIX: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Gera QR Code PIX manual (fallback)
     */
    private function generateManualPixQRCode($payment, $event)
    {
        $paymentConfig = $event->payment_config ?? [];
        
        // Chave PIX (usar a configurada no evento ou uma padrão)
        $pixKey = $paymentConfig['pix_key'] ?? env('PIX_KEY', 'contato@iffar.edu.br');
        $merchantName = $paymentConfig['pix_beneficiary'] ?? env('PIX_BENEFICIARY', 'Instituto Federal Farroupilha');
        $merchantCity = env('PIX_CITY', 'SAO VICENTE DO SUL');
        
        // Descrição do pagamento
        $description = "Inscricao Evento {$event->id}";
        
        // Gerar Transaction ID único
        $txid = PixService::generateTxid();
        
        // Salvar o txid no pagamento
        $payment->update([
            'pix_txid' => $txid,
            'pix_payload' => null,
        ]);
        
        // Gerar payload PIX
        $pixPayload = PixService::generatePixPayload(
            $pixKey,
            $description,
            $merchantName,
            $merchantCity,
            $payment->amount,
            $txid
        );
        
        // Salvar payload
        $payment->update(['pix_payload' => $pixPayload]);
        
        // Gerar QR Code
        $qrCodeBase64 = PixService::generateQRCodeBase64($pixPayload);
        
        return response()->json([
            'provider' => 'manual',
            'pix_payload' => $pixPayload,
            'qr_code' => $qrCodeBase64,
            'txid' => $txid,
            'amount' => $payment->amount,
            'merchant_name' => $merchantName,
        ]);
    }
    
    /**
     * Verifica o status do pagamento PIX
     */
    public function checkPixPaymentStatus($paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        
        // Verificar se o usuário é o dono do pagamento
        if ($payment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'Você não tem permissão para acessar este pagamento'
            ], 403);
        }
        
        // Se tem ID do Mercado Pago, consultar status
        if ($payment->mercadopago_payment_id && env('MERCADOPAGO_ACCESS_TOKEN')) {
            try {
                $result = $this->mercadoPagoService->getPaymentStatus($payment->mercadopago_payment_id);
                
                if ($result['success']) {
                    // Atualizar status local se necessário
                    if ($result['status'] === 'approved' && $payment->status !== 'paid') {
                        $payment->update([
                            'status' => 'paid',
                            'paid_at' => $result['date_approved'],
                        ]);
                        $payment->registration->update(['status' => 'confirmed']);
                    }
                    
                    return response()->json([
                        'status' => $payment->status,
                        'mercadopago_status' => $result['status'],
                        'paid_at' => $payment->paid_at,
                    ]);
                }
            } catch (\Exception $e) {
                \Log::error('Erro ao verificar status do pagamento', [
                    'payment_id' => $payment->id,
                    'error' => $e->getMessage(),
                ]);
            }
        }
        
        // Retornar status local
        return response()->json([
            'status' => $payment->status,
            'paid_at' => $payment->paid_at,
        ]);
    }
    
    /**
     * Webhook do Mercado Pago para notificações de pagamento
     */
    public function mercadoPagoWebhook(Request $request)
    {
        \Log::info('Webhook Mercado Pago recebido', $request->all());
        
        try {
            $result = $this->mercadoPagoService->processWebhookNotification($request->all());
            
            if ($result['success']) {
                return response()->json(['status' => 'ok']);
            }
            
            return response()->json(['error' => $result['message']], 400);
            
        } catch (\Exception $e) {
            \Log::error('Erro ao processar webhook Mercado Pago', [
                'error' => $e->getMessage(),
                'data' => $request->all(),
            ]);
            
            return response()->json(['error' => 'Internal error'], 500);
        }
    }
    
    /**
     * Confirma o pagamento PIX manualmente (apenas para PIX manual)
     */
    public function confirmPixPayment(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);
        
        // Não permitir confirmação manual se for Mercado Pago
        if ($payment->mercadopago_payment_id) {
            return response()->json([
                'message' => 'Este pagamento é processado automaticamente pelo Mercado Pago'
            ], 400);
        }
        
        // Atualizar status do pagamento
        $payment->update([
            'status' => 'paid',
            'paid_at' => now(),
            'payment_method' => 'pix',
        ]);
        
        // Atualizar status da inscrição
        $payment->registration->update(['status' => 'confirmed']);
        
        return response()->json([
            'message' => 'Pagamento confirmado com sucesso',
            'payment' => $payment
        ]);
    }
}
