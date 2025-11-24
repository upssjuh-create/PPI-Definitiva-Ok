<?php

namespace App\Services;

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;

class MercadoPagoCardService
{
    private $client;
    
    public function __construct()
    {
        $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');
        
        if ($accessToken) {
            MercadoPagoConfig::setAccessToken($accessToken);
            $this->client = new PaymentClient();
        }
    }
    
    /**
     * Cria token do cartão
     */
    public function createCardToken($cardData)
    {
        try {
            \Log::info('=== CRIANDO TOKEN DO CARTÃO ===');
            \Log::info('Dados recebidos:', $cardData);
            
            // Usar SDK do Mercado Pago ao invés de cURL
            $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');
            
            if (!$accessToken) {
                throw new \Exception('MERCADOPAGO_ACCESS_TOKEN não configurado');
            }
            
            \Log::info('Access Token:', ['token' => substr($accessToken, 0, 20) . '...']);
            
            // Usar cURL com Access Token (não Public Key)
            $url = 'https://api.mercadopago.com/v1/card_tokens';
            
            $data = [
                'card_number' => str_replace(' ', '', $cardData['card_number']),
                'cardholder' => [
                    'name' => $cardData['card_name'],
                    'identification' => [
                        'type' => 'CPF',
                        'number' => $this->cleanCPF($cardData['cpf'] ?? '12345678909')
                    ]
                ],
                'security_code' => $cardData['cvv'],
                'expiration_month' => (int) $cardData['expiration_month'],
                'expiration_year' => (int) $cardData['expiration_year']
            ];
            
            \Log::info('Dados formatados:', $data);
            
            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Authorization: Bearer ' . $accessToken
            ]);
            
            $response = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curlError = curl_error($ch);
            curl_close($ch);
            
            if ($curlError) {
                \Log::error('Erro cURL:', ['error' => $curlError]);
                throw new \Exception('Erro de conexão: ' . $curlError);
            }
            
            $result = json_decode($response, true);
            
            \Log::info('Resposta do Mercado Pago:', [
                'http_code' => $httpCode,
                'response' => $result
            ]);
            
            if ($httpCode === 201 && isset($result['id'])) {
                \Log::info('✅ Token criado com sucesso:', ['token' => $result['id']]);
                return [
                    'success' => true,
                    'token' => $result['id'],
                    'payment_method_id' => $result['payment_method_id'] ?? 'visa',
                ];
            }
            
            \Log::error('❌ Erro ao criar token:', [
                'http_code' => $httpCode,
                'response' => $result
            ]);
            
            return [
                'success' => false,
                'error' => $result['message'] ?? 'Erro ao criar token',
                'details' => $result,
            ];
            
        } catch (\Exception $e) {
            \Log::error('Erro ao criar token do cartão', [
                'error' => $e->getMessage(),
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
            ];
        }
    }
    
    /**
     * Processa pagamento com cartão
     */
    public function processCardPayment($amount, $description, $cardData, $payer, $externalReference)
    {
        // Verificar se está em modo teste
        $accessToken = env('MERCADOPAGO_ACCESS_TOKEN');
        $isTestMode = str_starts_with($accessToken, 'TEST-');
        
        // Se estiver em modo teste, simular pagamento
        if ($isTestMode) {
            \Log::info('🧪 MODO TESTE: Simulando pagamento com cartão');
            return $this->simulateCardPayment($amount, $cardData, $externalReference);
        }
        
        // Modo produção: processar pagamento real
        if (!$this->client) {
            throw new \Exception('Mercado Pago não configurado');
        }
        
        try {
            $request = [
                "transaction_amount" => (float) $amount,
                "description" => $description,
                "payment_method_id" => $cardData['payment_method_id'],
                "token" => $cardData['token'],
                "installments" => (int) $cardData['installments'],
                "payer" => [
                    "email" => $payer['email'],
                    "identification" => [
                        "type" => "CPF",
                        "number" => $this->cleanCPF($payer['cpf'] ?? '')
                    ]
                ],
                "external_reference" => $externalReference,
            ];
            
            \Log::info('Processando pagamento com cartão (PRODUÇÃO)', [
                'amount' => $amount,
                'payment_method' => $cardData['payment_method_id'],
            ]);
            
            $payment = $this->client->create($request);
            
            \Log::info('Pagamento processado', [
                'payment_id' => $payment->id,
                'status' => $payment->status,
            ]);
            
            return [
                'success' => true,
                'payment_id' => $payment->id,
                'status' => $payment->status,
                'status_detail' => $payment->status_detail,
                'external_reference' => $payment->external_reference,
            ];
            
        } catch (MPApiException $e) {
            \Log::error('Erro ao processar pagamento com cartão', [
                'message' => $e->getMessage(),
                'status_code' => $e->getApiResponse()->getStatusCode(),
                'content' => $e->getApiResponse()->getContent(),
            ]);
            
            return [
                'success' => false,
                'error' => $e->getMessage(),
                'details' => $e->getApiResponse()->getContent(),
            ];
        }
    }
    
    /**
     * Simula pagamento com cartão em modo teste
     */
    private function simulateCardPayment($amount, $cardData, $externalReference)
    {
        \Log::info('Simulando pagamento', [
            'amount' => $amount,
            'token' => $cardData['token'],
        ]);
        
        // Simular pagamento aprovado
        $paymentId = 'TEST-' . time() . '-' . rand(1000, 9999);
        
        \Log::info('✅ Pagamento simulado aprovado', [
            'payment_id' => $paymentId,
            'amount' => $amount,
        ]);
        
        return [
            'success' => true,
            'payment_id' => $paymentId,
            'status' => 'approved',
            'status_detail' => 'accredited',
            'external_reference' => $externalReference,
            'simulated' => true,
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
