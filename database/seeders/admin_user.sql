-- Criar usuário admin
-- Senha: admin123 (hash bcrypt)

INSERT INTO users (
    name, 
    email, 
    password, 
    user_type, 
    cpf,
    email_verified_at,
    created_at, 
    updated_at
) VALUES (
    'Administrador',
    'admin@iffar.edu.br',
    '$2y$12$LQv3c1yduTi6xUrfkNrJe.3J9P0rZLqvI5Z5Z5Z5Z5Z5Z5Z5Z5Z5Zu',
    'admin',
    '00000000000',
    NOW(),
    NOW(),
    NOW()
);
