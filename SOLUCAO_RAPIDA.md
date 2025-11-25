# 🚨 SOLUÇÃO RÁPIDA - Login Não Funciona

## Problema
O arquivo `auth.blade.php` foi formatado pelo IDE e perdeu o código JavaScript.

## ✅ SOLUÇÃO IMEDIATA

### Passo 1: Fechar o Vim Travado
No Git Bash que está travado, pressione:
1. **ESC** (várias vezes)
2. Digite: **:q!** e pressione ENTER
3. Isso vai fechar o Vim sem salvar

### Passo 2: Restaurar o Arquivo Correto
Abra um **NOVO terminal** (PowerShell ou Git Bash) e execute:

```bash
cd C:\Users\julia\Documents\PPI-Definitiva-Ok

# Descartar mudanças locais e pegar a versão do GitHub
git checkout origin/main -- resources/views/auth.blade.php

# OU restaurar do commit anterior
git checkout HEAD~1 -- resources/views/auth.blade.php
```

### Passo 3: Adicionar o JavaScript Inline

Abra o arquivo `resources/views/auth.blade.php` no editor e **ANTES da tag `</body>`**, adicione este código:

```html
<script>
const API_BASE_URL = window.location.origin;

window.addEventListener('DOMContentLoaded', function() {
    if (window.location.pathname === '/register') {
        toggleMode();
    }
});

function toggleMode() {
    const loginCard = document.getElementById('login-card');
    const registerCard = document.getElementById('register-card');
    const loginLinkTop = document.getElementById('login-link-top');
    const registerLinkTop = document.getElementById('register-link-top');

    if (loginCard.style.display === 'none') {
        loginCard.style.display = 'block';
        registerCard.style.display = 'none';
        registerLinkTop.style.display = 'block';
        loginLinkTop.style.display = 'none';
        document.title = 'CertificalFFar Eventos - Login';
        window.history.pushState({}, '', '/login');
    } else {
        loginCard.style.display = 'none';
        registerCard.style.display = 'block';
        registerLinkTop.style.display = 'none';
        loginLinkTop.style.display = 'block';
        document.title = 'CertificalFFar Eventos - Cadastro';
        window.history.pushState({}, '', '/register');
    }
}

async function handleLogin(event) {
    event.preventDefault();
    const errorDiv = document.getElementById('login-error');
    errorDiv.classList.add('hidden');
    errorDiv.textContent = '';

    const formData = {
        email: document.getElementById('login-email').value,
        password: document.getElementById('login-password').value,
    };

    try {
        const response = await fetch(`${API_BASE_URL}/api/login`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        let data;
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            data = await response.json();
        } else {
            const text = await response.text();
            errorDiv.textContent = `Erro: ${response.status} - ${text || 'Resposta inválida do servidor'}`;
            errorDiv.classList.remove('hidden');
            return;
        }

        if (response.ok) {
            localStorage.setItem('auth_token', data.access_token);
            localStorage.setItem('user', JSON.stringify(data.user));
            
            if (data.user.user_type === 'admin') {
                window.location.href = '/admin/dashboard';
            } else {
                window.location.href = '/events';
            }
        } else {
            let errorMessage = 'Credenciais inválidas. Tente novamente.';
            if (data.errors && data.errors.email) {
                errorMessage = data.errors.email[0];
            } else if (data.message) {
                errorMessage = data.message;
            }
            errorDiv.textContent = errorMessage;
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        console.error('Erro no login:', error);
        errorDiv.textContent = 'Erro ao fazer login. Tente novamente.';
        errorDiv.classList.remove('hidden');
    }
}

function handleUserTypeChange() {
    const userType = document.getElementById('register-user-type').value;
    const alunoFields = document.getElementById('aluno-fields');
    const servidorFields = document.getElementById('servidor-fields');
    const externoFields = document.getElementById('externo-fields');

    alunoFields.style.display = 'none';
    servidorFields.style.display = 'none';
    externoFields.style.display = 'none';

    document.getElementById('register-registration').removeAttribute('required');
    document.getElementById('register-course').removeAttribute('required');
    document.getElementById('register-semester').removeAttribute('required');
    document.getElementById('register-department').removeAttribute('required');
    document.getElementById('register-institution').removeAttribute('required');

    if (userType === 'aluno') {
        alunoFields.style.display = 'block';
    } else if (userType === 'servidor_iffar') {
        servidorFields.style.display = 'block';
        document.getElementById('register-department').setAttribute('required', 'required');
    } else if (userType === 'externo') {
        externoFields.style.display = 'block';
        document.getElementById('register-institution').setAttribute('required', 'required');
    }
}

async function handleRegister(event) {
    event.preventDefault();

    const errorDiv = document.getElementById('register-error');
    errorDiv.classList.add('hidden');
    errorDiv.textContent = '';

    const userType = document.getElementById('register-user-type').value;

    if (!userType) {
        errorDiv.textContent = 'Por favor, selecione o tipo de usuário.';
        errorDiv.classList.remove('hidden');
        return;
    }

    const formData = {
        name: document.getElementById('register-name').value,
        email: document.getElementById('register-email').value,
        password: document.getElementById('register-password').value,
        password_confirmation: document.getElementById('register-password-confirm').value,
        user_type: userType,
        cpf: document.getElementById('register-cpf').value,
    };

    if (userType === 'aluno') {
        const registration = document.getElementById('register-registration').value;
        const course = document.getElementById('register-course').value;
        const semester = document.getElementById('register-semester').value;
        
        if (registration) formData.registration_number = registration;
        if (course) formData.course = course;
        if (semester) formData.semester = parseInt(semester);
    } else if (userType === 'servidor_iffar') {
        formData.department = document.getElementById('register-department').value;
    } else if (userType === 'externo') {
        formData.institution = document.getElementById('register-institution').value;
    }

    if (formData.password !== formData.password_confirmation) {
        errorDiv.textContent = 'As senhas não coincidem.';
        errorDiv.classList.remove('hidden');
        return;
    }

    try {
        const response = await fetch(`${API_BASE_URL}/api/register`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(formData),
        });

        let data;
        const contentType = response.headers.get('content-type');
        if (contentType && contentType.includes('application/json')) {
            data = await response.json();
        } else {
            const text = await response.text();
            errorDiv.textContent = `Erro: ${response.status} - ${text || 'Resposta inválida do servidor'}`;
            errorDiv.classList.remove('hidden');
            return;
        }

        if (response.ok) {
            localStorage.setItem('auth_token', data.access_token);
            localStorage.setItem('user', JSON.stringify(data.user));
            
            if (data.user.user_type === 'admin') {
                window.location.href = '/admin/dashboard';
            } else {
                window.location.href = '/events';
            }
        } else {
            let errorMessage = 'Erro ao cadastrar. Tente novamente.';
            if (data.errors) {
                const errors = Object.values(data.errors).flat();
                errorMessage = errors.join(' ');
            } else if (data.message) {
                errorMessage = data.message;
            }
            errorDiv.textContent = errorMessage;
            errorDiv.classList.remove('hidden');
        }
    } catch (error) {
        console.error('Erro no cadastro:', error);
        errorDiv.textContent = 'Erro ao cadastrar. Tente novamente.';
        errorDiv.classList.remove('hidden');
    }
}

function handleGoogleLogin() {
    window.location.href = `${API_BASE_URL}/auth/google`;
}

document.addEventListener('DOMContentLoaded', function() {
    const cpfInput = document.getElementById('register-cpf');
    if (cpfInput) {
        cpfInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });
    }
});
</script>
```

### Passo 4: Fazer Push

```bash
git add resources/views/auth.blade.php
git commit -m "Fix: Adiciona JavaScript inline no auth.blade.php"
git push origin main
```

### Passo 5: Aguardar Deploy
Aguarde 2-3 minutos e teste: https://ppi-definitiva-ok-main-l8p2ja.laravel.cloud/login

---

## ⚡ ALTERNATIVA MAIS RÁPIDA

Se preferir, copie o arquivo completo que está em anexo neste repositório e substitua o atual.

O arquivo correto está salvo em: `resources/views/auth-COMPLETE.blade.php`
