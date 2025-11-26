# Configuração do Banco de Dados no Laravel Cloud

## Problema
O cadastro não está funcionando porque o banco de dados não foi criado/migrado no Laravel Cloud.

## Solução - Passo a Passo

### 1. Acessar o Laravel Cloud Dashboard
- Acesse https://cloud.laravel.com
- Entre no seu projeto

### 2. Verificar/Configurar o Banco de Dados

O Laravel Cloud geralmente provisiona automaticamente um banco de dados. Você precisa:

#### Opção A: Usar o Banco de Dados Provisionado (Recomendado)
1. No dashboard do Laravel Cloud, vá em **Database**
2. Verifique se há um banco de dados criado
3. Se não houver, crie um novo banco de dados

#### Opção B: Verificar Variáveis de Ambiente
1. No dashboard, vá em **Environment**
2. Verifique se as variáveis de banco de dados estão configuradas:
   ```
   DB_CONNECTION=mysql (ou pgsql, dependendo do que o Laravel Cloud oferece)
   DB_HOST=<host-fornecido-pelo-laravel-cloud>
   DB_PORT=3306 (ou 5432 para PostgreSQL)
   DB_DATABASE=<nome-do-banco>
   DB_USERNAME=<usuario>
   DB_PASSWORD=<senha>
   ```

### 3. Executar as Migrations

Você precisa rodar as migrations no servidor. Existem 3 formas:

#### Método 1: Via Dashboard do Laravel Cloud (Mais Fácil)
1. No dashboard, vá em **Commands** ou **Console**
2. Execute o comando:
   ```bash
   php artisan migrate --force
   ```
   (O `--force` é necessário em produção)

#### Método 2: Via Deploy Hook
1. No dashboard, vá em **Deployment**
2. Configure um **Deploy Script** ou **Post-Deploy Hook**:
   ```bash
   php artisan migrate --force
   ```
3. Faça um novo deploy (push no GitHub)

#### Método 3: Via SSH (se disponível)
1. Conecte via SSH ao servidor (se o Laravel Cloud permitir)
2. Execute:
   ```bash
   cd /caminho/do/projeto
   php artisan migrate --force
   ```

### 4. Verificar se as Tabelas Foram Criadas

Execute no console do Laravel Cloud:
```bash
php artisan migrate:status
```

Isso mostrará todas as migrations e se foram executadas.

### 5. Criar um Usuário Admin (Opcional)

Se você quiser criar um usuário admin inicial:
```bash
php artisan tinker
```

Depois execute:
```php
$user = new App\Models\User();
$user->name = 'Admin';
$user->email = 'admin@iffar.edu.br';
$user->password = bcrypt('senha123');
$user->cpf = '00000000000';
$user->user_type = 'admin';
$user->save();
```

## Migrations que Serão Executadas

O projeto possui 18 migrations que criarão as seguintes tabelas:
- users (usuários)
- events (eventos)
- registrations (inscrições)
- payments (pagamentos)
- certificates (certificados)
- cancellations (cancelamentos)
- questions (perguntas)
- signatures (assinaturas)
- sessions, cache, jobs (sistema)
- personal_access_tokens (autenticação API)

## Troubleshooting

### Erro: "Database does not exist"
- Certifique-se de que o banco de dados foi criado no Laravel Cloud
- Verifique as credenciais nas variáveis de ambiente

### Erro: "SQLSTATE[HY000] [2002] Connection refused"
- Verifique se o DB_HOST está correto
- Verifique se o banco de dados está ativo no Laravel Cloud

### Erro: "Access denied for user"
- Verifique DB_USERNAME e DB_PASSWORD
- Certifique-se de que o usuário tem permissões no banco

### Migrations não executam
- Use `--force` em produção: `php artisan migrate --force`
- Verifique os logs: `php artisan log:tail` (se disponível)

## Comandos Úteis

```bash
# Ver status das migrations
php artisan migrate:status

# Executar migrations
php artisan migrate --force

# Reverter última migration (cuidado!)
php artisan migrate:rollback --force

# Limpar cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# Ver logs
tail -f storage/logs/laravel.log
```

## Próximos Passos

Após executar as migrations:
1. Teste o cadastro de usuário
2. Verifique se os dados estão sendo salvos
3. Configure as variáveis do Mercado Pago (se necessário):
   - MERCADOPAGO_ACCESS_TOKEN
   - MERCADOPAGO_PUBLIC_KEY
   - PIX_KEY
   - SERVER_CODE_SECRETO

## Suporte

Se continuar com problemas:
1. Verifique os logs no Laravel Cloud Dashboard
2. Execute `php artisan migrate:status` para ver o status
3. Verifique se todas as variáveis de ambiente estão configuradas
