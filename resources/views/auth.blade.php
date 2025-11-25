<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CertificalFFar Eventos - Login</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Vite Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            overflow-x: hidden;
        }
        
        .diagonal-bg {
            background: linear-gradient(135deg, #1a5f3f 0%, #1a5f3f 60%, white 60%, white 100%);
        }
        
        @media (max-width: 768px) {
            .diagonal-bg {
                background: linear-gradient(135deg, #1a5f3f 0%, #1a5f3f 40%, white 40%, white 100%);
            }
        }
        
        .form-card {
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        }
        
        .input-field {
            transition: all 0.3s ease;
        }
        
        .input-field:focus {
            outline: none;
            border-color: #1a5f3f;
            box-shadow: 0 0 0 3px rgba(26, 95, 63, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1a5f3f 0%, #155030 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(26, 95, 63, 0.3);
        }
        
        .google-btn {
            transition: all 0.3s ease;
        }
        
        .google-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        #aluno-fields, #servidor-fields, #externo-fields {
            animation: fadeIn 0.3s ease-in;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
</head>
<body class="antialiased">
    <div class="min-h-screen diagonal-bg relative">
        <!-- Logo no topo esquerdo -->
        <div class="absolute top-8 left-8 z-10 flex items-center space-x-3">
            <div class="bg-white w-12 h-12 rounded-lg flex items-center justify-center shadow-lg">
                <svg class="w-7 h-7 text-[#1a5f3f]" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                </svg>
            </div>
            <div>
                <h1 class="text-white text-xl font-bold">CertificalFFar</h1>
                <p class="text-white/90 text-sm">Eventos</p>
            </div>
        </div>

        <!-- Link de cadastro no topo direito -->
        <div id="register-link-top" class="absolute top-8 right-8 z-10 hidden md:block">
            <a href="#" onclick="toggleMode(); return false;" class="text-white hover:text-green-200 transition text-sm">
                Não tem uma conta? <span class="font-semibold">Cadastrar</span>
            </a>
        </div>

        <!-- Link de login no topo direito -->
        <div id="login-link-top" class="absolute top-8 right-8 z-10 hidden md:block" style="display: none;">
            <a href="#" onclick="toggleMode(); return false;" class="text-white hover:text-green-200 transition text-sm">
                Já tem uma conta? <span class="font-semibold">Entrar</span>
            </a>
        </div>

        <!-- Card central -->
        <div class="min-h-screen flex items-center justify-center px-4 py-20">
            <div class="w-full max-w-md">
                <!-- Card de Login -->
                <div id="login-card" class="bg-white rounded-2xl form-card p-8 md:p-10">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Entrar</h2>
                    
                    <form id="login-form" onsubmit="handleLogin(event); return false;">
                        <div class="mb-6">
                            <label for="login-email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                            <input type="email" id="login-email" name="email" placeholder="seu.email@iffar.edu.br"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required>
                        </div>

                        <div class="mb-6">
                            <div class="flex items-center justify-between mb-2">
                                <label for="login-password" class="block text-sm font-medium text-gray-700">Senha</label>
                                <a href="#" class="text-sm text-[#1a5f3f] hover:underline">Esqueceu a senha?</a>
                            </div>
                            <input type="password" id="login-password" name="password" placeholder="********"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required>
                        </div>

                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-[#1a5f3f] border-gray-300 rounded">
                                <span class="ml-2 text-sm text-gray-700">Lembrar-me</span>
                            </label>
                        </div>

                        <button type="submit" class="w-full btn-primary text-white py-4 rounded-lg font-semibold text-lg mb-6">
                            PROSSEGUIR
                        </button>

                        <div id="login-error" class="hidden mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm"></div>
                        
                        <div class="mb-4 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <p class="text-xs font-bold text-blue-900 mb-2">📝 USUÁRIOS DE TESTE:</p>
                            <div class="text-xs text-blue-800 space-y-1">
                                <p><strong>Admin:</strong> admin@iffar.edu.br | Senha: admin123</p>
                                <p><strong>Aluno:</strong> juliasoaresportela@gmail.com | Senha: teste1234</p>
                                <p><strong>Externo:</strong> julia.portela.testes@gmail.com | Senha: teste123</p>
                            </div>
                        </div>
                    </form>

                    <div class="flex items-center my-6">
                        <div class="flex-1 border-t border-gray-300"></div>
                        <span class="px-4 text-sm text-gray-500">ou entre com</span>
                        <div class="flex-1 border-t border-gray-300"></div>
                    </div>

                    <button onclick="handleGoogleLogin()" class="w-full google-btn border-2 border-gray-300 rounded-lg py-3 px-4 flex items-center justify-center space-x-3 hover:border-gray-400 mb-6">
                        <svg class="w-5 h-5" viewBox="0 0 24 24">
                            <path fill="#4285F4" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                            <path fill="#34A853" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                            <path fill="#FBBC05" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                            <path fill="#EA4335" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
                        </svg>
                        <span class="text-gray-700 font-medium">Google</span>
                    </button>

                    <div class="text-center">
                        <a href="#" onclick="toggleMode(); return false;" class="text-sm text-gray-600 hover:text-[#1a5f3f] transition">
                            Não tem uma conta? <span class="font-semibold">Cadastre-se</span>
                        </a>
                    </div>
                </div>

                <!-- Card de Cadastro -->
                <div id="register-card" class="bg-white rounded-2xl form-card p-8 md:p-10" style="display: none;">
                    <h2 class="text-3xl font-bold text-gray-900 mb-8">Cadastrar</h2>
                    
                    <form id="register-form" onsubmit="handleRegister(event); return false;">
                        <div class="mb-4">
                            <label for="register-user-type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Usuário</label>
                            <select id="register-user-type" name="user_type" class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required onchange="handleUserTypeChange()">
                                <option value="">Selecione...</option>
                                <option value="aluno">Aluno</option>
                                <option value="servidor_iffar">Servidor IFFAR</option>
                                <option value="externo">Externo</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="register-name" class="block text-sm font-medium text-gray-700 mb-2">Nome Completo</label>
                            <input type="text" id="register-name" name="name" placeholder="Seu nome completo"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required>
                        </div>

                        <div class="mb-4">
                            <label for="register-email" class="block text-sm font-medium text-gray-700 mb-2">E-mail</label>
                            <input type="email" id="register-email" name="email" placeholder="seu.email@iffar.edu.br"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required>
                        </div>

                        <div class="mb-4">
                            <label for="register-cpf" class="block text-sm font-medium text-gray-700 mb-2">CPF</label>
                            <input type="text" id="register-cpf" name="cpf" placeholder="000.000.000-00" maxlength="14"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required>
                        </div>

                        <!-- Campos Aluno -->
                        <div id="aluno-fields" style="display: none;">
                            <div class="mb-4">
                                <label for="register-registration" class="block text-sm font-medium text-gray-700 mb-2">
                                    Matrícula <span class="text-gray-500 font-normal">(opcional)</span>
                                </label>
                                <input type="text" id="register-registration" name="registration_number" placeholder="Sua matrícula"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field">
                            </div>
                            <div class="mb-4">
                                <label for="register-course" class="block text-sm font-medium text-gray-700 mb-2">
                                    Curso <span class="text-gray-500 font-normal">(opcional)</span>
                                </label>
                                <input type="text" id="register-course" name="course" placeholder="Seu curso"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field">
                            </div>
                            <div class="mb-4">
                                <label for="register-semester" class="block text-sm font-medium text-gray-700 mb-2">
                                    Semestre <span class="text-gray-500 font-normal">(opcional)</span>
                                </label>
                                <input type="number" id="register-semester" name="semester" placeholder="Seu semestre" min="1"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field">
                            </div>
                        </div>

                        <!-- Campos Servidor -->
                        <div id="servidor-fields" style="display: none;">
                            <div class="mb-4">
                                <label for="register-department" class="block text-sm font-medium text-gray-700 mb-2">Departamento</label>
                                <input type="text" id="register-department" name="department" placeholder="Seu departamento"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field">
                            </div>
                        </div>

                        <!-- Campos Externo -->
                        <div id="externo-fields" style="display: none;">
                            <div class="mb-4">
                                <label for="register-institution" class="block text-sm font-medium text-gray-700 mb-2">Instituição</label>
                                <input type="text" id="register-institution" name="institution" placeholder="Sua instituição"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field">
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <label for="register-password" class="block text-sm font-medium text-gray-700 mb-2">Senha</label>
                            <input type="password" id="register-password" name="password" placeholder="Mínimo 8 caracteres"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required minlength="8">
                        </div>
                        
                        <div class="mb-6">
                            <label for="register-password-confirm" class="block text-sm font-medium text-gray-700 mb-2">Confirmar Senha</label>
                            <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="Confirme sua senha"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg input-field" required minlength="8">
                        </div>

                        <div id="register-error" class="hidden mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm"></div>

                        <button type="submit" class="w-full btn-primary text-white py-4 rounded-lg font-semibold text-lg mb-4">
                            CADASTRAR
                        </button>

                        <div class="text-center">
                            <a href="#" onclick="toggleMode(); return false;" class="text-sm text-gray-600 hover:text-[#1a5f3f] transition">
                                Já tem uma conta? <span class="font-semibold">Entrar</span>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="absolute bottom-8 left-8 z-10 hidden md:block">
            <p class="text-white/80 text-sm">© {{ date('Y') }} IFFar - Instituto Federal Farroupilha. Todos os direitos reservados.</p>
        </div>

        <!-- Botão de ajuda -->
        <div class="absolute bottom-8 right-8 z-10">
            <button class="w-10 h-10 bg-gray-900 rounded-full flex items-center justify-center hover:bg-gray-800 transition">
                <span class="text-white text-lg font-bold">?</span>
            </button>
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

            console.log('=== TENTANDO CADASTRO ===');
            console.log('Dados:', formData);

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
</body>
</html>
