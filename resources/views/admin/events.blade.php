<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Eventos - CertificalFFar</title>
    
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
        
        .event-card {
            transition: all 0.3s ease;
        }
        
        .event-card:hover {
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
                            <span class="absolute top-1 right-1 bg-red-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center">3</span>
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
        <!-- Título e Botão -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h2 class="text-3xl font-bold text-gray-900 mb-2">Gerenciar Eventos</h2>
                <p class="text-gray-600">Crie, edite ou exclua eventos</p>
            </div>
            <button onclick="window.location.href='/admin/events/create'" class="bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Criar Novo Evento
            </button>
        </div>

        <!-- Filtros -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <div class="flex items-center mb-4">
                <svg class="w-5 h-5 text-gray-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <h3 class="text-lg font-semibold text-gray-900">Filtros</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <!-- Status do Evento -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Status do Evento</label>
                    <select id="status-filter" onchange="filterEvents()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                        <option value="">Todos os Status</option>
                        <option value="active">Ativos</option>
                        <option value="completed">Concluídos</option>
                        <option value="inactive">Inativos</option>
                    </select>
                </div>

                <!-- Categoria -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Categoria</label>
                    <select id="category-filter" onchange="filterEvents()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                        <option value="">Todas as Categorias</option>
                        <option value="Tecnologia">Tecnologia</option>
                        <option value="Workshop">Workshop</option>
                        <option value="Palestra">Palestra</option>
                        <option value="Minicurso">Minicurso</option>
                        <option value="Semana Acadêmica">Semana Acadêmica</option>
                    </select>
                </div>

                <!-- Buscar Evento -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Buscar Evento</label>
                    <div class="relative">
                        <input 
                            type="text" 
                            id="search-input"
                            placeholder="Nome, descrição ou local..."
                            class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"
                            onkeyup="filterEvents()"
                        >
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Contador -->
            <div class="mt-4 text-sm text-gray-600">
                <span id="event-count">Mostrando 0 de 0 eventos</span>
            </div>
        </div>

        <!-- Lista de Eventos -->
        <div id="events-list" class="space-y-6">
            <!-- Os eventos serão carregados aqui -->
        </div>

        <!-- Loading -->
        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando eventos...</p>
        </div>

        <!-- Sem Eventos -->
        <div id="no-events" class="text-center py-16 hidden">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhum evento encontrado</h3>
            <p class="text-gray-600 mb-6">Crie seu primeiro evento para começar</p>
            <button onclick="window.location.href='/admin/events/create'" class="bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition">
                Criar Evento
            </button>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let allEvents = [];

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('admin-name').textContent = user.name;
            }
            
            loadEvents();
        });

        async function loadEvents() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    allEvents = data;
                    displayEvents(allEvents);
                    document.getElementById('loading').style.display = 'none';
                } else {
                    throw new Error('Erro ao carregar eventos');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar eventos</p>';
            }
        }

        function filterEvents() {
            const status = document.getElementById('status-filter').value;
            const category = document.getElementById('category-filter').value;
            const search = document.getElementById('search-input').value.toLowerCase();

            const filtered = allEvents.filter(event => {
                const matchesStatus = !status || 
                    (status === 'active' && event.is_active && !event.is_completed) ||
                    (status === 'completed' && event.is_completed) ||
                    (status === 'inactive' && !event.is_active);
                
                const matchesCategory = !category || event.category === category;
                
                const matchesSearch = !search || 
                    event.title.toLowerCase().includes(search) ||
                    event.description.toLowerCase().includes(search) ||
                    event.location.toLowerCase().includes(search);

                return matchesStatus && matchesCategory && matchesSearch;
            });

            displayEvents(filtered);
        }

        function displayEvents(events) {
            const list = document.getElementById('events-list');
            const noEvents = document.getElementById('no-events');
            const eventCount = document.getElementById('event-count');

            if (events.length === 0) {
                list.innerHTML = '';
                noEvents.classList.remove('hidden');
                eventCount.textContent = 'Mostrando 0 de 0 eventos';
                return;
            }

            noEvents.classList.add('hidden');
            eventCount.textContent = `Mostrando ${events.length} de ${allEvents.length} eventos`;

            list.innerHTML = events.map(event => {
                const isCompleted = event.is_completed;
                const registrations = event.registrations_count || 0;

                return `
                    <div class="event-card bg-white rounded-xl overflow-hidden shadow-md">
                        <div class="flex flex-col md:flex-row">
                            <!-- Imagem -->
                            <div class="md:w-64 h-48 md:h-auto bg-gradient-to-br from-[#1a5f3f] to-[#155030] relative">
                                ${event.image ? `<img src="${event.image}" alt="${event.title}" class="w-full h-full object-cover">` : ''}
                                <div class="absolute top-3 left-3">
                                    <span class="bg-[#1a5f3f] text-white px-3 py-1 rounded text-sm font-semibold">${event.category}</span>
                                </div>
                                ${isCompleted ? `
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Concluído
                                        </span>
                                    </div>
                                ` : ''}
                            </div>

                            <!-- Conteúdo -->
                            <div class="flex-1 p-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">${event.title}</h3>
                                <p class="text-gray-600 mb-4 line-clamp-2">${event.description}</p>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Data e Horário</p>
                                        <p class="text-gray-900 font-medium">${formatDate(event.date)} • ${event.time}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Local</p>
                                        <p class="text-gray-900 font-medium">${event.location}</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Capacidade</p>
                                        <p class="text-gray-900 font-medium">${registrations}/${event.capacity} inscritos</p>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Preço</p>
                                        <p class="text-gray-900 font-medium ${event.price > 0 ? 'text-green-600' : ''}">${event.price > 0 ? 'R$ ' + formatMoney(event.price) : 'Gratuito'}</p>
                                    </div>
                                </div>

                                <!-- Botões -->
                                <div class="flex flex-wrap gap-3">
                                    ${isCompleted ? `
                                        <button onclick="viewReport(${event.id})" class="bg-green-700 text-white px-4 py-2 rounded-lg font-semibold hover:bg-green-800 transition flex items-center shadow-md">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            Ver Relatório Completo
                                        </button>
                                    ` : `
                                        <button onclick="viewEvent(${event.id})" class="bg-gray-100 text-gray-700 px-4 py-2 rounded-lg font-semibold hover:bg-gray-200 transition flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                                            </svg>
                                            Visualizar
                                        </button>
                                    `}
                                    
                                    <button onclick="editEvent(${event.id})" class="bg-blue-50 text-blue-600 px-4 py-2 rounded-lg font-semibold hover:bg-blue-100 transition flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                        </svg>
                                        Editar
                                    </button>

                                    <button onclick="generateQRCode(${event.id})" class="bg-green-50 text-green-600 px-4 py-2 rounded-lg font-semibold hover:bg-green-100 transition flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                                        </svg>
                                        QR Code
                                    </button>

                                    <button onclick="deleteEvent(${event.id})" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-100 transition flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                        Excluir
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
        }

        function formatMoney(value) {
            return parseFloat(value).toLocaleString('pt-BR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function viewEvent(eventId) {
            window.location.href = `/admin/events/${eventId}`;
        }

        function viewReport(eventId) {
            window.location.href = `/admin/events/${eventId}/report`;
        }

        function editEvent(eventId) {
            window.location.href = `/admin/events/${eventId}/edit`;
        }

        function generateQRCode(eventId) {
            window.location.href = `/admin/events/${eventId}/qrcode`;
        }

        async function deleteEvent(eventId) {
            if (!confirm('Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.')) return;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/events/${eventId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    alert('Evento excluído com sucesso!');
                    loadEvents();
                } else {
                    const data = await response.json();
                    alert(data.message || 'Erro ao excluir evento');
                }
            } catch (error) {
                alert('Erro ao excluir evento');
            }
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
