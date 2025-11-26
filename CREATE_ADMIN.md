# Como Criar o Usuário Admin

## Opção 1: Via Tinker (Recomendado)

No console do Laravel Cloud, execute:

```bash
php artisan tinker
```

Depois cole este código:

```php
\App\Models\User::create([
    'name' => 'Administrador',
    'email' => 'admin@iffar.edu.br',
    'password' => bcrypt('admin123'),
    'user_type' => 'admin',
    'cpf' => '00000000000',
    'email_verified_at' => now(),
]);
```

Aperte Enter e depois digite `exit`.

## Opção 2: Via SQL Direto

Se estiver usando SQLite, execute:

```bash
sqlite3 database/database.sqlite
```

Depois cole:

```sql
INSERT INTO users (name, email, password, user_type, cpf, email_verified_at, created_at, updated_at) 
VALUES (
    'Administrador',
    'admin@iffar.edu.br',
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
    'admin',
    '00000000000',
    datetime('now'),
    datetime('now'),
    datetime('now')
);
```

Digite `.exit` para sair.

## Opção 3: Via Seeder

Execute no Laravel Cloud:

```bash
php artisan db:seed --class=AdminSeeder
```

## Credenciais de Acesso

- **Email:** admin@iffar.edu.br
- **Senha:** admin123
- **Tipo:** admin

## Verificar se foi criado

```bash
php artisan tinker
```

```php
\App\Models\User::where('email', 'admin@iffar.edu.br')->first();
```
