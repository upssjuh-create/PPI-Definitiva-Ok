<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meu Perfil - Sistema IFFar</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'iffar-green': '#1a5f3f',
                    }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-50">
    <!-- Header -->
    <header class="bg-[#1a5f3f] text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <div class="bg-white w-10 h-10 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-[#1a5f3f]" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-lg font-bold">Sistema de Eventos IFFar</h1>
                        <p class="text-sm text-white/90">Instituto Federal Farroupilha</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm" id="user-name">Usuário</span>
                    <a href="/events" class="text-sm hover:underline">Voltar aos Eventos</a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Meu Perfil</h2>
            <p class="text-gray-600">Gerencie suas informações pessoais e acadêmicas</p>
        </div>

        <!-- Formulário de Perfil -->
        <form id="profileForm" class="space-y-6">
            <!-- Informações Pessoais -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#1a5f3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Informações Pessoais
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo *</label>
                        <input type="text" id="name" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Email *</label>
                        <input type="email" id="email" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">CPF</label>
                        <input type="text" id="cpf" maxlength="14"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                            placeholder="000.000.000-00">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Telefone</label>
                        <input type="text" id="telefone" maxlength="15"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                            placeholder="(00) 00000-0000">
                    </div>
                </div>
            </div>

            <!-- Informações Acadêmicas -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#1a5f3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                    Informações Acadêmicas
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Matrícula</label>
                        <input type="text" id="matricula"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                            placeholder="Ex: 2024001234">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Curso</label>
                        <select id="curso"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent">
                            <option value="">Selecione seu curso</option>
                            <option value="Sistemas para Internet">Sistemas para Internet</option>
                            <option value="Química Industrial">Química Industrial</option>
                            <option value="Agronomia">Agronomia</option>
                            <option value="Zootecnia">Zootecnia</option>
                            <option value="Engenharia Agrícola">Engenharia Agrícola</option>
                            <option value="Medicina Veterinária">Medicina Veterinária</option>
                            <option value="Licenciatura em Ciências Biológicas">Licenciatura em Ciências Biológicas</option>
                            <option value="Licenciatura em Matemática">Licenciatura em Matemática</option>
                            <option value="Técnico em Informática">Técnico em Informática</option>
                            <option value="Técnico em Agropecuária">Técnico em Agropecuária</option>
                            <option value="Técnico em Química">Técnico em Química</option>
                            <option value="Outro">Outro</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Semestre</label>
                        <select id="semestre"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent">
                            <option value="">Selecione o semestre</option>
                            <option value="1º Semestre">1º Semestre</option>
                            <option value="2º Semestre">2º Semestre</option>
                            <option value="3º Semestre">3º Semestre</option>
                            <option value="4º Semestre">4º Semestre</option>
                            <option value="5º Semestre">5º Semestre</option>
                            <option value="6º Semestre">6º Semestre</option>
                            <option value="7º Semestre">7º Semestre</option>
                            <option value="8º Semestre">8º Semestre</option>
                            <option value="9º Semestre">9º Semestre</option>
                            <option value="10º Semestre">10º Semestre</option>
                            <option value="Concluído">Concluído</option>
                        </select>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Instituição (se externo)</label>
                        <input type="text" id="institution"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                            placeholder="Ex: UFSM">
                    </div>
                </div>
            </div>

            <!-- Alterar Senha -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center">
                    <svg class="w-5 h-5 mr-2 text-[#1a5f3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                    Alterar Senha
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Nova Senha</label>
                        <input type="password" id="password"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                            placeholder="Deixe em branco para não alterar">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Confirmar Senha</label>
                        <input type="password" id="password_confirmation"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                            placeholder="Confirme a nova senha">
                    </div>
                </div>
                <p class="text-sm text-gray-500 mt-2">Deixe os campos em branco se não quiser alterar a senha</p>
            </div>

            <!-- Botões -->
            <div class="flex gap-4">
                <button type="submit" 
                    class="flex-1 bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center justify-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Salvar Alterações
                </button>
                <a href="/events" 
                    class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition text-center">
                    Cancelar
                </a>
            </div>
        </form>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        // Carregar dados do perfil
        window.addEventListener('DOMContentLoaded', async function() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/profile`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const user = await response.json();
                    populateForm(user);
                }
            } catch (error) {
                console.error('Erro ao carregar perfil:', error);
            }
        });

        function populateForm(user) {
            document.getElementById('user-name').textContent = user.name;
            document.getElementById('name').value = user.name || '';
            document.getElementById('email').value = user.email || '';
            document.getElementById('cpf').value = user.cpf || '';
            document.getElementById('telefone').value = user.telefone || '';
            document.getElementById('matricula').value = user.matricula || '';
            document.getElementById('curso').value = user.curso || '';
            document.getElementById('semestre').value = user.semestre || '';
            document.getElementById('institution').value = user.institution || '';
        }

        // Máscaras
        document.getElementById('cpf').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d)/, '$1.$2');
                value = value.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                e.target.value = value;
            }
        });

        document.getElementById('telefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length <= 11) {
                value = value.replace(/(\d{2})(\d)/, '($1) $2');
                value = value.replace(/(\d{5})(\d)/, '$1-$2');
                e.target.value = value;
            }
        });

        // Salvar perfil
        document.getElementById('profileForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const formData = {
                name: document.getElementById('name').value,
                email: document.getElementById('email').value,
                cpf: document.getElementById('cpf').value,
                telefone: document.getElementById('telefone').value,
                matricula: document.getElementById('matricula').value,
                curso: document.getElementById('curso').value,
                semestre: document.getElementById('semestre').value,
                institution: document.getElementById('institution').value,
            };

            const password = document.getElementById('password').value;
            const passwordConfirmation = document.getElementById('password_confirmation').value;

            if (password) {
                if (password !== passwordConfirmation) {
                    alert('As senhas não coincidem!');
                    return;
                }
                formData.password = password;
                formData.password_confirmation = passwordConfirmation;
            }

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/profile`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(formData)
                });

                if (response.ok) {
                    const data = await response.json();
                    // Atualizar localStorage
                    localStorage.setItem('user', JSON.stringify(data.user));
                    alert('Perfil atualizado com sucesso!');
                    // Limpar campos de senha
                    document.getElementById('password').value = '';
                    document.getElementById('password_confirmation').value = '';
                } else {
                    const error = await response.json();
                    alert(error.message || 'Erro ao atualizar perfil');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao atualizar perfil');
            }
        });
    </script>
</body>
</html>
