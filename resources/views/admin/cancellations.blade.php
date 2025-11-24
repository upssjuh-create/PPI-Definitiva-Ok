<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Cancelamentos - CertificalFFar</title>
    
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
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f5f5f5;
        }
        
        .tab-active {
            border-bottom: 3px solid #1a5f3f;
            color: #1a5f3f;
            font-weight: 600;
        }
        
        .cancellation-card {
            transition: all 0.3s ease;
        }
        
        .cancellation-card:hover {
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
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
                        <h1 class="text-lg font-bold">CertificalFFar</h1>
                        <p class="text-sm text-white/90">Painel Administrativo</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="relative">
                        <button class="relative p-2 hover:bg-white/10 rounded-lg transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                            </svg>
                            <span class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center" id="notification-badge">0</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <span class="text-sm">Administrador</span>
                        <span class="text-sm font-semibold" id="admin-name">Admin IFFar</span>
                    </div>
                    <button onclick="logout()" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                        </svg>
                        <span class="text-sm">Sair</span>
                    </button>
                </div>
            </div>
        </div>
    </header>

    @include('admin.partials.nav')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Título -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Gerenciar Cancelamentos</h2>
            <p class="text-gray-600">Visualize e gerencie solicitações de cancelamento de inscrições</p>
        </div>

        <!-- Card de Estatística -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-4">
                    <div class="bg-red-100 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Total de Cancelamentos</p>
                        <p class="text-5xl font-bold text-gray-900" id="total-cancellations">0</p>
                    </div>
                </div>
                <span class="text-xs font-semibold text-red-600 bg-red-100 px-3 py-1 rounded">Total</span>
            </div>
        </div>

        <!-- Lista de Cancelamentos -->
        <div id="cancellations-list" class="space-y-6">
            <!-- Os cancelamentos serão carregados aqui -->
        </div>

        <!-- Loading -->
        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando cancelamentos...</p>
        </div>

        <!-- Sem Cancelamentos -->
        <div id="no-cancellations" class="text-center py-16 hidden">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhum cancelamento pendente</h3>
            <p class="text-gray-600">Todas as solicitações foram processadas</p>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('admin-name').textContent = user.name;
            }
            
            loadCancellations();
        });

        async function loadCancellations() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/cancellations`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    displayCancellations(data);
                    document.getElementById('total-cancellations').textContent = data.length;
                    document.getElementById('notification-badge').textContent = data.length;
                    document.getElementById('loading').style.display = 'none';
                } else {
                    throw new Error('Erro ao carregar cancelamentos');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar cancelamentos</p>';
            }
        }

        function displayCancellations(cancellations) {
            const list = document.getElementById('cancellations-list');
            const noCancellations = document.getElementById('no-cancellations');

            if (cancellations.length === 0) {
                list.innerHTML = '';
                noCancellations.classList.remove('hidden');
                return;
            }

            noCancellations.classList.add('hidden');

            list.innerHTML = cancellations.map(cancel => {
                const user = cancel.user;
                const event = cancel.event;

                return `
                    <div class="cancellation-card bg-white rounded-xl shadow-md p-6">
                        <!-- Título do Evento -->
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-2xl font-bold text-gray-900">${event.title}</h3>
                            <span class="bg-[#1a5f3f] text-white px-3 py-1 rounded text-sm font-semibold">${event.category}</span>
                        </div>

                        <!-- Informações do Aluno -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-4 pb-4 border-b">
                            <div>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                    <span>Aluno</span>
                                </div>
                                <p class="text-gray-900 font-medium">${user.name}</p>
                                <p class="text-gray-600 text-sm">Mat: ${user.registration_number || 'N/A'}</p>
                            </div>

                            <div>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                                    </svg>
                                    <span>Curso</span>
                                </div>
                                <p class="text-gray-900 font-medium">${user.course || 'N/A'}</p>
                                <p class="text-gray-600 text-sm">${user.semester ? user.semester + 'º Semestre' : ''}</p>
                            </div>

                            <div>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span>E-mail</span>
                                </div>
                                <p class="text-gray-900 font-medium text-sm">${user.email}</p>
                            </div>

                            <div>
                                <div class="flex items-center text-sm text-gray-600 mb-1">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span>Data do Cancelamento</span>
                                </div>
                                <p class="text-gray-900 font-medium">${formatDateTime(cancel.created_at)}</p>
                            </div>
                        </div>

                        <!-- Motivo do Cancelamento -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Motivo do Cancelamento:</p>
                            <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">${cancel.reason || 'Não informado'}</p>
                        </div>

                        <!-- Status -->
                        <div class="flex items-center justify-end">
                            <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-semibold ${cancel.status === 'approved' ? 'bg-green-100 text-green-800' : cancel.status === 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800'}">
                                ${cancel.status === 'approved' ? 'Cancelado' : cancel.status === 'rejected' ? 'Rejeitado' : 'Pendente'}
                            </span>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function formatDateTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { 
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }



        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
