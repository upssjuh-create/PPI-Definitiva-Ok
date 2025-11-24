<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Relatório do Evento - Sistema IFFar</title>
    
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
        
        .stat-card {
            transition: all 0.3s ease;
        }
        
        .stat-card:hover {
            transform: translateY(-2px);
        }
        
        .tab-active {
            color: #16a34a;
            border-bottom: 2px solid #16a34a;
            font-weight: 600;
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
                        <h1 class="text-lg font-bold">Sistema de Eventos IFFar - Painel Admin</h1>
                        <p class="text-sm text-white/90">Gerenciamento de Eventos Concluídos</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">👤 Admin</span>
                    <button onclick="logout()" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
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
        <button onclick="window.location.href='/admin/dashboard'" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Dashboard
        </button>

        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando relatório...</p>
        </div>

        <div id="report-content" class="hidden">
            <!-- Cabeçalho do Evento -->
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 id="event-title" class="text-3xl font-bold text-gray-900 mb-2"></h2>
                    <div class="flex items-center space-x-4 text-sm text-gray-600">
                        <div class="flex items-center">
                            <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-xs font-semibold mr-2">✓ Concluído</span>
                            <span id="event-category" class="bg-gray-100 text-gray-800 px-3 py-1 rounded-full text-xs font-semibold"></span>
                        </div>
                        <span>📅 <span id="event-date"></span></span>
                        <span>⏰ <span id="event-time"></span></span>
                        <span>📍 <span id="event-location"></span></span>
                    </div>
                </div>
                <button onclick="exportToCSV()" class="bg-green-700 text-white px-6 py-3 rounded-lg font-semibold hover:bg-green-800 transition flex items-center shadow-lg">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    Exportar Relatório
                </button>
            </div>

            <!-- Cards de Estatísticas -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <!-- Total de Inscritos -->
                <div class="stat-card bg-white rounded-xl p-6 shadow-md border-l-4 border-gray-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Total de Inscritos</p>
                            <p id="stat-total" class="text-3xl font-bold text-gray-900">0</p>
                        </div>
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Presentes -->
                <div class="stat-card bg-green-50 rounded-xl p-6 shadow-md border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-700 mb-1">Presentes <span id="stat-present-percent" class="text-xs">(0%)</span></p>
                            <p id="stat-present" class="text-3xl font-bold text-green-600">0</p>
                        </div>
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Ausentes -->
                <div class="stat-card bg-red-50 rounded-xl p-6 shadow-md border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-red-700 mb-1">Ausentes</p>
                            <p id="stat-absent" class="text-3xl font-bold text-red-600">0</p>
                        </div>
                        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Certificados Emitidos -->
                <div class="stat-card bg-blue-50 rounded-xl p-6 shadow-md border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-blue-700 mb-1">Certificados Emitidos</p>
                            <p id="stat-certificates" class="text-3xl font-bold text-blue-600">0</p>
                        </div>
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Cards de Pagamento -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
                <!-- Receita Total -->
                <div class="stat-card bg-white rounded-xl p-6 shadow-md border-l-4 border-gray-400">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-gray-600 mb-1">Receita Total</p>
                            <p id="stat-revenue" class="text-3xl font-bold text-gray-900">R$ 0,00</p>
                        </div>
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Pagos -->
                <div class="stat-card bg-green-50 rounded-xl p-6 shadow-md border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-green-700 mb-1">Pagos <span id="stat-paid-percent" class="text-xs">(0%)</span></p>
                            <p id="stat-paid" class="text-3xl font-bold text-green-600">0</p>
                        </div>
                        <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Pendentes -->
                <div class="stat-card bg-yellow-50 rounded-xl p-6 shadow-md border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-yellow-700 mb-1">Pendentes</p>
                            <p id="stat-pending" class="text-3xl font-bold text-yellow-600">0</p>
                        </div>
                        <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>

                <!-- Não Pagos -->
                <div class="stat-card bg-red-50 rounded-xl p-6 shadow-md border-l-4 border-red-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm text-red-700 mb-1">Não Pagos</p>
                            <p id="stat-unpaid" class="text-3xl font-bold text-red-600">0</p>
                        </div>
                        <svg class="w-12 h-12 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Filtros de Busca -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-lg font-semibold text-gray-900 mb-4">Filtros de Busca</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Buscar</label>
                        <input 
                            type="text" 
                            id="search-input"
                            placeholder="Nome, email ou matrícula..."
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"
                            onkeyup="filterRegistrations()"
                        >
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status-filter" onchange="filterRegistrations()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                            <option value="">Todos</option>
                            <option value="present">Presentes</option>
                            <option value="absent">Ausentes</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Curso</label>
                        <select id="course-filter" onchange="filterRegistrations()" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                            <option value="">Todos os Cursos</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tabs -->
            <div class="bg-white rounded-t-xl shadow-md">
                <div class="flex border-b">
                    <button onclick="switchTab('all')" id="tab-all" class="tab-active px-6 py-4 text-sm font-medium">
                        Todos (<span id="count-all">0</span>)
                    </button>
                    <button onclick="switchTab('present')" id="tab-present" class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-green-600">
                        Presentes (<span id="count-present">0</span>)
                    </button>
                    <button onclick="switchTab('absent')" id="tab-absent" class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-red-600">
                        Ausentes (<span id="count-absent">0</span>)
                    </button>
                    <button onclick="switchTab('paid')" id="tab-paid" class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-blue-600">
                        Pagos (<span id="count-paid">0</span>)
                    </button>
                    <button onclick="switchTab('unpaid')" id="tab-unpaid" class="px-6 py-4 text-sm font-medium text-gray-600 hover:text-red-600">
                        Não Pagos (<span id="count-unpaid">0</span>)
                    </button>
                </div>

                <!-- Tabela de Inscritos -->
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nome</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Matrícula</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Curso</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Semestre</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pagamento</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Check-in</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Certificado</th>
                            </tr>
                        </thead>
                        <tbody id="registrations-table" class="bg-white divide-y divide-gray-200">
                            <!-- Os dados serão carregados aqui -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let currentEvent = null;
        let allRegistrations = [];
        let filteredRegistrations = [];
        let currentTab = 'all';

        window.addEventListener('DOMContentLoaded', function() {
            const eventId = getEventIdFromUrl();
            if (eventId) {
                loadEventReport(eventId);
            }
        });

        function getEventIdFromUrl() {
            const path = window.location.pathname;
            const match = path.match(/\/admin\/events\/(\d+)\/report/);
            return match ? match[1] : null;
        }

        async function loadEventReport(eventId) {
            try {
                const token = localStorage.getItem('auth_token');
                
                // Carregar dados do evento
                const eventResponse = await fetch(`${API_BASE_URL}/api/events/${eventId}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (!eventResponse.ok) throw new Error('Erro ao carregar evento');
                
                currentEvent = await eventResponse.json();
                
                // Carregar inscrições
                const registrationsResponse = await fetch(`${API_BASE_URL}/api/admin/events/${eventId}/registrations`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (!registrationsResponse.ok) throw new Error('Erro ao carregar inscrições');
                
                allRegistrations = await registrationsResponse.json();
                filteredRegistrations = allRegistrations;
                
                displayEventInfo();
                calculateStats();
                populateCourseFilter();
                displayRegistrations();
                
                document.getElementById('loading').style.display = 'none';
                document.getElementById('report-content').classList.remove('hidden');
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar relatório</p>';
            }
        }

        function displayEventInfo() {
            document.getElementById('event-title').textContent = currentEvent.title;
            document.getElementById('event-category').textContent = currentEvent.category;
            document.getElementById('event-date').textContent = formatDate(currentEvent.date);
            document.getElementById('event-time').textContent = currentEvent.time;
            document.getElementById('event-location').textContent = currentEvent.location;
        }

        function calculateStats() {
            const total = allRegistrations.length;
            const present = allRegistrations.filter(r => r.checked_in).length;
            const absent = total - present;
            const certificates = allRegistrations.filter(r => r.certificate_id).length;
            
            const paid = allRegistrations.filter(r => r.payment && r.payment.status === 'paid').length;
            const pending = allRegistrations.filter(r => r.payment && r.payment.status === 'pending').length;
            const unpaid = allRegistrations.filter(r => !r.payment || r.payment.status === 'failed').length;
            
            const revenue = allRegistrations
                .filter(r => r.payment && r.payment.status === 'paid')
                .reduce((sum, r) => sum + parseFloat(r.payment.amount || 0), 0);

            // Atualizar cards
            document.getElementById('stat-total').textContent = total;
            document.getElementById('stat-present').textContent = present;
            document.getElementById('stat-present-percent').textContent = `(${((present/total)*100).toFixed(1)}%)`;
            document.getElementById('stat-absent').textContent = absent;
            document.getElementById('stat-certificates').textContent = certificates;
            
            document.getElementById('stat-revenue').textContent = `R$ ${revenue.toFixed(2).replace('.', ',')}`;
            document.getElementById('stat-paid').textContent = paid;
            document.getElementById('stat-paid-percent').textContent = `(${((paid/total)*100).toFixed(1)}%)`;
            document.getElementById('stat-pending').textContent = pending;
            document.getElementById('stat-unpaid').textContent = unpaid;

            // Atualizar contadores das tabs
            document.getElementById('count-all').textContent = total;
            document.getElementById('count-present').textContent = present;
            document.getElementById('count-absent').textContent = absent;
            document.getElementById('count-paid').textContent = paid;
            document.getElementById('count-unpaid').textContent = unpaid;
        }

        function populateCourseFilter() {
            const courses = [...new Set(allRegistrations.map(r => r.user.curso || r.user.course).filter(c => c))];
            const select = document.getElementById('course-filter');
            courses.forEach(course => {
                const option = document.createElement('option');
                option.value = course;
                option.textContent = course;
                select.appendChild(option);
            });
        }

        function displayRegistrations() {
            const tbody = document.getElementById('registrations-table');
            
            let dataToShow = filteredRegistrations;
            
            // Filtrar por tab
            if (currentTab === 'present') {
                dataToShow = dataToShow.filter(r => r.checked_in);
            } else if (currentTab === 'absent') {
                dataToShow = dataToShow.filter(r => !r.checked_in);
            } else if (currentTab === 'paid') {
                dataToShow = dataToShow.filter(r => r.payment && r.payment.status === 'paid');
            } else if (currentTab === 'unpaid') {
                dataToShow = dataToShow.filter(r => !r.payment || r.payment.status !== 'paid');
            }

            tbody.innerHTML = dataToShow.map(reg => {
                const user = reg.user;
                const payment = reg.payment;
                const isPresent = reg.checked_in;
                const hasCertificate = reg.certificate_id;
                
                return `
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">${user.name}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.matricula || user.registration_number || '-'}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.curso || user.course || (user.user_type === 'external' ? 'Externo' : '-')}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.semestre || user.semester || (user.user_type === 'external' ? 'N/A' : '-')}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">${user.email}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${getPaymentBadge(payment)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${getCheckInBadge(isPresent)}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            ${getCertificateBadge(hasCertificate)}
                        </td>
                    </tr>
                `;
            }).join('');
        }

        function getPaymentBadge(payment) {
            if (!payment) {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Gratuito</span>';
            }
            
            if (payment.status === 'paid') {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">✓ Pago</span>';
            } else if (payment.status === 'pending') {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">⏳ Pendente</span>';
            } else {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">✗ Não Pago</span>';
            }
        }

        function getCheckInBadge(isPresent) {
            if (isPresent) {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">✓ Presente</span>';
            } else {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">✗ Ausente</span>';
            }
        }

        function getCertificateBadge(hasCertificate) {
            if (hasCertificate) {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">🎓 Emitido</span>';
            } else {
                return '<span class="px-2 py-1 text-xs font-semibold rounded-full bg-gray-100 text-gray-800">Não Emitido</span>';
            }
        }

        function filterRegistrations() {
            const search = document.getElementById('search-input').value.toLowerCase();
            const statusFilter = document.getElementById('status-filter').value;
            const courseFilter = document.getElementById('course-filter').value;

            filteredRegistrations = allRegistrations.filter(reg => {
                const user = reg.user;
                const matchesSearch = !search || 
                    user.name.toLowerCase().includes(search) ||
                    user.email.toLowerCase().includes(search) ||
                    (user.registration_number && user.registration_number.includes(search));
                
                const matchesStatus = !statusFilter ||
                    (statusFilter === 'present' && reg.checked_in) ||
                    (statusFilter === 'absent' && !reg.checked_in);
                
                const matchesCourse = !courseFilter || (user.curso || user.course) === courseFilter;

                return matchesSearch && matchesStatus && matchesCourse;
            });

            displayRegistrations();
        }

        function switchTab(tab) {
            currentTab = tab;
            
            // Atualizar visual das tabs
            document.querySelectorAll('[id^="tab-"]').forEach(btn => {
                btn.classList.remove('tab-active', 'text-green-600');
                btn.classList.add('text-gray-600');
            });
            
            document.getElementById(`tab-${tab}`).classList.add('tab-active');
            document.getElementById(`tab-${tab}`).classList.remove('text-gray-600');
            
            displayRegistrations();
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
        }

        function exportToCSV() {
            // Cabeçalhos do CSV
            const headers = ['Nome', 'Matrícula', 'Curso', 'Semestre', 'Email', 'Pagamento', 'Check-in', 'Certificado'];
            
            // Dados
            const rows = allRegistrations.map(reg => {
                const user = reg.user;
                const payment = reg.payment;
                
                return [
                    user.name,
                    user.matricula || user.registration_number || '-',
                    user.curso || user.course || (user.user_type === 'external' ? 'Externo' : '-'),
                    user.semestre || user.semester || (user.user_type === 'external' ? 'N/A' : '-'),
                    user.email,
                    payment ? (payment.status === 'paid' ? 'Pago' : payment.status === 'pending' ? 'Pendente' : 'Não Pago') : 'Gratuito',
                    reg.checked_in ? 'Presente' : 'Ausente',
                    reg.certificate_id ? 'Emitido' : 'Não Emitido'
                ];
            });

            // Criar CSV
            let csvContent = '\uFEFF'; // BOM para UTF-8
            csvContent += headers.join(';') + '\n';
            rows.forEach(row => {
                csvContent += row.map(cell => `"${cell}"`).join(';') + '\n';
            });

            // Download
            const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
            const link = document.createElement('a');
            const url = URL.createObjectURL(blob);
            
            const fileName = `relatorio_${currentEvent.title.replace(/\s+/g, '_')}_${new Date().toISOString().split('T')[0]}.csv`;
            
            link.setAttribute('href', url);
            link.setAttribute('download', fileName);
            link.style.visibility = 'hidden';
            document.body.appendChild(link);
            link.click();
            document.body.removeChild(link);
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
