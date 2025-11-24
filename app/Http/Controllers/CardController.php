<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\MercadoPagoCardService;
use Illuminate\Http\Request;

class CardController extends Controller
{
    private $cardService;
    
    public function __construct(MercadoPagoCardService $cardService)
    {
        $this->cardService = $cardService;
    }
    
    /**
     * Cria token do cartão
     */
    public function createCardToken(Request $request)
    {
        $validated = $request->validate([
            'card_number' => 'required|string',
            'card_name' => 'required|string',
            'expiration_month' => 'required|string',
            'expiration_year' => 'required|string',
            'cvv' => 'required|string',
            'cpf' => 'nullable|string',
        ]);
        
        try {
            $result = $this->cardService->createCardToken($validated);
            
            if ($result['success']) {
                return response()->json([
                    'success' => true,
                    'token' => $result['token'],
                    'payment_method_id' => $result['payment_method_id'],
                ]);
            }
            
            return response()->json([
                'success' => false,
                'error' => $result['error'],
            ], 400);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    
    /**
     * Processa pagamento com cartão
     */
    public function processCardPayment(Request $request, $paymentId)
    {
        $payment = Payment::with(['event', 'user'])->findOrFail($paymentId);
        
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
        
        // Validar dados do cartão
        $validated = $request->validate([
            'token' => 'required|string',
            'payment_method_id' => 'required|string',
            'installments' => 'required|integer|min:1',
        ]);
        
        $event = $payment->event;
        $user = $payment->user;
        
        try {
            $description = "Inscricao - {$event->title}";
            
            // Preparar dados do pagador
            $payer = [
                'email' => $user->email,
                'cpf' => $user->cpf ?? '00000000000',
            ];
            
            // Processar pagamento
            $result = $this->cardService->processCardPayment(
                $payment->amount,
                $description,
                $validated,
                $payer,
                $payment->id
            );
            
            if (!$result['success']) {
                return response()->json([
                    'message' => 'Erro ao processar pagamento',
                    'error' => $result['error'],
                    'details' => $result['details'] ?? null,
                ], 400);
            }
            
            // Atualizar pagamento
            $payment->update([
                'mercadopago_payment_id' => $result['payment_id'],
                'payment_method' => 'pix', // Usar 'pix' ao invés de 'card' para compatibilidade
                'status' => $result['status'] === 'approved' ? 'paid' : 'pending',
                'paid_at' => $result['status'] === 'approved' ? now() : null,
            ]);
            
            // Se aprovado, confirmar inscrição
            if ($result['status'] === 'approved') {
                $payment->registration->update(['status' => 'confirmed']);
            }
            
            return response()->json([
                'success' => true,
                'status' => $result['status'],
                'status_detail' => $result['status_detail'],
                'payment_id' => $result['payment_id'],
                'message' => $result['status'] === 'approved' 
                    ? 'Pagamento aprovado com sucesso!' 
                    : 'Pagamento em processamento',
            ]);
            
        } catch (\Exception $e) {
            \Log::error('Erro ao processar pagamento com cartão', [
                'payment_id' => $payment->id,
                'error' => $e->getMessage(),
            ]);
            
            return response()->json([
                'message' => 'Erro ao processar pagamento: ' . $e->getMessage()
            ], 500);
        }
    }
}
