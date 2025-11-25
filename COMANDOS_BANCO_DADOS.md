# Comandos do Banco de Dados - Sistema de Eventos IFFar

## 🔧 Configuração Inicial

### 1. Criar Banco de Dados
```sql
CREATE DATABASE iffar_eventos CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE iffar_eventos;
```

### 2. Configurar .env
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=iffar_eventos
DB_USERNAME=root
DB_PASSWORD=
```

### 3. Executar Migrations
```bash
php artisan migrate
```

---

## 📊 Estrutura das Tabelas

### Tabela: `users`
```sql
CREATE TABLE users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    password VARCHAR(255) NOT NULL,
    user_type ENUM('student', 'admin') DEFAULT 'student',
    registration_number VARCHAR(255) NULL UNIQUE,
    course VARCHAR(255) NULL,
    semester INT NULL,
    phone VARCHAR(255) NULL,
    matricula VARCHAR(255) NULL,
    curso VARCHAR(255) NULL,
    semestre VARCHAR(255) NULL,
    telefone VARCHAR(255) NULL,
    cpf VARCHAR(255) NULL,
    institution VARCHAR(255) NULL,
    email_verified_at TIMESTAMP NULL,
    remember_token VARCHAR(100) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Tabela: `events`
```sql
CREATE TABLE events (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    date DATE NOT NULL,
    time VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    organizer VARCHAR(255) NOT NULL,
    capacity INT NOT NULL,
    price DECIMAL(10,2) NOT NULL DEFAULT 0.00,
    image VARCHAR(255) NULL,
    speakers JSON NULL,
    tags JSON NULL,
    is_active BOOLEAN DEFAULT TRUE,
    is_completed BOOLEAN DEFAULT FALSE,
    certificate_hours INT NULL,
    certificate_description TEXT NULL,
    signature1_id BIGINT UNSIGNED NULL,
    signature2_id BIGINT UNSIGNED NULL,
    payment_config JSON NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (signature1_id) REFERENCES signatures(id) ON DELETE SET NULL,
    FOREIGN KEY (signature2_id) REFERENCES signatures(id) ON DELETE SET NULL
);
```

### Tabela: `registrations`
```sql
CREATE TABLE registrations (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    event_id BIGINT UNSIGNED NOT NULL,
    checked_in BOOLEAN DEFAULT FALSE,
    check_in_time TIMESTAMP NULL,
    check_in_code VARCHAR(255) UNIQUE NULL,
    status ENUM('pending', 'confirmed', 'cancelled') DEFAULT 'pending',
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    UNIQUE KEY unique_user_event (user_id, event_id),
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE
);
```

### Tabela: `payments`
```sql
CREATE TABLE payments (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    registration_id BIGINT UNSIGNED NOT NULL,
    amount DECIMAL(10,2) NOT NULL,
    payment_method ENUM('pix', 'credit_card', 'debit_card') NULL,
    status ENUM('pending', 'paid', 'failed', 'refunded') DEFAULT 'pending',
    payment_data TEXT NULL,
    paid_at TIMESTAMP NULL,
    pix_qr_code TEXT NULL,
    pix_qr_code_base64 TEXT NULL,
    pix_txid VARCHAR(255) NULL,
    pix_payload TEXT NULL,
    mercadopago_payment_id VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
);
```

### Tabela: `certificates`
```sql
CREATE TABLE certificates (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    event_id BIGINT UNSIGNED NOT NULL,
    registration_id BIGINT UNSIGNED NOT NULL,
    certificate_code VARCHAR(255) UNIQUE NOT NULL,
    issued_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    validation_count INT DEFAULT 0,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (registration_id) REFERENCES registrations(id) ON DELETE CASCADE
);
```

### Tabela: `signatures`
```sql
CREATE TABLE signatures (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    title VARCHAR(255) NOT NULL,
    image_path VARCHAR(255) NOT NULL,
    is_active BOOLEAN DEFAULT TRUE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL
);
```

### Tabela: `questions`
```sql
CREATE TABLE questions (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    event_id BIGINT UNSIGNED NOT NULL,
    user_id BIGINT UNSIGNED NOT NULL,
    question TEXT NOT NULL,
    answer TEXT NULL,
    answered_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (event_id) REFERENCES events(id) ON DELETE CASCADE,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Tabela: `personal_access_tokens` (Sanctum)
```sql
CREATE TABLE personal_access_tokens (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    tokenable_type VARCHAR(255) NOT NULL,
    tokenable_id BIGINT UNSIGNED NOT NULL,
    name VARCHAR(255) NOT NULL,
    token VARCHAR(64) UNIQUE NOT NULL,
    abilities TEXT NULL,
    last_used_at TIMESTAMP NULL,
    expires_at TIMESTAMP NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    INDEX tokenable (tokenable_type, tokenable_id)
);
```

---

## 🔍 Consultas Úteis

### Listar todos os eventos
```sql
SELECT id, title, date, time, location, capacity, price, is_active 
FROM events 
ORDER BY date DESC;
```

### Listar inscrições de um evento
```sql
SELECT 
    r.id,
    u.name,
    u.email,
    u.curso,
    u.semestre,
    r.status,
    r.checked_in,
    p.status as payment_status,
    r.created_at
FROM registrations r
JOIN users u ON r.user_id = u.id
LEFT JOIN payments p ON p.registration_id = r.id
WHERE r.event_id = 1
ORDER BY r.created_at DESC;
```

### Verificar pagamentos pendentes
```sql
SELECT 
    p.id,
    u.name,
    e.title,
    p.amount,
    p.status,
    p.created_at
FROM payments p
JOIN registrations r ON p.registration_id = r.id
JOIN users u ON r.user_id = u.id
JOIN events e ON r.event_id = e.id
WHERE p.status = 'pending'
ORDER BY p.created_at DESC;
```

### Listar certificados emitidos
```sql
SELECT 
    c.certificate_code,
    u.name,
    e.title,
    c.issued_at,
    c.validation_count
FROM certificates c
JOIN users u ON c.user_id = u.id
JOIN events e ON c.event_id = e.id
ORDER BY c.issued_at DESC;
```

### Estatísticas do sistema
```sql
SELECT 
    (SELECT COUNT(*) FROM events) as total_eventos,
    (SELECT COUNT(*) FROM users WHERE user_type != 'admin') as total_usuarios,
    (SELECT COUNT(*) FROM registrations WHERE status = 'confirmed') as total_inscricoes,
    (SELECT SUM(amount) FROM payments WHERE status = 'paid') as receita_total,
    (SELECT COUNT(*) FROM certificates) as total_certificados;
```

### Usuários externos inscritos
```sql
SELECT 
    u.name,
    u.email,
    u.institution,
    e.title as evento,
    r.status
FROM registrations r
JOIN users u ON r.user_id = u.id
JOIN events e ON r.event_id = e.id
WHERE u.user_type = 'externo'
ORDER BY r.created_at DESC;
```

---

## 🗑️ Comandos de Limpeza

### Limpar dados de teste
```sql
-- Deletar certificados
DELETE FROM certificates;

-- Deletar pagamentos
DELETE FROM payments;

-- Deletar inscrições
DELETE FROM registrations;

-- Deletar perguntas
DELETE FROM questions;

-- Deletar eventos
DELETE FROM events;

-- Deletar usuários (exceto admin)
DELETE FROM users WHERE user_type != 'admin';

-- Resetar auto_increment
ALTER TABLE certificates AUTO_INCREMENT = 1;
ALTER TABLE payments AUTO_INCREMENT = 1;
ALTER TABLE registrations AUTO_INCREMENT = 1;
ALTER TABLE questions AUTO_INCREMENT = 1;
ALTER TABLE events AUTO_INCREMENT = 1;
ALTER TABLE users AUTO_INCREMENT = 1;
```

### Limpar apenas inscrições e pagamentos
```sql
DELETE FROM certificates;
DELETE FROM payments;
DELETE FROM registrations;
ALTER TABLE certificates AUTO_INCREMENT = 1;
ALTER TABLE payments AUTO_INCREMENT = 1;
ALTER TABLE registrations AUTO_INCREMENT = 1;
```

---

## 📝 Inserir Dados de Teste

### Criar usuário admin
```sql
INSERT INTO users (name, email, password, user_type, created_at, updated_at) 
VALUES (
    'Admin IFFar',
    'admin@iffar.edu.br',
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- senha: admin123
    'admin',
    NOW(),
    NOW()
);
```

### Criar usuário aluno
```sql
INSERT INTO users (name, email, password, user_type, matricula, curso, semestre, created_at, updated_at) 
VALUES (
    'Julia Soares',
    'juliasoaresportela@gmail.com',
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- senha: teste1234
    'aluno',
    '22222222',
    'Sistemas para Internet',
    '5º Semestre',
    NOW(),
    NOW()
);
```

### Criar usuário externo
```sql
INSERT INTO users (name, email, password, user_type, institution, created_at, updated_at) 
VALUES (
    'Usuario Externo',
    'julia.portela.testes@gmail.com',
    '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', -- senha: teste123
    'externo',
    'UFSM',
    NOW(),
    NOW()
);
```

### Criar evento de teste
```sql
INSERT INTO events (
    title, description, date, time, location, category, organizer, 
    capacity, price, is_active, created_at, updated_at
) VALUES (
    'Workshop de Tecnologia',
    'Workshop sobre as últimas tendências em tecnologia',
    '2025-12-15',
    '14:00 - 18:00',
    'Auditório Principal',
    'Tecnologia',
    'Departamento de TI',
    100,
    30.00,
    TRUE,
    NOW(),
    NOW()
);
```

---

## 🔐 Backup e Restore

### Fazer backup do banco
```bash
mysqldump -u root -p iffar_eventos > backup_iffar_eventos.sql
```

### Restaurar backup
```bash
mysql -u root -p iffar_eventos < backup_iffar_eventos.sql
```

### Backup apenas estrutura (sem dados)
```bash
mysqldump -u root -p --no-data iffar_eventos > estrutura_iffar_eventos.sql
```

---

## ⚙️ Comandos Laravel Úteis

### Executar migrations
```bash
php artisan migrate
```

### Reverter última migration
```bash
php artisan migrate:rollback
```

### Reverter todas as migrations
```bash
php artisan migrate:reset
```

### Recriar banco do zero
```bash
php artisan migrate:fresh
```

### Verificar status das migrations
```bash
php artisan migrate:status
```

### Criar nova migration
```bash
php artisan make:migration create_nome_tabela
```

---

## 📊 Índices Recomendados

```sql
-- Melhorar performance de buscas
CREATE INDEX idx_events_date ON events(date);
CREATE INDEX idx_events_category ON events(category);
CREATE INDEX idx_registrations_status ON registrations(status);
CREATE INDEX idx_payments_status ON payments(status);
CREATE INDEX idx_certificates_code ON certificates(certificate_code);
CREATE INDEX idx_users_email ON users(email);
```

---

**Última Atualização**: 24 de Novembro de 2025  
**Sistema**: IFFar Eventos  
**Banco de Dados**: MySQL 8.x
