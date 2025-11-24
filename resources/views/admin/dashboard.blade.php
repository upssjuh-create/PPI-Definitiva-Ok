<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Administrativo - CertificalFFar</title>
    
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
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-3px);
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
                            <span class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">0</span>
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
        <!-- Banner de Boas-vindas -->
        <div class="bg-gradient-to-r from-[#1a5f3f] to-[#155030] rounded-xl p-8 mb-8 text-white shadow-lg">
            <h2 class="text-3xl font-bold mb-2">Bem-vindo ao Painel Administrativo!</h2>
            <p class="text-white/90">Gerencie todos os eventos do IFFar em um só lugar. Crie novos eventos, acompanhe inscrições e analise estatísticas.</p>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total de Eventos -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-blue-100 w-12 h-12 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-blue-600 bg-blue-100 px-2 py-1 rounded">Total</span>
                </div>
                <p class="text-gray-600 text-sm mb-1">Total de Eventos</p>
                <p class="text-4xl font-bold text-gray-900" id="total-events">0</p>
            </div>

            <!-- Total de Inscrições -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-green-100 w-12 h-12 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-green-600 bg-green-100 px-2 py-1 rounded">Inscritos</span>
                </div>
                <p class="text-gray-600 text-sm mb-1">Total de Inscrições</p>
                <p class="text-4xl font-bold text-gray-900" id="total-registrations">0</p>
            </div>

            <!-- Receita Total -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-purple-100 w-12 h-12 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-purple-600 bg-purple-100 px-2 py-1 rounded">Receita</span>
                </div>
                <p class="text-gray-600 text-sm mb-1">Receita Total</p>
                <p class="text-4xl font-bold text-gray-900">R$ <span id="total-revenue">0,00</span></p>
            </div>

            <!-- Eventos Pagos -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between mb-4">
                    <div class="bg-orange-100 w-12 h-12 rounded-lg flex items-center justify-center">
                        <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                    <span class="text-xs font-semibold text-orange-600 bg-orange-100 px-2 py-1 rounded">Pagos</span>
                </div>
                <p class="text-gray-600 text-sm mb-1">Eventos Pagos</p>
                <p class="text-4xl font-bold text-gray-900" id="paid-events">0</p>
            </div>
        </div>

        <!-- Eventos Recentes -->
        <div class="bg-white rounded-xl shadow-md p-6">
            <div class="flex items-center justify-between mb-6">
                <h3 class="text-2xl font-bold text-gray-900">Eventos Recentes</h3>
                <button onclick="window.location.href='/admin/events'" class="text-[#1a5f3f] hover:text-[#155030] font-semibold text-sm flex items-center">
                    Ver todos
                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>
            </div>

            <!-- Lista de Eventos -->
            <div id="events-list" class="space-y-4">
                <!-- Os eventos serão carregados aqui -->
            </div>

            <!-- Loading -->
            <div id="loading" class="text-center py-12">
                <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
                <p class="mt-4 text-gray-600">Carregando eventos...</p>
            </div>

            <!-- Sem Eventos -->
            <div id="no-events" class="text-center py-12 hidden">
                <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Nenhum evento cadastrado</h3>
                <p class="text-gray-600 mb-6">Comece criando seu primeiro evento</p>
                <button onclick="window.location.href='/admin/events/create'" class="bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition">
                    Criar Evento
                </button>
            </div>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('admin-name').textContent = user.name;
            }
            
            loadDashboard();
        });

        async function loadDashboard() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/dashboard`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    updateStats(data.stats);
                    displayEvents(data.recent_events);
                    document.getElementById('loading').style.display = 'none';
                } else {
                    throw new Error('Erro ao carregar dashboard');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar dados</p>';
            }
        }

        function updateStats(stats) {
            document.getElementById('total-events').textContent = stats.total_events || 0;
            document.getElementById('total-registrations').textContent = stats.total_registrations || 0;
            document.getElementById('total-revenue').textContent = formatMoney(stats.total_revenue || 0);
            document.getElementById('paid-events').textContent = stats.paid_events || 0;
        }

        function displayEvents(events) {
            const list = document.getElementById('events-list');
            const noEvents = document.getElementById('no-events');

            if (!events || events.length === 0) {
                list.innerHTML = '';
                noEvents.classList.remove('hidden');
                return;
            }

            noEvents.classList.add('hidden');

            list.innerHTML = events.map(event => `
                <div class="flex items-center justify-between p-4 border border-gray-200 rounded-lg hover:border-[#1a5f3f] transition">
                    <div class="flex-1">
                        <div class="flex items-center space-x-3 mb-2">
                            <h4 class="text-lg font-semibold text-gray-900">${event.title}</h4>
                            <span class="bg-[#1a5f3f] text-white px-3 py-1 rounded text-xs font-semibold">${event.category}</span>
                        </div>
                        <div class="flex items-center space-x-6 text-sm text-gray-600">
                            <span>${formatDate(event.date)} • ${event.time}</span>
                            <span>${event.registrations_count || 0}/${event.capacity} inscritos</span>
                            <span class="${event.price > 0 ? 'text-green-600 font-semibold' : 'text-gray-600'}">${event.price > 0 ? 'R$ ' + formatMoney(event.price) : 'Gratuito'}</span>
                        </div>
                    </div>
                    <button onclick="window.location.href='/admin/events/${event.id}'" class="text-[#1a5f3f] hover:text-[#155030] font-semibold text-sm">
                        Ver detalhes →
                    </button>
                </div>
            `).join('');
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
        }

        function formatMoney(value) {
            return parseFloat(value).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
