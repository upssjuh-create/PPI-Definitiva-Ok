<?php

namespace App\Services;

class PixService
{
    /**
     * Gera o payload do PIX (BR Code)
     */
    public static function generatePixPayload($pixKey, $description, $merchantName, $merchantCity, $amount, $txid = null)
    {
        // Payload Format Indicator
        $payload = self::buildEMV('00', '01');
        
        // Merchant Account Information
        $merchantAccount = self::buildEMV('00', 'BR.GOV.BCB.PIX'); // GUI
        $merchantAccount .= self::buildEMV('01', $pixKey); // Chave PIX
        
        if ($txid) {
            $merchantAccount .= self::buildEMV('25', $txid); // Transaction ID
        }
        
        $payload .= self::buildEMV('26', $merchantAccount);
        
        // Merchant Category Code
        $payload .= self::buildEMV('52', '0000');
        
        // Transaction Currency (986 = BRL)
        $payload .= self::buildEMV('53', '986');
        
        // Transaction Amount
        if ($amount > 0) {
            $payload .= self::buildEMV('54', number_format($amount, 2, '.', ''));
        }
        
        // Country Code
        $payload .= self::buildEMV('58', 'BR');
        
        // Merchant Name
        $payload .= self::buildEMV('59', self::sanitizeString($merchantName));
        
        // Merchant City
        $payload .= self::buildEMV('60', self::sanitizeString($merchantCity));
        
        // Additional Data Field
        if ($description) {
            $additionalData = self::buildEMV('05', self::sanitizeString($description));
            $payload .= self::buildEMV('62', $additionalData);
        }
        
        // CRC16
        $payload .= '6304';
        $payload .= self::calculateCRC16($payload);
        
        return $payload;
    }
    
    /**
     * Constrói um campo EMV
     */
    private static function buildEMV($id, $value)
    {
        $length = str_pad(strlen($value), 2, '0', STR_PAD_LEFT);
        return $id . $length . $value;
    }
    
    /**
     * Calcula o CRC16 CCITT
     */
    private static function calculateCRC16($payload)
    {
        $polynomial = 0x1021;
        $crc = 0xFFFF;
        
        $length = strlen($payload);
        for ($i = 0; $i < $length; $i++) {
            $crc ^= (ord($payload[$i]) << 8);
            for ($j = 0; $j < 8; $j++) {
                if (($crc & 0x8000) !== 0) {
                    $crc = (($crc << 1) ^ $polynomial) & 0xFFFF;
                } else {
                    $crc = ($crc << 1) & 0xFFFF;
                }
            }
        }
        
        return strtoupper(dechex($crc));
    }
    
    /**
     * Remove caracteres especiais e limita o tamanho
     */
    private static function sanitizeString($string, $maxLength = 25)
    {
        // Remove acentos
        $string = iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $string);
        
        // Remove caracteres especiais
        $string = preg_replace('/[^A-Za-z0-9 ]/', '', $string);
        
        // Limita o tamanho
        return substr(strtoupper($string), 0, $maxLength);
    }
    
    /**
     * Gera um Transaction ID único
     */
    public static function generateTxid()
    {
        return strtoupper(substr(md5(uniqid(rand(), true)), 0, 25));
    }
    
    /**
     * Gera QR Code usando API pública
     */
    public static function generateQRCodeBase64($pixPayload)
    {
        // Usar API pública para gerar QR Code
        $url = 'https://api.qrserver.com/v1/create-qr-code/?size=300x300&format=png&data=' . urlencode($pixPayload);
        
        try {
            // Tentar baixar a imagem e converter para base64
            $imageData = @file_get_contents($url);
            if ($imageData) {
                return 'data:image/png;base64,' . base64_encode($imageData);
            }
        } catch (\Exception $e) {
            // Se falhar, retornar a URL direta
        }
        
        return $url;
    }
}
