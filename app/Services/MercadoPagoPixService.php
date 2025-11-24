<?php

namespace App\Services;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;

class MercadoPagoPixService
{
    private $client;
    
    public function __construct()
    {
        // Configurar SDK do Mercado Pago
        $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');
        
        if ($accessToken) {
            MercadoPagoConfig::setAccessToken($accessToken);
            $this->client = new PaymentClient();
        }
    }
    
    /**
     * Cria um pagamento PIX no Mercado Pago
     * 
     * @param float $amount Valor do pagamento
     * @param string $description Descrição do pagamento
     * @param array $payer Dados do pagador (email, cpf, nome)
     * @param string $externalReference Referência externa (ID do pagamento no sistema)
     * @return array Dados do pagamento incluindo QR Code
     */
    public function createPixPayment($amount, $description, $payer, $externalReference)
    {
        if (!$this->client) {
            throw new \Exception('Mercado Pago não configurado. Configure MERCADOPAGO_ACCESS_TOKEN no .env');
        }
        
        try {
            $request = [
                "transaction_amount" => (float) $amount,
                "description" => $description,
                "payment_method_id" => "pix",
                "payer" => [
                    "email" => $payer['email'],
                    "first_name" => $payer['first_name'] ?? '',
                    "last_name" => $payer['last_name'] ?? '',
                    "identification" => [
                        "type" => "CPF",
                        "number" => $this->cleanCPF($payer['cpf'] ?? '')
                    ]
                ],
                "external_reference" => $externalReference,
            ];
            
            // Adicionar notification_url apenas se não for localhost
            $webhookUrl = route('mercadopago.webhook');
            if (!str_contains($webhookUrl, 'localhost') && !str_contains($webhookUrl, '127.0.0.1')) {
                $request["notification_url"] = $webhookUrl;
            }
            
            $payment = $this->client->create($request);
            
            return [
                'success' => true,
                'payment_id' => $payment->id,
                'status' => $payment->status,
                'qr_code' => $payment->point_of_interaction->transaction_data->qr_code ?? null,
                'qr_code_base64' => $payment->point_of_interaction->transaction_data->qr_code_base64 ?? null,
                'ticket_url' => $payment->point_of_interaction->transaction_data->ticket_url ?? null,
                'external_reference' => $payment->external_reference,
            ];
            
        } catch (MPApiException $e) {
            \Log::error('Erro ao criar pagamento PIX no Mercado Pago', [
                'message' => $e->getMessage(),
                'status_code' => $e->getApiResponse()->getStatusCode(),
                'content' => $e->getApiResponse()->getContent(),
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
    
    /**
     * Consulta o status de um pagamento no Mercado Pago
     * 
     * @param string $paymentId ID do pagamento no Mercado Pago
     * @return array Status do pagamento
     */
    public function getPaymentStatus($paymentId)
    {
        if (!$this->client) {
            throw new \Exception('Mercado Pago não configurado');
        }
        
        try {
            $payment = $this->client->get($paymentId);
            
            return [
                'success' => true,
                'payment_id' => $payment->id,
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'external_reference' => $payment->external_reference,
                'transaction_amount' => $payment->transaction_amount,
                'date_approved' => $payment->date_approved,
            ];
            
        } catch (MPApiException $e) {
            \Log::error('Erro ao consultar pagamento no Mercado Pago', [
                'payment_id' => $paymentId,
                'message' => $e->getMessage(),
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
    
    /**
     * Processa notificação do webhook do Mercado Pago
     * 
     * @param array $data Dados da notificação
     * @return array Resultado do processamento
     */
    public function processWebhookNotification($data)
    {
        if (!isset($data['type']) || $data['type'] !== 'payment') {
            return ['success' => false, 'message' => 'Tipo de notificação não suportado'];
        }
        
        $paymentId = $data['data']['id'] ?? null;
        
        if (!$paymentId) {
            return ['success' => false, 'message' => 'ID do pagamento não encontrado'];
        }
        
        // Consultar status do pagamento
        $paymentStatus = $this->getPaymentStatus($paymentId);
        
        if (!$paymentStatus['success']) {
            return $paymentStatus;
        }
        
        // Buscar pagamento no banco pelo external_reference
        $externalReference = $paymentStatus['external_reference'];
        $payment = \App\Models\Payment::where('id', $externalReference)
            ->orWhere('mercadopago_payment_id', $paymentId)
            ->first();
        
        if (!$payment) {
            return ['success' => false, 'message' => 'Pagamento não encontrado no sistema'];
        }
        
        // Atualizar status do pagamento
        $payment->mercadopago_payment_id = $paymentId;
        
        switch ($paymentStatus['status']) {
            case 'approved':
                $payment->status = 'paid';
                $payment->paid_at = $paymentStatus['date_approved'];
                $payment->registration->update(['status' => 'confirmed']);
                break;
                
            case 'pending':
            case 'in_process':
                $payment->status = 'pending';
                break;
                
            case 'rejected':
            case 'cancelled':
                $payment->status = 'failed';
                break;
        }
        
        $payment->save();
        
        return [
            'success' => true,
            'payment_id' => $payment->id,
            'status' => $payment->status,
        ];
    }
    
    /**
     * Remove caracteres não numéricos do CPF
     */
    private function cleanCPF($cpf)
    {
        return preg_replace('/[^0-9]/', '', $cpf);
    }
}
