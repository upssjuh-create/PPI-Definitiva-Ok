<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Visualizar Evento - CertificalFFar</title>
    
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
        <!-- Botão Voltar -->
        <button onclick="window.location.href='/admin/events'" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Eventos
        </button>

        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando evento...</p>
        </div>

        <div id="event-content" class="hidden">
            <!-- Banner do Evento -->
            <div class="relative h-64 md:h-80 rounded-xl overflow-hidden mb-8 shadow-lg">
                <div id="event-banner" class="w-full h-full bg-gradient-to-br from-[#1a5f3f] to-[#155030]"></div>
                <div class="absolute top-4 left-4">
                    <span id="event-category" class="bg-white text-[#1a5f3f] px-4 py-2 rounded-lg font-semibold text-sm"></span>
                </div>
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-6">
                    <h1 id="event-title" class="text-3xl md:text-4xl font-bold text-white"></h1>
                </div>
            </div>

            <!-- Ações do Evento -->
            <div class="flex flex-wrap gap-3 mb-8">
                <button onclick="editEvent()" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                    </svg>
                    Editar Evento
                </button>
                <button onclick="deleteEvent()" class="bg-red-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-700 transition flex items-center shadow-md">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                    Excluir Evento
                </button>
            </div>

            <!-- Cards de Informações -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Data e Hora -->
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="flex items-center mb-3">
                        <div class="bg-blue-100 p-3 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Data e Hora</p>
                        </div>
                    </div>
                    <p id="event-date" class="text-lg font-semibold text-gray-900"></p>
                    <p id="event-time" class="text-sm text-gray-600"></p>
                </div>

                <!-- Local -->
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="flex items-center mb-3">
                        <div class="bg-purple-100 p-3 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Local</p>
                        </div>
                    </div>
                    <p id="event-location" class="text-lg font-semibold text-gray-900"></p>
                </div>

                <!-- Inscrições -->
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="flex items-center mb-3">
                        <div class="bg-green-100 p-3 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Inscrições</p>
                        </div>
                    </div>
                    <p id="event-registrations" class="text-lg font-semibold text-gray-900"></p>
                    <p id="event-spots" class="text-sm text-gray-600"></p>
                </div>

                <!-- Investimento -->
                <div class="bg-white rounded-xl p-6 shadow-md">
                    <div class="flex items-center mb-3">
                        <div class="bg-orange-100 p-3 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Investimento</p>
                        </div>
                    </div>
                    <p id="event-price" class="text-lg font-semibold text-gray-900"></p>
                </div>
            </div>

            <!-- Sobre o Evento -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <h2 class="text-2xl font-bold text-gray-900 mb-4">Sobre o Evento</h2>
                <p id="event-description" class="text-gray-700 leading-relaxed"></p>
            </div>

            <!-- Lista de Inscritos (apenas para eventos não concluídos) -->
            <div id="registrations-section" class="bg-white rounded-xl shadow-md p-6 mb-8 hidden">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Participantes Inscritos</h2>
                        <p class="text-sm text-gray-600 mt-1">Lista de pessoas que se inscreveram no evento</p>
                    </div>
                    <div class="flex items-center space-x-3">
                        <span id="registrations-count" class="bg-[#1a5f3f] text-white px-4 py-2 rounded-lg font-semibold">0 inscritos</span>
                        <button onclick="exportRegistrations()" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                            </svg>
                            Exportar
                        </button>
                    </div>
                </div>

                <!-- Filtros -->
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Buscar por Nome</label>
                            <input 
                                type="text" 
                                id="filter-name"
                                placeholder="Digite o nome..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"
                                onkeyup="filterRegistrations()"
                            >
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Curso</label>
                            <select 
                                id="filter-course"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"
                                onchange="filterRegistrations()"
                            >
                                <option value="">Todos os cursos</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Filtrar por Semestre</label>
                            <select 
                                id="filter-semester"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"
                                onchange="filterRegistrations()"
                            >
                                <option value="">Todos os semestres</option>
                            </select>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <span id="filtered-count" class="text-sm text-gray-600">Mostrando 0 de 0 inscritos</span>
                        <button onclick="clearFilters()" class="text-sm text-[#1a5f3f] hover:text-[#155030] font-medium">
                            Limpar filtros
                        </button>
                    </div>
                </div>

                <!-- Tabela de Inscritos -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b-2 border-gray-200">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Nome</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Email</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Curso</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Semestre</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Status</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Pagamento</th>
                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">Data</th>
                            </tr>
                        </thead>
                        <tbody id="registrations-table" class="divide-y divide-gray-200">
                            <!-- Inscritos serão carregados aqui -->
                        </tbody>
                    </table>
                </div>

                <!-- Mensagem quando não há inscritos -->
                <div id="no-registrations" class="text-center py-12 hidden">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <p class="text-gray-500 font-medium">Nenhum inscrito ainda</p>
                    <p class="text-sm text-gray-400 mt-2">Quando alguém se inscrever no evento, aparecerá aqui.</p>
                </div>
            </div>

            <!-- Perguntas dos Participantes -->
            <div class="bg-white rounded-xl shadow-md p-6">
                <div class="flex items-center justify-between mb-6">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900">Perguntas dos Participantes</h2>
                        <p id="questions-status" class="text-sm text-gray-600 mt-1"></p>
                    </div>
                    <span id="questions-count" class="bg-[#1a5f3f] text-white px-4 py-2 rounded-lg font-semibold">0 perguntas</span>
                </div>

                <div id="admin-questions-list" class="space-y-4">
                    <!-- Perguntas serão carregadas aqui -->
                </div>

                <!-- Mensagem quando não há perguntas -->
                <div id="admin-no-questions" class="text-center py-12 hidden">
                    <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                    </svg>
                    <p class="text-gray-500">Nenhuma pergunta ainda</p>
                    <p class="text-sm text-gray-400 mt-2">Quando os participantes fizerem perguntas sobre este evento, elas aparecerão aqui.</p>
                </div>
            </div>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let currentEvent = null;

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('admin-name').textContent = user.name;
            }
            
            const eventId = getEventIdFromUrl();
            if (eventId) {
                loadEvent(eventId);
            }
        });

        function getEventIdFromUrl() {
            const path = window.location.pathname;
            const match = path.match(/\/admin\/events\/(\d+)/);
            return match ? match[1] : null;
        }

        async function loadEvent(eventId) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events/${eventId}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    currentEvent = await response.json();
                    displayEvent(currentEvent);
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('event-content').classList.remove('hidden');
                    
                    // Carregar inscritos se o evento não foi concluído
                    if (!currentEvent.is_completed) {
                        loadRegistrations(eventId);
                    }
                    
                    // Carregar perguntas
                    loadAdminQuestions();
                } else {
                    throw new Error('Erro ao carregar evento');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar evento</p>';
            }
        }

        function displayEvent(event) {
            // Banner
            if (event.image) {
                document.getElementById('event-banner').style.backgroundImage = `url(${event.image})`;
                document.getElementById('event-banner').style.backgroundSize = 'cover';
                document.getElementById('event-banner').style.backgroundPosition = 'center';
            }

            // Informações básicas
            document.getElementById('event-category').textContent = event.category;
            document.getElementById('event-title').textContent = event.title;

            // Cards de informações
            document.getElementById('event-date').textContent = formatDate(event.date);
            document.getElementById('event-time').textContent = event.time;
            document.getElementById('event-location').textContent = event.location;
            
            const registered = event.registered_count || 0;
            const capacity = event.capacity;
            const spotsRemaining = capacity - registered;
            
            document.getElementById('event-registrations').textContent = `${registered} / ${capacity}`;
            document.getElementById('event-spots').textContent = spotsRemaining > 0 
                ? `${spotsRemaining} vagas disponíveis` 
                : 'Evento lotado';
            
            document.getElementById('event-price').textContent = event.price > 0 
                ? `R$ ${parseFloat(event.price).toFixed(2)}` 
                : 'Gratuito';

            // Descrição
            document.getElementById('event-description').textContent = event.description;

            // Perguntas (placeholder - será implementado depois)
            document.getElementById('questions-count').textContent = '0 perguntas';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            const day = date.getDate();
            const month = date.toLocaleDateString('pt-BR', { month: 'long' });
            const year = date.getFullYear();
            return `${day} de ${month.charAt(0).toUpperCase() + month.slice(1)} de ${year}`;
        }

        let allRegistrations = [];
        let filteredRegistrations = [];

        async function loadRegistrations(eventId) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/events/${eventId}/registrations`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    allRegistrations = await response.json();
                    filteredRegistrations = [...allRegistrations];
                    
                    // Mostrar seção de inscritos
                    document.getElementById('registrations-section').classList.remove('hidden');
                    
                    // Preencher filtros
                    populateFilters();
                    
                    // Exibir inscritos
                    displayRegistrations();
                }
            } catch (error) {
                console.error('Erro ao carregar inscritos:', error);
            }
        }

        function populateFilters() {
            // Extrair cursos únicos
            const courses = [...new Set(allRegistrations.map(r => r.user.curso || r.user.course).filter(c => c))];
            const courseSelect = document.getElementById('filter-course');
            courseSelect.innerHTML = '<option value="">Todos os cursos</option>';
            courses.forEach(course => {
                courseSelect.innerHTML += `<option value="${course}">${course}</option>`;
            });

            // Extrair semestres únicos
            const semesters = [...new Set(allRegistrations.map(r => r.user.semester).filter(s => s))];
            const semesterSelect = document.getElementById('filter-semester');
            semesterSelect.innerHTML = '<option value="">Todos os semestres</option>';
            semesters.sort((a, b) => a - b).forEach(semester => {
                semesterSelect.innerHTML += `<option value="${semester}">${semester}º Semestre</option>`;
            });
        }

        function filterRegistrations() {
            const nameFilter = document.getElementById('filter-name').value.toLowerCase();
            const courseFilter = document.getElementById('filter-course').value;
            const semesterFilter = document.getElementById('filter-semester').value;

            filteredRegistrations = allRegistrations.filter(registration => {
                const matchesName = !nameFilter || 
                    registration.user.name.toLowerCase().includes(nameFilter) ||
                    registration.user.email.toLowerCase().includes(nameFilter);
                
                const matchesCourse = !courseFilter || (registration.user.curso || registration.user.course) === courseFilter;
                const matchesSemester = !semesterFilter || (registration.user.semestre || registration.user.semester) == semesterFilter;

                return matchesName && matchesCourse && matchesSemester;
            });

            displayRegistrations();
        }

        function clearFilters() {
            document.getElementById('filter-name').value = '';
            document.getElementById('filter-course').value = '';
            document.getElementById('filter-semester').value = '';
            filterRegistrations();
        }

        function displayRegistrations() {
            const table = document.getElementById('registrations-table');
            const noRegistrations = document.getElementById('no-registrations');
            const registrationsCount = document.getElementById('registrations-count');
            const filteredCount = document.getElementById('filtered-count');

            registrationsCount.textContent = `${allRegistrations.length} inscrito${allRegistrations.length !== 1 ? 's' : ''}`;
            filteredCount.textContent = `Mostrando ${filteredRegistrations.length} de ${allRegistrations.length} inscritos`;

            if (allRegistrations.length === 0) {
                table.innerHTML = '';
                noRegistrations.classList.remove('hidden');
                return;
            }

            noRegistrations.classList.add('hidden');

            if (filteredRegistrations.length === 0) {
                table.innerHTML = `
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            Nenhum inscrito encontrado com os filtros aplicados
                        </td>
                    </tr>
                `;
                return;
            }

            table.innerHTML = filteredRegistrations.map(registration => {
                const statusColors = {
                    'confirmed': 'bg-green-100 text-green-800',
                    'pending': 'bg-yellow-100 text-yellow-800',
                    'cancelled': 'bg-red-100 text-red-800'
                };

                const statusLabels = {
                    'confirmed': 'Confirmado',
                    'pending': 'Pendente',
                    'cancelled': 'Cancelado'
                };
                
                // Verificar se é usuário externo
                const isExternal = registration.user.user_type === 'externo' || registration.user.user_type === 'external';
                const rowClass = isExternal ? 'hover:bg-blue-50 bg-blue-50/30' : 'hover:bg-gray-50';
                
                // Determinar o que mostrar na coluna Curso
                let courseDisplay = '-';
                if (isExternal) {
                    courseDisplay = `<div class="flex items-center">
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-bold rounded mr-2">EXTERNO</span>
                        <span class="text-xs text-gray-600">${registration.user.institution || 'Instituição não informada'}</span>
                    </div>`;
                } else {
                    courseDisplay = registration.user.curso || registration.user.course || '-';
                }
                
                // Determinar o que mostrar na coluna Semestre
                let semesterDisplay = '-';
                if (isExternal) {
                    semesterDisplay = '<span class="text-xs text-gray-400 italic">N/A</span>';
                } else {
                    semesterDisplay = registration.user.semestre || (registration.user.semester ? registration.user.semester + 'º' : '-');
                }

                return `
                    <tr class="${rowClass}">
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-900">${registration.user.name}</div>
                            ${isExternal ? '<div class="text-xs text-blue-600 font-semibold mt-1">👤 Participante Externo</div>' : ''}
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">${registration.user.email}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">${courseDisplay}</td>
                        <td class="px-4 py-3 text-sm text-gray-600">${semesterDisplay}</td>
                        <td class="px-4 py-3">
                            <span class="px-2 py-1 text-xs font-semibold rounded-full ${statusColors[registration.status] || 'bg-gray-100 text-gray-800'}">
                                ${statusLabels[registration.status] || registration.status}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            ${registration.payment ? 
                                `<span class="px-2 py-1 text-xs font-semibold rounded-full ${registration.payment.status === 'approved' ? 'bg-green-100 text-green-800' : registration.payment.status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800'}">
                                    ${registration.payment.status === 'approved' ? 'Pago' : registration.payment.status === 'pending' ? 'Pendente' : 'Não Pago'}
                                </span>` 
                                : '<span class="text-gray-400 text-xs">Gratuito</span>'
                            }
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600">${formatDate(registration.created_at)}</td>
                    </tr>
                `;
            }).join('');
        }

        let adminQuestions = [];

        // Carregar perguntas (Admin)
        async function loadAdminQuestions() {
            const eventId = getEventIdFromUrl();
            if (!eventId) return;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events/${eventId}/questions`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    adminQuestions = await response.json();
                    displayAdminQuestions();
                }
            } catch (error) {
                console.error('Erro ao carregar perguntas:', error);
            }
        }

        // Exibir perguntas (Admin)
        function displayAdminQuestions() {
            const list = document.getElementById('admin-questions-list');
            const noQuestions = document.getElementById('admin-no-questions');
            const questionsCount = document.getElementById('questions-count');
            const questionsStatus = document.getElementById('questions-status');

            const unanswered = adminQuestions.filter(q => !q.answer).length;
            questionsCount.textContent = `${adminQuestions.length} pergunta${adminQuestions.length !== 1 ? 's' : ''}`;
            
            if (unanswered > 0) {
                questionsStatus.textContent = `${unanswered} pergunta${unanswered !== 1 ? 's' : ''} aguardando resposta`;
                questionsStatus.className = 'text-sm text-orange-600 font-medium mt-1';
            } else if (adminQuestions.length > 0) {
                questionsStatus.textContent = 'Todas as perguntas foram respondidas!';
                questionsStatus.className = 'text-sm text-green-600 font-medium mt-1';
            } else {
                questionsStatus.textContent = '';
            }

            if (adminQuestions.length === 0) {
                list.innerHTML = '';
                noQuestions.classList.remove('hidden');
                return;
            }

            noQuestions.classList.add('hidden');

            list.innerHTML = adminQuestions.map(q => {
                const hasAnswer = q.answer !== null;

                return `
                    <div class="border border-gray-200 rounded-lg p-4 ${!hasAnswer ? 'bg-orange-50 border-orange-200' : 'bg-white'}">
                        <!-- Pergunta -->
                        <div class="flex items-start mb-3">
                            <div class="flex-shrink-0 mr-3">
                                <div class="w-10 h-10 rounded-full bg-[#1a5f3f] flex items-center justify-center text-white font-semibold">
                                    ${q.user.name.charAt(0).toUpperCase()}
                                </div>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-1">
                                    <div>
                                        <span class="font-semibold text-gray-900">${q.user.name}</span>
                                        <span class="text-sm text-gray-500 ml-2">${formatDateTime(q.created_at)}</span>
                                    </div>
                                    ${!hasAnswer ? '<span class="text-xs bg-orange-500 text-white px-2 py-1 rounded-full">Aguardando resposta</span>' : ''}
                                </div>
                                <p class="text-gray-700">${q.question}</p>
                            </div>
                        </div>

                        <!-- Resposta ou formulário -->
                        ${hasAnswer ? `
                            <div class="ml-13 pl-4 border-l-2 border-green-500 bg-green-50 rounded-r-lg p-3">
                                <div class="flex items-center justify-between mb-2">
                                    <div class="flex items-center">
                                        <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                        </svg>
                                        <span class="text-sm font-semibold text-green-800">Sua resposta</span>
                                        <span class="text-xs text-green-600 ml-2">${formatDateTime(q.answered_at)}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <button onclick="editAnswer(${q.id}, '${escapeHtml(q.answer)}')" class="text-blue-600 hover:text-blue-800 text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </button>
                                        <button onclick="deleteAnswer(${q.id})" class="text-red-600 hover:text-red-800 text-sm">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                <p class="text-gray-700">${q.answer}</p>
                            </div>
                        ` : `
                            <div class="ml-13 pl-4 border-l-2 border-gray-300 bg-white rounded-r-lg p-3">
                                <textarea 
                                    id="answer-${q.id}" 
                                    rows="3" 
                                    placeholder="Digite sua resposta..."
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f] resize-none mb-2"
                                ></textarea>
                                <button onclick="submitAnswer(${q.id})" class="bg-[#1a5f3f] text-white px-4 py-2 rounded-lg font-semibold hover:bg-[#155030] transition text-sm">
                                    Responder
                                </button>
                            </div>
                        `}
                    </div>
                `;
            }).join('');
        }

        // Responder pergunta
        async function submitAnswer(questionId) {
            const textarea = document.getElementById(`answer-${questionId}`);
            const answer = textarea.value.trim();

            if (!answer) {
                alert('Por favor, digite uma resposta');
                return;
            }

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/questions/${questionId}/answer`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ answer })
                });

                if (response.ok) {
                    loadAdminQuestions();
                } else {
                    alert('Erro ao enviar resposta');
                }
            } catch (error) {
                alert('Erro ao enviar resposta');
            }
        }

        // Editar resposta
        function editAnswer(questionId, currentAnswer) {
            const newAnswer = prompt('Editar resposta:', currentAnswer);
            if (!newAnswer || newAnswer === currentAnswer) return;

            updateAnswer(questionId, newAnswer);
        }

        async function updateAnswer(questionId, answer) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/questions/${questionId}/answer`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ answer })
                });

                if (response.ok) {
                    loadAdminQuestions();
                } else {
                    alert('Erro ao atualizar resposta');
                }
            } catch (error) {
                alert('Erro ao atualizar resposta');
            }
        }

        // Deletar resposta
        async function deleteAnswer(questionId) {
            if (!confirm('Tem certeza que deseja deletar esta resposta?')) return;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/questions/${questionId}/answer`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    loadAdminQuestions();
                } else {
                    alert('Erro ao deletar resposta');
                }
            } catch (error) {
                alert('Erro ao deletar resposta');
            }
        }

        function formatDateTime(dateString) {
            const date = new Date(dateString);
            return date.toLocaleString('pt-BR', { 
                day: '2-digit', 
                month: '2-digit', 
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
        }

        function escapeHtml(text) {
            return text.replace(/'/g, "\\'").replace(/"/g, '\\"');
        }

        function exportRegistrations() {
            // Criar CSV
            const headers = ['Nome', 'Email', 'Curso', 'Semestre', 'Status', 'Data de Inscrição'];
            const rows = filteredRegistrations.map(r => [
                r.user.name,
                r.user.email,
                r.user.curso || r.user.course || (r.user.user_type === 'external' ? 'Externo' : '-'),
                r.user.semestre || (r.user.semester ? r.user.semester + 'º' : (r.user.user_type === 'external' ? 'N/A' : '-')),
                r.status === 'confirmed' ? 'Confirmado' : r.status === 'pending' ? 'Pendente' : 'Cancelado',
                formatDate(r.created_at)
            ]);

            let csvContent = headers.join(',') + '\n';
            rows.forEach(row => {
                csvContent += row.map(cell => `"${cell}"`).join(',') + '\n';
            });

            // Download
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            link.setAttribute('href', url);
            link.setAttribute('download', `inscritos_${currentEvent.title.replace(/\s+/g, '_')}.csv`);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function editEvent() {
            const eventId = getEventIdFromUrl();
            if (eventId) {
                window.location.href = `/admin/events/${eventId}/edit`;
            }
        }

        async function deleteEvent() {
            if (!confirm('Tem certeza que deseja excluir este evento? Esta ação não pode ser desfeita.')) {
                return;
            }

            const eventId = getEventIdFromUrl();
            if (!eventId) return;

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
                    window.location.href = '/admin/events';
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
