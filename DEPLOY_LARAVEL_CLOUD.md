# Como Configurar o Banco de Dados no Laravel Cloud

## Problema
O Laravel Cloud não permite editar as variáveis de ambiente diretamente pelo dashboard.

## Solução

### Opção 1: Via Laravel Cloud CLI (Recomendado)

1. Instale o Laravel Cloud CLI:
```bash
composer global require laravel/cloud-cli
```

2. Faça login:
```bash
laravel-cloud login
```

3. Configure as variáveis de ambiente:
```bash
laravel-cloud env:set DB_CONNECTION=sqlite
laravel-cloud env:set QUEUE_CONNECTION=sync
laravel-cloud env:set CACHE_STORE=file
laravel-cloud env:set SERVER_CODE_SECRETO=ServidorIFFAR2025
laravel-cloud env:set PIX_BENEFICIARY="Instituto Federal Farroupilha"
laravel-cloud env:set PIX_CITY="SAO VICENTE DO SUL"
```

4. Execute as migrations:
```bash
laravel-cloud command "php artisan migrate --force"
```

### Opção 2: Via Dashboard (se disponível)

Alguns planos do Laravel Cloud permitem adicionar variáveis pelo dashboard:

1. Acesse o projeto no Laravel Cloud
2. Procure por **"Environment"** ou **"Settings"**
3. Adicione uma por uma:
   - `DB_CONNECTION` = `sqlite`
   - `QUEUE_CONNECTION` = `sync`
   - `CACHE_STORE` = `file`
   - `SERVER_CODE_SECRETO` = `ServidorIFFAR2025`

### Opção 3: Via Arquivo .env no Repositório (NÃO RECOMENDADO)

⚠️ **Não é seguro**, mas funciona para testes:

1. Copie o arquivo `.env.cloud` para `.env`
2. Commit e push:
```bash
git add .env
git commit -m "Add production env"
git push
```

⚠️ **ATENÇÃO:** Isso expõe suas credenciais no GitHub!

### Opção 4: Usar MySQL do Laravel Cloud

Se o Laravel Cloud oferece MySQL:

1. No dashboard, vá em **Database** ou **Resources**
2. Crie um banco de dados MySQL
3. Copie as credenciais fornecidas
4. Configure via CLI:
```bash
laravel-cloud env:set DB_CONNECTION=mysql
laravel-cloud env:set DB_HOST=<host-fornecido>
laravel-cloud env:set DB_PORT=3306
laravel-cloud env:set DB_DATABASE=<nome-do-banco>
laravel-cloud env:set DB_USERNAME=<usuario>
laravel-cloud env:set DB_PASSWORD=<senha>
```

## Executar Migrations

Depois de configurar o banco, execute:

```bash
# Via CLI
laravel-cloud command "php artisan migrate --force"

# Ou via SSH (se disponível)
laravel-cloud ssh
php artisan migrate --force
```

## Verificar se Funcionou

```bash
laravel-cloud command "php artisan migrate:status"
```

## Troubleshooting

### "Command not found: laravel-cloud"
Instale o CLI:
```bash
composer global require laravel/cloud-cli
```

E adicione ao PATH:
```bash
export PATH="$HOME/.composer/vendor/bin:$PATH"
```

### "Database file not found" (SQLite)
Execute:
```bash
laravel-cloud command "touch database/database.sqlite"
laravel-cloud command "php artisan migrate --force"
```

### Ainda não funciona?
Entre em contato com o suporte do Laravel Cloud ou verifique a documentação oficial:
https://cloud.laravel.com/docs
