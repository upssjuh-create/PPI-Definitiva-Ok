<?php
/**
 * Script de teste para verificar integração com Mercado Pago
 * 
 * Execute: php test_mercadopago.php
 */

require __DIR__ . '/vendor/autoload.php';

use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Payment\PaymentClient;

// Carregar variáveis de ambiente
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

echo "=== Teste de Integração Mercado Pago ===\n\n";

// Verificar se o token está configurado
$accessToken = $_ENV['MERCADOPAGO_ACCESS_TOKEN'] ?? '';

if (empty($accessToken)) {
    echo "❌ ERRO: MERCADOPAGO_ACCESS_TOKEN não está configurado no .env\n";
    echo "\nPara configurar:\n";
    echo "1. Acesse https://www.mercadopago.com.br/developers\n";
    echo "2. Crie uma aplicação\n";
    echo "3. Copie o Access Token de teste\n";
    echo "4. Adicione no .env: MERCADOPAGO_ACCESS_TOKEN=seu-token-aqui\n";
    exit(1);
}

echo "✅ Token encontrado: " . substr($accessToken, 0, 20) . "...\n\n";

// Configurar SDK
try {
    MercadoPagoConfig::setAccessToken($accessToken);
    echo "✅ SDK configurado com sucesso\n\n";
} catch (Exception $e) {
    echo "❌ Erro ao configurar SDK: " . $e->getMessage() . "\n";
    exit(1);
}

// Testar criação de pagamento PIX
echo "=== Testando Criação de Pagamento PIX ===\n\n";

try {
    $client = new PaymentClient();
    
    $request = [
        "transaction_amount" => 10.00,
        "description" => "Teste de Pagamento PIX - Sistema IFFar",
        "payment_method_id" => "pix",
        "payer" => [
            "email" => "teste@teste.com",
            "first_name" => "Teste",
            "last_name" => "Usuario",
            "identification" => [
                "type" => "CPF",
                "number" => "12345678909"
            ]
        ],
        "external_reference" => "TEST-" . time(),
    ];
    
    echo "Criando pagamento...\n";
    $payment = $client->create($request);
    
    echo "\n✅ Pagamento criado com sucesso!\n\n";
    echo "ID do Pagamento: " . $payment->id . "\n";
    echo "Status: " . $payment->status . "\n";
    echo "Valor: R$ " . number_format($payment->transaction_amount, 2, ',', '.') . "\n";
    
    if (isset($payment->point_of_interaction->transaction_data->qr_code)) {
        echo "\n✅ QR Code gerado com sucesso!\n";
        echo "Código PIX (primeiros 50 caracteres): " . substr($payment->point_of_interaction->transaction_data->qr_code, 0, 50) . "...\n";
        
        // Salvar QR Code em arquivo para teste
        if (isset($payment->point_of_interaction->transaction_data->qr_code_base64)) {
            $qrCodeData = $payment->point_of_interaction->transaction_data->qr_code_base64;
            file_put_contents('qrcode_teste.png', base64_decode($qrCodeData));
            echo "✅ QR Code salvo em: qrcode_teste.png\n";
        }
    }
    
    echo "\n=== Teste Concluído com Sucesso! ===\n";
    echo "\nO sistema está pronto para processar pagamentos PIX reais.\n";
    echo "Para usar em produção, substitua o token de teste pelo token de produção.\n";
    
} catch (Exception $e) {
    echo "\n❌ Erro ao criar pagamento: " . $e->getMessage() . "\n";
    
    if (method_exists($e, 'getApiResponse')) {
        $response = $e->getApiResponse();
        echo "\nDetalhes do erro:\n";
        echo "Status Code: " . $response->getStatusCode() . "\n";
        echo "Conteúdo: " . json_encode($response->getContent(), JSON_PRETTY_PRINT) . "\n";
    }
    
    exit(1);
}
