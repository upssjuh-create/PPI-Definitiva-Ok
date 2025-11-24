<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Meus Eventos - Sistema IFFar</title>
    
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
        
        .btn-primary {
            background: linear-gradient(135deg, #1a5f3f 0%, #155030 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(26, 95, 63, 0.3);
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
                    <span class="text-sm" id="user-name">João Silva</span>
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

    <!-- Tabs -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex space-x-8">
                <button onclick="window.location.href='/events'" class="py-4 text-gray-600 hover:text-[#1a5f3f] transition">
                    Eventos Disponíveis
                </button>
                <button class="py-4 tab-active">
                    Meus Eventos
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Título -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Meus Eventos</h2>
            <p class="text-gray-600">Gerencie suas inscrições, faça check-in e baixe certificados</p>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Total de Inscrições -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Total de Inscrições</p>
                        <p class="text-4xl font-bold text-gray-900" id="total-registrations">0</p>
                    </div>
                    <div class="bg-gray-100 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Presença Confirmada -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Presença Confirmada</p>
                        <p class="text-4xl font-bold text-green-600" id="confirmed-presence">0</p>
                    </div>
                    <div class="bg-green-100 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Certificados Disponíveis -->
            <div class="stat-card bg-white rounded-xl p-6 shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm mb-1">Certificados Disponíveis</p>
                        <p class="text-4xl font-bold text-blue-600" id="available-certificates">0</p>
                    </div>
                    <div class="bg-blue-100 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lista de Eventos -->
        <div id="registrations-list" class="space-y-6">
            <!-- Os eventos serão carregados aqui via JavaScript -->
        </div>

        <!-- Loading -->
        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando suas inscrições...</p>
        </div>

        <!-- Sem Inscrições -->
        <div id="no-registrations" class="text-center py-16 hidden">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhuma inscrição ainda</h3>
            <p class="text-gray-600 mb-6">Você ainda não se inscreveu em nenhum evento</p>
            <button onclick="window.location.href='/events'" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                Explorar Eventos
            </button>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        // Carregar dados do usuário
        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('user-name').textContent = user.name;
            }
            
            loadRegistrations();
            
            // Verificar se há um ID de inscrição para destacar
            const urlParams = new URLSearchParams(window.location.search);
            const highlightId = urlParams.get('highlight');
            if (highlightId) {
                setTimeout(() => {
                    const element = document.getElementById(`registration-${highlightId}`);
                    if (element) {
                        element.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        element.classList.add('ring-4', 'ring-blue-500', 'ring-opacity-50');
                        setTimeout(() => {
                            element.classList.remove('ring-4', 'ring-blue-500', 'ring-opacity-50');
                        }, 3000);
                    }
                }, 500);
            }
        });

        // Carregar inscrições
        async function loadRegistrations() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/my-registrations`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    displayRegistrations(data);
                    updateStats(data);
                    document.getElementById('loading').style.display = 'none';
                } else {
                    throw new Error('Erro ao carregar inscrições');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar inscrições</p>';
            }
        }

        // Atualizar estatísticas
        function updateStats(registrations) {
            const total = registrations.length;
            const confirmed = registrations.filter(r => r.checked_in).length;
            const certificates = registrations.filter(r => r.certificate_id).length;

            document.getElementById('total-registrations').textContent = total;
            document.getElementById('confirmed-presence').textContent = confirmed;
            document.getElementById('available-certificates').textContent = certificates;
        }

        // Exibir inscrições
        function displayRegistrations(registrations) {
            const list = document.getElementById('registrations-list');
            const noRegistrations = document.getElementById('no-registrations');

            if (registrations.length === 0) {
                list.innerHTML = '';
                noRegistrations.classList.remove('hidden');
                return;
            }

            noRegistrations.classList.add('hidden');

            list.innerHTML = registrations.map(reg => {
                const event = reg.event;
                const isCheckedIn = reg.checked_in;
                const hasCertificate = reg.certificate_id;
                const isPaid = reg.payment_status === 'paid' || event.price == 0;

                return `
                    <div id="registration-${reg.id}" class="event-card bg-white rounded-xl overflow-hidden shadow-md transition-all">
                        <div class="flex flex-col md:flex-row">
                            <!-- Imagem -->
                            <div class="md:w-64 h-48 md:h-auto bg-gradient-to-br from-[#1a5f3f] to-[#155030] relative">
                                ${event.image ? `<img src="${event.image}" alt="${event.title}" class="w-full h-full object-cover">` : ''}
                                <div class="absolute top-3 left-3">
                                    <span class="bg-[#1a5f3f] text-white px-3 py-1 rounded text-sm font-semibold">${event.category}</span>
                                </div>
                                ${isCheckedIn ? `
                                    <div class="absolute top-3 right-3">
                                        <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                            <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                            </svg>
                                            Confirmado
                                        </span>
                                    </div>
                                ` : ''}
                            </div>

                            <!-- Conteúdo -->
                            <div class="flex-1 p-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">${event.title}</h3>
                                <p class="text-gray-600 mb-4">${event.organizer}</p>

                                <!-- Info -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                        </svg>
                                        ${formatDate(event.date)}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        ${event.time}
                                    </div>
                                    <div class="flex items-center text-sm text-gray-600">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        </svg>
                                        ${event.location}
                                    </div>
                                </div>

                                <!-- Status -->
                                <div class="mb-4">
                                    ${isCheckedIn ? `
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                                            </svg>
                                            Presença Confirmada
                                        </span>
                                    ` : `
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            Aguardando Check-in
                                        </span>
                                    `}
                                </div>

                                <!-- Botões -->
                                <div class="flex flex-wrap gap-3">
                                    ${!isCheckedIn ? `
                                        <button onclick="goToCheckIn(${reg.id})" class="btn-primary text-white px-4 py-2 rounded-lg font-semibold flex items-center">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            Fazer Check-in
                                        </button>
                                    ` : ''}
                                    
                                    ${isCheckedIn ? `
                                        ${hasCertificate ? `
                                            <button onclick="downloadCertificate(${reg.certificate_id})" class="bg-[#1a5f3f] text-white px-4 py-2 rounded-lg font-semibold flex items-center hover:bg-[#155030] transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                                </svg>
                                                Ver Certificado
                                            </button>
                                        ` : `
                                            <button onclick="generateCertificate(${reg.id})" class="bg-blue-600 text-white px-4 py-2 rounded-lg font-semibold flex items-center hover:bg-blue-700 transition">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                                                </svg>
                                                Gerar Certificado
                                            </button>
                                        `}
                                    ` : ''}

                                    ${event.price > 0 ? `
                                        ${isPaid ? `
                                            <span class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium bg-green-100 text-green-800 border border-green-200">
                                                ✅ Pago: R$ ${parseFloat(event.price).toFixed(2)}
                                            </span>
                                        ` : `
                                            <button onclick="payNow(${reg.payment ? reg.payment.id : 'null'}, ${event.id})" class="bg-orange-500 text-white px-4 py-2 rounded-lg font-semibold hover:bg-orange-600 transition flex items-center">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                                </svg>
                                                ⚠️ Pagar Agora (R$ ${parseFloat(event.price).toFixed(2)})
                                            </button>
                                        `}
                                    ` : ''}

                                    <button onclick="cancelRegistration(${reg.id})" class="bg-red-50 text-red-600 px-4 py-2 rounded-lg font-semibold hover:bg-red-100 transition flex items-center">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                        Cancelar Inscrição
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Formatar data
        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: 'long', year: 'numeric' });
        }

        // Ir para página de check-in
        function goToCheckIn(registrationId) {
            window.location.href = `/check-in?registration=${registrationId}`;
        }

        // Gerar certificado
        async function generateCertificate(registrationId) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/registrations/${registrationId}/certificate`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    // Redirecionar para a página do certificado
                    window.location.href = `/certificates/${data.certificate.id}`;
                } else {
                    const data = await response.json();
                    alert(data.message || 'Erro ao gerar certificado');
                }
            } catch (error) {
                alert('Erro ao gerar certificado');
            }
        }

        // Ver certificado
        function downloadCertificate(certificateId) {
            window.location.href = `/certificates/${certificateId}`;
        }

        // Cancelar inscrição
        function cancelRegistration(registrationId) {
            // Mostrar modal de cancelamento
            showCancelModal(registrationId);
        }

        function showCancelModal(registrationId) {
            const modal = document.createElement('div');
            modal.id = 'cancel-modal';
            modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            modal.innerHTML = `
                <div class="bg-white rounded-xl shadow-2xl p-6 max-w-md w-full mx-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-xl font-bold text-gray-900">Cancelar Inscrição</h3>
                        <button onclick="closeCancelModal()" class="text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                    
                    <p class="text-gray-600 mb-4">Tem certeza de que deseja cancelar sua inscrição neste evento?</p>
                    
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Motivo do Cancelamento (opcional)</label>
                        <textarea id="cancel-reason" rows="4" placeholder="Digite o motivo do cancelamento" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"></textarea>
                    </div>

                    <div class="flex gap-3">
                        <button onclick="closeCancelModal()" class="flex-1 px-4 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                            Cancelar
                        </button>
                        <button onclick="confirmCancellation(${registrationId})" class="flex-1 px-4 py-3 bg-red-600 text-white rounded-lg font-semibold hover:bg-red-700 transition flex items-center justify-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Confirmar Cancelamento
                        </button>
                    </div>
                </div>
            `;
            document.body.appendChild(modal);
        }

        function closeCancelModal() {
            const modal = document.getElementById('cancel-modal');
            if (modal) {
                modal.remove();
            }
        }

        async function confirmCancellation(registrationId) {
            const reason = document.getElementById('cancel-reason').value.trim();

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/registrations/${registrationId}/cancel`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ reason: reason })
                });

                if (response.ok) {
                    closeCancelModal();
                    alert('Solicitação de cancelamento enviada com sucesso!');
                    loadRegistrations();
                } else {
                    const data = await response.json();
                    alert(data.message || 'Erro ao cancelar inscrição');
                }
            } catch (error) {
                alert('Erro ao cancelar inscrição');
            }
        }

        // Pagar agora
        function payNow(paymentId, eventId) {
            if (!paymentId || paymentId === 'null') {
                alert('Erro: Pagamento não encontrado. Por favor, tente novamente.');
                return;
            }
            
            // Salvar payment_id no localStorage
            const registrationData = {
                payment_id: paymentId,
                event_id: eventId
            };
            localStorage.setItem('registration_data', JSON.stringify(registrationData));
            
            console.log('Redirecionando para pagamento com:', registrationData);
            
            // Redirecionar para página de pagamento
            window.location.href = `/events/${eventId}/payment`;
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
