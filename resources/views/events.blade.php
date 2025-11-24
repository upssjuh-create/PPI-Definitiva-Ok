<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema de Eventos IFFar</title>
    
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <!-- Tailwind CSS -->
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
        
        .event-card {
            transition: all 0.3s ease;
        }
        
        .event-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, #1a5f3f 0%, #155030 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 95, 63, 0.3);
        }
        
        .tag {
            display: inline-block;
            padding: 4px 12px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: 500;
            margin-right: 8px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-[#1a5f3f] text-white shadow-lg">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <!-- Logo e Título -->
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

                <!-- User Info e Botões -->
                <div class="flex items-center space-x-4">
                    <button onclick="window.location.href='/profile'" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span class="text-sm" id="user-name">João Silva</span>
                    </button>
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

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Título e Botões -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Eventos do Campus</h2>
            <p class="text-gray-600 mb-6">Descubra e inscreva-se nos próximos eventos do campus</p>
            
            <div class="flex items-center justify-between">
                <!-- Barra de Busca -->
                <div class="flex-1 max-w-2xl">
                    <div class="relative">
                        <input 
                            type="text" 
                            id="search-input"
                            placeholder="Buscar eventos por nome, descrição ou tags..."
                            class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"
                            onkeyup="filterEvents()"
                        >
                        <svg class="w-5 h-5 text-gray-400 absolute left-3 top-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Botões -->
                <div class="flex items-center space-x-3 ml-4">
                    <button onclick="window.location.href='/my-registrations'" class="flex items-center space-x-2 bg-white border-2 border-gray-300 hover:border-[#1a5f3f] px-4 py-2 rounded-lg transition">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <span>Minhas Inscrições</span>
                    </button>
                    
                    <button onclick="window.location.href='/completed-events'" class="flex items-center space-x-2 btn-primary text-white px-4 py-2 rounded-lg">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <span>Eventos Concluídos</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Filtro de Categorias -->
        <div class="mb-6">
            <div class="flex items-center space-x-2">
                <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"/>
                </svg>
                <select id="category-filter" onchange="filterEvents()" class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                    <option value="">Todas as Categorias</option>
                    <option value="Tecnologia">Tecnologia</option>
                    <option value="Workshop">Workshop</option>
                    <option value="Palestra">Palestra</option>
                    <option value="Minicurso">Minicurso</option>
                    <option value="Semana Acadêmica">Semana Acadêmica</option>
                </select>
            </div>
        </div>

        <!-- Contador de Eventos -->
        <div class="mb-6">
            <p class="text-gray-600" id="event-count">7 eventos encontrados</p>
        </div>

        <!-- Grid de Eventos -->
        <div id="events-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Os eventos serão carregados aqui via JavaScript -->
        </div>

        <!-- Loading -->
        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando eventos...</p>
        </div>

        <!-- Sem Resultados -->
        <div id="no-results" class="text-center py-12 hidden">
            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            <p class="text-gray-600 text-lg">Nenhum evento encontrado</p>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let allEvents = [];

        // Carregar dados do usuário
        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('user-name').textContent = user.name;
            }
            
            loadEvents();
        });

        // Carregar eventos
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

        // Exibir eventos
        function displayEvents(events) {
            const grid = document.getElementById('events-grid');
            const noResults = document.getElementById('no-results');
            const eventCount = document.getElementById('event-count');

            if (events.length === 0) {
                grid.innerHTML = '';
                noResults.classList.remove('hidden');
                eventCount.textContent = '0 eventos encontrados';
                return;
            }

            noResults.classList.add('hidden');
            eventCount.textContent = `${events.length} evento${events.length !== 1 ? 's' : ''} encontrado${events.length !== 1 ? 's' : ''}`;

            grid.innerHTML = events.map(event => `
                <div class="event-card bg-white rounded-xl overflow-hidden shadow-md">
                    <!-- Imagem -->
                    <div class="relative h-48 bg-gradient-to-br from-[#1a5f3f] to-[#155030]">
                        ${event.image ? `<img src="${event.image}" alt="${event.title}" class="w-full h-full object-cover">` : ''}
                        <div class="absolute top-3 left-3">
                            <span class="tag bg-white text-[#1a5f3f] font-semibold">${event.category}</span>
                        </div>
                    </div>

                    <!-- Conteúdo -->
                    <div class="p-5">
                        <h3 class="text-xl font-bold text-gray-900 mb-2">${event.title}</h3>
                        <p class="text-sm text-gray-600 mb-3">${event.organizer}</p>

                        <!-- Data e Local -->
                        <div class="space-y-2 mb-4">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                ${formatDate(event.date)} • ${event.time}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                </svg>
                                ${event.location}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                </svg>
                                ${event.registered_count || 0}/${event.capacity} inscritos
                            </div>
                        </div>

                        <!-- Descrição -->
                        <p class="text-sm text-gray-600 mb-4 line-clamp-2">${event.description}</p>

                        <!-- Tags -->
                        ${event.tags && event.tags.length > 0 ? `
                            <div class="mb-4">
                                ${event.tags.slice(0, 3).map(tag => `<span class="tag bg-gray-100 text-gray-700">${tag}</span>`).join('')}
                            </div>
                        ` : ''}

                        <!-- Aviso de Inscrição -->
                        ${event.is_user_registered ? `
                            <div class="mb-3 bg-red-50 border-2 border-red-600 rounded-lg p-3">
                                <div class="flex items-center">
                                    <svg class="w-5 h-5 text-red-600 mr-2 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <div class="flex-1">
                                        <p class="text-sm font-bold text-red-900">VOCÊ JÁ ESTÁ INSCRITO!</p>
                                        ${parseFloat(event.price) > 0 ? `
                                            ${event.user_registration && event.user_registration.payment && event.user_registration.payment.status === 'pending' ? `
                                                <p class="text-xs text-orange-700 mt-1 font-semibold">⚠️ Pagamento pendente - Pague até 1 dia antes do evento</p>
                                            ` : event.user_registration && event.user_registration.payment && event.user_registration.payment.status === 'paid' ? `
                                                <p class="text-xs text-green-700 mt-1 font-semibold">✅ Pagamento confirmado</p>
                                            ` : ''}
                                        ` : `
                                            <p class="text-xs text-green-700 mt-1 font-semibold">✅ Inscrição confirmada (Gratuito)</p>
                                        `}
                                    </div>
                                </div>
                            </div>
                        ` : ''}

                        <!-- Botões -->
                        <div class="space-y-2">
                            <button onclick="viewDetails(${event.id})" class="w-full btn-primary text-white py-3 rounded-lg font-semibold">
                                Ver Detalhes
                            </button>
                            <button onclick="shareEvent(${event.id})" class="w-full flex items-center justify-center space-x-2 border-2 border-gray-300 hover:border-[#1a5f3f] py-2 rounded-lg transition">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                                <span class="text-sm">Compartilhar</span>
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        // Filtrar eventos
        function filterEvents() {
            const searchTerm = document.getElementById('search-input').value.toLowerCase();
            const category = document.getElementById('category-filter').value;

            const filtered = allEvents.filter(event => {
                const matchesSearch = event.title.toLowerCase().includes(searchTerm) ||
                                    event.description.toLowerCase().includes(searchTerm) ||
                                    (event.tags && event.tags.some(tag => tag.toLowerCase().includes(searchTerm)));
                
                const matchesCategory = !category || event.category === category;

                return matchesSearch && matchesCategory;
            });

            displayEvents(filtered);
        }

        // Formatar data
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
        }

        // Ver detalhes
        function viewDetails(eventId) {
            window.location.href = `/events/${eventId}`;
        }

        // Compartilhar evento
        function shareEvent(eventId) {
            const url = `${window.location.origin}/events/${eventId}`;
            if (navigator.share) {
                navigator.share({
                    title: 'Evento IFFar',
                    url: url
                });
            } else {
                navigator.clipboard.writeText(url);
                alert('Link copiado para a área de transferência!');
            }
        }

        // Logout
        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
