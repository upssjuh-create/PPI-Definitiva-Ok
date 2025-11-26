#!/bin/bash

# Script para configurar variáveis de ambiente no Laravel Cloud
# Execute este script no console do Laravel Cloud

echo "Configurando variáveis de ambiente..."

# Criar arquivo .env se não existir
if [ ! -f /var/www/html/.env ]; then
    cp /opt/cloud/.env /var/www/html/.env
fi

# Adicionar credenciais do Mercado Pago
echo "" >> /var/www/html/.env
echo "# Mercado Pago" >> /var/www/html/.env
echo 'MERCADOPAGO_ACCESS_TOKEN="TEST-3033510884619750-112209-2fdc55d6e45ccf37429992fcf939af05-1287921494"' >> /var/www/html/.env
echo 'MERCADOPAGO_PUBLIC_KEY="TEST-4706a818-2652-42a5-b8e5-84e72110d6af"' >> /var/www/html/.env

# Limpar cache
php artisan config:clear
php artisan cache:clear

echo "Variáveis configuradas com sucesso!"
