<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CertificalFFar Eventos - Login</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1a5f3f 0%, #155030 100%);
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(26, 95, 63, 0.3);
        }
    </style>
</head>
<body class="bg-gradient-to-br from-green-800 to-green-600 min-h-screen">
    
    <div class="container mx-auto px-4 py-8">
        <!-- Logo -->
        <div class="flex items-center space-x-3 mb-8">
            <div class="bg-white w-12 h-12 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-green-800" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-white text-xl font-bold">CertificalFFar</h1>
                <p class="text-white/90 text-sm">Eventos</p>
            </div>
        </div>

        <div class="max-w-md mx-auto">
            <!-- Card de Login -->
            <div id="login-card" class="bg-white rounded-2xl shadow-2xl p-8">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Entrar</h2>
                
                <form id="login-form" onsubmit="handleLogin(event); return false;">
                    <div class="mb-4">
                        <label for="login-email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                        <input type="email" id="login-email" name="email" placeholder="seu.email@iffar.edu.br"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800 focus:border-green-800" required>
                    </div>

                    <div class="mb-4">
                        <label for="login-password" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                        <input type="password" id="login-password" name="password" placeholder="********"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800 focus:border-green-800" required>
                    </div>

                    <div id="login-error" class="hidden mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm"></div>

                    <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg font-semibold transition mb-4">
                        ENTRAR
                    </button>

                    <div class="text-center">
                        <a href="#" onclick="toggleMode(); return false;" class="text-sm text-gray-600 hover:text-green-800">
                            Não tem uma conta? <span class="font-semibold">Cadastre-se</span>
                        </a>
                    </div>
                </form>
            </div>

            <!-- Card de Cadastro -->
            <div id="register-card" class="bg-white rounded-2xl shadow-2xl p-8" style="display: none;">
                <h2 class="text-3xl font-bold text-gray-900 mb-6">Cadastrar</h2>
                
                <form id="register-form" onsubmit="handleRegister(event); return false;" class="max-h-[70vh] overflow-y-auto pr-2">
                    <div class="mb-4">
                        <label for="register-user-type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Usuário</label>
                        <select id="register-user-type" name="user_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800" required onchange="handleUserTypeChange()">
                            <option value="">Selecione...</option>
                            <option value="student">Aluno</option>
                            <option value="server">Servidor IFFAR</option>
                            <option value="external">Externo</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="register-name" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                        <input type="text" id="register-name" name="name" placeholder="Seu nome completo"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800" required>
                    </div>

                    <div class="mb-4">
                        <label for="register-email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                        <input type="email" id="register-email" name="email" placeholder="seu.email@iffar.edu.br"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800" required>
                    </div>

                    <div class="mb-4">
                        <label for="register-cpf" class="block text-sm font-medium text-gray-700 mb-2">CPF</label>
                        <input type="text" id="register-cpf" name="cpf" placeholder="000.000.000-00" maxlength="14"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800" required>
                    </div>

                    <!-- Campos Aluno -->
                    <div id="aluno-fields" style="display: none;">
                        <div class="mb-4">
                            <label for="register-registration" class="block text-sm font-medium text-gray-700 mb-2">Matrícula <span class="text-gray-500">(opcional)</span></label>
                            <input type="text" id="register-registration" name="registration_number" placeholder="Sua matrícula"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800">
                        </div>
                        <div class="mb-4">
                            <label for="register-course" class="block text-sm font-medium text-gray-700 mb-2">Curso <span class="text-gray-500">(opcional)</span></label>
                            <input type="text" id="register-course" name="course" placeholder="Seu curso"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800">
                        </div>
                        <div class="mb-4">
                            <label for="register-semester" class="block text-sm font-medium text-gray-700 mb-2">Semestre <span class="text-gray-500">(opcional)</span></label>
                            <input type="number" id="register-semester" name="semester" placeholder="Seu semestre" min="1"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800">
                        </div>
                    </div>

                    <!-- Campos Servidor -->
                    <div id="servidor-fields" style="display: none;">
                        <div class="mb-4">
                            <label for="register-department" class="block text-sm font-medium text-gray-700 mb-2">Departamento</label>
                            <input type="text" id="register-department" name="department" placeholder="Seu departamento"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800">
                        </div>
                    </div>

                    <!-- Campos Externo -->
                    <div id="externo-fields" style="display: none;">
                        <div class="mb-4">
                            <label for="register-institution" class="block text-sm font-medium text-gray-700 mb-2">Instituição</label>
                            <input type="text" id="register-institution" name="institution" placeholder="Sua instituição"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="register-password" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                        <input type="password" id="register-password" name="password" placeholder="Mínimo 8 caracteres"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800" required minlength="8">
                    </div>

                    <div class="mb-4">
                        <label for="register-password-confirm" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Senha</label>
                        <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="Confirme sua senha"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-800" required minlength="8">
                    </div>

                    <div id="register-error" class="hidden mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm"></div>

                    <button type="submit" class="w-full btn-primary text-white py-3 rounded-lg font-semibold transition mb-4">
                        CADASTRAR
                    </button>

                    <div class="text-center">
                        <a href="#" onclick="toggleMode(); return false;" class="text-sm text-gray-600 hover:text-green-800">
                            Já tem uma conta? <span class="font-semibold">Entrar</span>
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

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

            if (loginCard.style.display === 'none') {
                loginCard.style.display = 'block';
                registerCard.style.display = 'none';
                document.title = 'CertificalFFar Eventos - Login';
                window.history.pushState({}, '', '/login');
            } else {
                loginCard.style.display = 'none';
                registerCard.style.display = 'block';
                document.title = 'CertificalFFar Eventos - Cadastro';
                window.history.pushState({}, '', '/register');
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

            if (userType === 'student') {
                alunoFields.style.display = 'block';
            } else if (userType === 'server') {
                servidorFields.style.display = 'block';
            } else if (userType === 'external') {
                externoFields.style.display = 'block';
            }
        }

        async function handleLogin(event) {
            event.preventDefault();
            const errorDiv = document.getElementById('login-error');
            errorDiv.classList.add('hidden');

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

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.user));
                    
                    if (data.user.user_type === 'admin') {
                        window.location.href = '/admin/dashboard';
                    } else {
                        window.location.href = '/events';
                    }
                } else {
                    errorDiv.textContent = data.message || 'Credenciais inválidas';
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.textContent = 'Erro ao fazer login. Tente novamente.';
                errorDiv.classList.remove('hidden');
            }
        }

        async function handleRegister(event) {
            event.preventDefault();
            const errorDiv = document.getElementById('register-error');
            errorDiv.classList.add('hidden');

            const userType = document.getElementById('register-user-type').value;

            const formData = {
                name: document.getElementById('register-name').value,
                email: document.getElementById('register-email').value,
                password: document.getElementById('register-password').value,
                password_confirmation: document.getElementById('register-password-confirm').value,
                user_type: userType,
                cpf: document.getElementById('register-cpf').value,
            };

            if (userType === 'student') {
                const registration = document.getElementById('register-registration').value;
                const course = document.getElementById('register-course').value;
                const semester = document.getElementById('register-semester').value;
                if (registration) formData.registration_number = registration;
                if (course) formData.course = course;
                if (semester) formData.semester = parseInt(semester);
            } else if (userType === 'server') {
                const sector = document.getElementById('register-department').value;
                if (sector) formData.sector = sector;
                formData.server_code = 'ServidorIFFAR2025'; // Código padrão
            } else if (userType === 'external') {
                const institution = document.getElementById('register-institution').value;
                if (institution) formData.external_school = institution;
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

                const data = await response.json();

                if (response.ok) {
                    localStorage.setItem('auth_token', data.access_token);
                    localStorage.setItem('user', JSON.stringify(data.user));
                    window.location.href = '/events';
                } else {
                    let errorMessage = 'Erro ao cadastrar. Tente novamente.';
                    if (data.errors) {
                        errorMessage = Object.values(data.errors).flat().join(' ');
                    } else if (data.message) {
                        errorMessage = data.message;
                    }
                    errorDiv.textContent = errorMessage;
                    errorDiv.classList.remove('hidden');
                }
            } catch (error) {
                errorDiv.textContent = 'Erro ao cadastrar. Tente novamente.';
                errorDiv.classList.remove('hidden');
            }
        }
    </script>
</body>
</html>
