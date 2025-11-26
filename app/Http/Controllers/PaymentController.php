<?php
// app/Http/Controllers/PaymentController.php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    // Processar pagamento PIX
    public function processPix(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Verificar se o pagamento pertence ao usuário
        if ($payment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $validated = $request->validate([
            'pix_key' => 'required|string',
        ]);

        // Aqui você integraria com uma API de pagamento real (ex: Mercado Pago, PagSeguro)
        // Por enquanto, vamos simular

        $transactionId = 'PIX-' . strtoupper(Str::random(10));

        $payment->update([
            'payment_method' => 'pix',
            'transaction_id' => $transactionId,
            'payment_data' => json_encode([
                'pix_key' => $validated['pix_key'],
            ]),
            // Em produção, o status seria 'pending' até confirmar o pagamento
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Confirmar inscrição
        $payment->registration->update(['status' => 'confirmed']);

        return response()->json([
            'message' => 'Pagamento processado com sucesso',
            'payment' => $payment,
        ]);
    }

    // Processar pagamento com cartão
    public function processCard(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        if ($payment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $validated = $request->validate([
            'card_number' => 'required|string',
            'card_name' => 'required|string',
            'card_expiry' => 'required|string',
            'card_cvv' => 'required|string',
            'payment_type' => 'required|in:credit_card,debit_card',
        ]);

        // Aqui você integraria com uma API de pagamento real
        // NUNCA armazene dados completos do cartão!

        $transactionId = 'CARD-' . strtoupper(Str::random(10));

        $payment->update([
            'payment_method' => $validated['payment_type'],
            'transaction_id' => $transactionId,
            'payment_data' => json_encode([
                'card_last_digits' => substr($validated['card_number'], -4),
                'card_name' => $validated['card_name'],
            ]),
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        // Confirmar inscrição
        $payment->registration->update(['status' => 'confirmed']);

        return response()->json([
            'message' => 'Pagamento processado com sucesso',
            'payment' => $payment,
        ]);
    }

    // Confirmar pagamento manualmente (sem validação)
    public function confirmPayment(Request $request, $paymentId)
    {
        $payment = Payment::findOrFail($paymentId);

        // Verificar se o pagamento pertence ao usuário
        if ($payment->user_id !== Auth::id()) {
            return response()->json(['message' => 'Não autorizado'], 403);
        }

        $validated = $request->validate([
            'status' => 'required|in:approved,pending',
            'method' => 'required|in:pix,card',
            'card_data' => 'nullable|array',
        ]);

        $transactionId = strtoupper($validated['method']) . '-' . strtoupper(Str::random(10));

        $payment->update([
            'payment_method' => $validated['method'],
            'transaction_id' => $transactionId,
            'status' => 'paid',
            'paid_at' => now(),
            'payment_data' => json_encode($validated['card_data'] ?? []),
        ]);

        // Confirmar inscrição
        $payment->registration->update(['status' => 'confirmed']);

        return response()->json([
            'message' => 'Pagamento confirmado com sucesso',
            'payment' => $payment,
            'status' => 'approved',
        ]);
    }

    // Webhook para confirmar pagamento (usado por gateways)
    public function webhook(Request $request)
    {
        // Implementar lógica de webhook do gateway de pagamento
        // Exemplo: Mercado Pago, PagSeguro, etc.

        return response()->json(['message' => 'Webhook recebido']);
    }
}