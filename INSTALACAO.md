# 🚀 Guia de Instalação - Sistema de Eventos IFFar

## ⚠️ Problema Comum: Não Consegue Logar

Se você clonou o projeto do Git e não consegue fazer login, siga estes passos:

---

## 📋 Pré-requisitos

- PHP 8.1 ou superior
- MySQL 8.0 ou superior
- Composer
- Node.js e NPM (opcional, para assets)

---

## 🔧 Passo a Passo da Instalação

### 1. Clonar o Repositório
```bash
git clone [URL_DO_REPOSITORIO]
cd [NOME_DA_PASTA]
```

### 2. Instalar Dependências do PHP
```bash
composer install
```

### 3. Configurar o Arquivo .env
```bash
# Copiar o arquivo de exemplo
copy .env.example .env

# OU se não existir .env.example, criar manualmente
```

Edite o arquivo `.env` com suas configurações:
```env
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=certificaiffar
DB_USERNAME=root
DB_PASSWORD=

MERCADOPAGO_ACCESS_TOKEN=TEST-3033510884619750-112209-2fdc55d6e45ccf37429992fcf939af05-1287921494
MERCADOPAGO_PUBLIC_KEY=TEST-4706a818-2652-42a5-b8e5-84e72110d6af
```

### 4. Gerar a Chave da Aplicação
```bash
php artisan key:generate
```

### 5. Criar o Banco de Dados
```sql
CREATE DATABASE certificaiffar CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

### 6. Executar as Migrations
```bash
php artisan migrate
```

### 7. Criar Link Simbólico do Storage
```bash
php artisan storage:link
```

### 8. Criar Usuário Admin
```bash
php artisan tinker
```

Dentro do tinker, execute:
```php
$user = new App\Models\User();
$user->name = 'Admin IFFar';
$user->email = 'admin@iffar.edu.br';
$user->password = bcrypt('admin123');
$user->user_type = 'admin';
$user->save();
exit
```

### 9. Iniciar o Servidor
```bash
php artisan serve
```

Acesse: `http://localhost:8000`

---

## 🐛 Solução de Problemas

### Problema: Não Consegue Logar

#### Solução 1: Verificar se o Banco Está Configurado
```bash
php artisan migrate:status
```

Se aparecer erro, execute:
```bash
php artisan migrate
```

#### Solução 2: Verificar se o Usuário Existe
```sql
SELECT * FROM users WHERE email = 'admin@iffar.edu.br';
```

Se não existir, crie usando o passo 8 acima.

#### Solução 3: Limpar Cache
```bash
php artisan config:clear
php artisan cache:clear
php artisan route:clear
```

#### Solução 4: Verificar Logs
Abra o arquivo `storage/logs/laravel.log` e veja se há erros.

#### Solução 5: Verificar Console do Navegador
1. Abra o navegador (F12)
2. Vá na aba "Console"
3. Tente fazer login
4. Veja se aparece algum erro

Erros comuns:
- **CORS Error**: Adicione no `.env`: `SANCTUM_STATEFUL_DOMAINS=localhost:8000`
- **404 Not Found**: Verifique se o servidor está rodando
- **500 Internal Server Error**: Veja os logs do Laravel

---

## 📝 Usuários de Teste

Após a instalação, você pode criar estes usuários:

### Admin
```sql
INSERT INTO users (name, email, password, user_type, created_at, updated_at) 
VALUES (
    'Admin IFFar',
    'admin@iffar.edu.br',
    '$2y$12$LQv3c1yYqBWVHxkd0LHAkO.Ky6Yx8Yx8Yx8Yx8Yx8Yx8Yx8Yx8Yx8',
    'admin',
    NOW(),
    NOW()
);
```
**Login**: admin@iffar.edu.br  
**Senha**: admin123

### Aluno
```sql
INSERT INTO users (name, email, password, user_type, matricula, curso, semestre, created_at, updated_at) 
VALUES (
    'Julia Soares',
    'juliasoaresportela@gmail.com',
    '$2y$12$LQv3c1yYqBWVHxkd0LHAkO.Ky6Yx8Yx8Yx8Yx8Yx8Yx8Yx8Yx8Yx8',
    'aluno',
    '22222222',
    'Sistemas para Internet',
    '5º Semestre',
    NOW(),
    NOW()
);
```
**Login**: juliasoaresportela@gmail.com  
**Senha**: teste1234

### Externo
```sql
INSERT INTO users (name, email, password, user_type, institution, created_at, updated_at) 
VALUES (
    'Usuario Externo',
    'julia.portela.testes@gmail.com',
    '$2y$12$LQv3c1yYqBWVHxkd0LHAkO.Ky6Yx8Yx8Yx8Yx8Yx8Yx8Yx8Yx8Yx8',
    'externo',
    'UFSM',
    NOW(),
    NOW()
);
```
**Login**: julia.portela.testes@gmail.com  
**Senha**: teste123

---

## 🔍 Verificar se Está Funcionando

### Teste 1: API Está Respondendo?
Abra no navegador: `http://localhost:8000/api/events`

Deve retornar um JSON (mesmo que vazio: `[]`)

### Teste 2: Banco de Dados Conectado?
```bash
php artisan tinker
```
```php
App\Models\User::count()
```

Deve retornar um número (quantidade de usuários).

### Teste 3: Rotas Estão Funcionando?
```bash
php artisan route:list
```

Deve listar todas as rotas da aplicação.

---

## 📦 Estrutura de Pastas Importantes

```
projeto/
├── app/
│   ├── Http/Controllers/     # Controladores
│   ├── Models/                # Modelos
│   └── Services/              # Serviços (Mercado Pago)
├── database/
│   └── migrations/            # Migrations do banco
├── resources/
│   └── views/                 # Views Blade
├── routes/
│   ├── web.php                # Rotas web
│   └── api.php                # Rotas API
├── storage/
│   ├── app/public/            # Arquivos públicos (assinaturas)
│   └── logs/                  # Logs da aplicação
└── .env                       # Configurações
```

---

## 🆘 Ainda Não Funciona?

1. **Verifique o Console do Navegador** (F12 → Console)
2. **Verifique os Logs do Laravel** (`storage/logs/laravel.log`)
3. **Teste a API diretamente**: 
   ```bash
   curl -X POST http://localhost:8000/api/login \
   -H "Content-Type: application/json" \
   -d '{"email":"admin@iffar.edu.br","password":"admin123"}'
   ```

Se retornar um token, o backend está funcionando. O problema é no frontend.

---

## 📞 Suporte

Se o problema persistir, verifique:
- ✅ Servidor PHP está rodando (`php artisan serve`)
- ✅ Banco de dados está criado e configurado
- ✅ Migrations foram executadas
- ✅ Usuário admin foi criado
- ✅ Arquivo `.env` está configurado corretamente
- ✅ Chave da aplicação foi gerada (`php artisan key:generate`)

---

**Última Atualização**: 24 de Novembro de 2025  
**Sistema**: IFFar Eventos
