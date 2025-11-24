<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detalhes do Evento - Sistema IFFar</title>
    
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
                        <h1 class="text-lg font-bold">Sistema de Eventos IFFar</h1>
                        <p class="text-sm text-white/90">Instituto Federal Farroupilha</p>
                    </div>
                </div>
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

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Botão Voltar -->
        <button onclick="window.location.href='/events'" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
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
            <div class="relative h-64 md:h-96 rounded-xl overflow-hidden mb-8 shadow-lg">
                <div id="event-banner" class="w-full h-full bg-gradient-to-br from-[#1a5f3f] to-[#155030]"></div>
                <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/70 to-transparent p-8">
                    <span id="event-category" class="inline-block bg-white text-[#1a5f3f] px-4 py-2 rounded-lg font-semibold mb-4"></span>
                    <h1 id="event-title" class="text-4xl font-bold text-white mb-2"></h1>
                    <p id="event-organizer" class="text-white/90 text-lg"></p>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Coluna Principal -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Detalhes do Evento -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-900">Detalhes do Evento</h2>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <div class="flex items-center text-gray-600 mb-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">Data</span>
                                </div>
                                <p id="event-date" class="text-gray-900 text-lg ml-7"></p>
                            </div>

                            <div>
                                <div class="flex items-center text-gray-600 mb-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                    </svg>
                                    <span class="font-medium">Horário</span>
                                </div>
                                <p id="event-time" class="text-gray-900 text-lg ml-7"></p>
                            </div>

                            <div>
                                <div class="flex items-center text-gray-600 mb-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                    </svg>
                                    <span class="font-medium">Local</span>
                                </div>
                                <p id="event-location" class="text-gray-900 text-lg ml-7"></p>
                            </div>

                            <div>
                                <div class="flex items-center text-gray-600 mb-2">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                    </svg>
                                    <span class="font-medium">Organizador</span>
                                </div>
                                <p id="event-organizer-detail" class="text-gray-900 text-lg ml-7"></p>
                            </div>
                        </div>
                    </div>

                    <!-- Sobre Este Evento -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Sobre Este Evento</h2>
                        <p id="event-description" class="text-gray-700 leading-relaxed"></p>
                    </div>

                    <!-- Palestrantes -->
                    <div id="speakers-section" class="bg-white rounded-xl shadow-md p-6 hidden">
                        <h2 class="text-2xl font-bold text-gray-900 mb-4">Palestrantes e Apresentações</h2>
                        <ul id="speakers-list" class="space-y-2"></ul>
                    </div>

                    <!-- Tags -->
                    <div id="tags-section" class="bg-white rounded-xl shadow-md p-6 hidden">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                            </svg>
                            <h2 class="text-2xl font-bold text-gray-900">Tags do Evento</h2>
                        </div>
                        <div id="tags-list" class="flex flex-wrap gap-2"></div>
                    </div>

                    <!-- Perguntas e Respostas -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-2xl font-bold text-gray-900 mb-6 flex items-center">
                            <svg class="w-6 h-6 mr-2 text-[#1a5f3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            Perguntas e Respostas
                        </h2>

                        <!-- Formulário para nova pergunta -->
                        <div class="bg-gray-50 rounded-lg p-4 mb-6">
                            <p class="text-sm text-gray-700 mb-3 font-medium">Tem alguma dúvida? Faça sua pergunta:</p>
                            <textarea 
                                id="new-question-input" 
                                rows="3" 
                                placeholder="Digite sua pergunta aqui..."
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f] resize-none"
                            ></textarea>
                            <div class="flex justify-end mt-3">
                                <button onclick="submitQuestion()" class="bg-[#1a5f3f] text-white px-6 py-2 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
                                    </svg>
                                    Enviar Pergunta
                                </button>
                            </div>
                        </div>

                        <!-- Lista de perguntas -->
                        <div id="questions-list" class="space-y-4">
                            <!-- Perguntas serão carregadas aqui -->
                        </div>

                        <!-- Mensagem quando não há perguntas -->
                        <div id="no-questions" class="text-center py-12 hidden">
                            <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                            </svg>
                            <p class="text-gray-500">Nenhuma pergunta ainda</p>
                            <p class="text-sm text-gray-400 mt-2">Seja o primeiro a fazer uma pergunta sobre este evento!</p>
                        </div>
                    </div>

                </div>
                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Card de Inscrição -->
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-4">
                        <div class="flex items-center mb-4">
                            <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                            </svg>
                            <h3 class="text-xl font-bold text-gray-900">Inscrição</h3>
                        </div>

                        <!-- Capacidade -->
                        <div class="mb-4">
                            <p class="text-sm text-gray-600 mb-2">Capacidade</p>
                            <div class="flex items-center justify-between mb-2">
                                <span id="registered-count" class="text-2xl font-bold text-gray-900">0</span>
                                <span class="text-gray-600">/</span>
                                <span id="capacity-count" class="text-2xl font-bold text-gray-900">0</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div id="capacity-bar" class="bg-[#1a5f3f] h-2 rounded-full" style="width: 0%"></div>
                            </div>
                            <p id="spots-remaining" class="text-sm text-gray-600 mt-2"></p>
                        </div>

                        <!-- Botão de Inscrição -->
                        <div id="registration-container">
                            <button id="register-button" onclick="registerForEvent()" class="w-full bg-[#1a5f3f] text-white py-4 rounded-lg font-semibold text-lg hover:bg-[#155030] transition mb-4">
                                Inscrever-se Agora
                            </button>
                        </div>

                        <!-- Informações Rápidas -->
                        <div class="border-t pt-4 space-y-3">
                            <h4 class="font-semibold text-gray-900 mb-3">Informações Rápidas</h4>
                            
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Categoria</span>
                                <span id="info-category" class="text-sm font-semibold text-gray-900"></span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Inscrição</span>
                                <span id="info-price" class="text-sm font-semibold text-green-600"></span>
                            </div>

                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Status</span>
                                <span id="info-status" class="text-sm font-semibold text-green-600">Aberto</span>
                            </div>
                        </div>
                    </div>
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
                document.getElementById('user-name').textContent = user.name;
            }
            
            const eventId = getEventIdFromUrl();
            if (eventId) {
                loadEvent(eventId);
                loadQuestions();
            }
        });

        function getEventIdFromUrl() {
            const path = window.location.pathname;
            const match = path.match(/\/events\/(\d+)/);
            return match ? match[1] : null;
        }

        async function loadEvent(eventId) {
            try {
                const token = localStorage.getItem('auth_token');
                console.log('=== CARREGANDO EVENTO ===');
                console.log('Token:', token ? 'Presente' : 'Ausente');
                console.log('Event ID:', eventId);
                
                const response = await fetch(`${API_BASE_URL}/api/events/${eventId}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    currentEvent = await response.json();
                    console.log('=== EVENTO CARREGADO ===');
                    console.log('Event:', currentEvent);
                    console.log('Is User Registered:', currentEvent.is_user_registered);
                    console.log('User Registration:', currentEvent.user_registration);
                    displayEvent(currentEvent);
                    document.getElementById('loading').style.display = 'none';
                    document.getElementById('event-content').classList.remove('hidden');
                } else {
                    throw new Error('Erro ao carregar evento');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar evento</p>';
            }
        }

        function displayEvent(event) {
            console.log('=== DISPLAY EVENT ===');
            console.log('Event completo:', event);
            
            // Banner
            if (event.image) {
                document.getElementById('event-banner').style.backgroundImage = `url(${event.image})`;
                document.getElementById('event-banner').style.backgroundSize = 'cover';
                document.getElementById('event-banner').style.backgroundPosition = 'center';
            }

            // Informações básicas
            document.getElementById('event-category').textContent = event.category;
            document.getElementById('event-title').textContent = event.title;
            document.getElementById('event-organizer').textContent = event.organizer;
            document.getElementById('event-organizer-detail').textContent = event.organizer;

            // Detalhes
            document.getElementById('event-date').textContent = formatDate(event.date);
            document.getElementById('event-time').textContent = event.time;
            document.getElementById('event-location').textContent = event.location;
            document.getElementById('event-description').textContent = event.description;

            // Palestrantes
            if (event.speakers && event.speakers.length > 0) {
                document.getElementById('speakers-section').classList.remove('hidden');
                document.getElementById('speakers-list').innerHTML = event.speakers.map(speaker => `
                    <li class="flex items-start">
                        <svg class="w-5 h-5 text-[#1a5f3f] mr-2 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-gray-700">${speaker}</span>
                    </li>
                `).join('');
            }

            // Tags
            if (event.tags && event.tags.length > 0) {
                document.getElementById('tags-section').classList.remove('hidden');
                document.getElementById('tags-list').innerHTML = event.tags.map(tag => `
                    <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">${tag}</span>
                `).join('');
            }

            // Sidebar - Capacidade
            const registered = event.registered_count || 0;
            const capacity = event.capacity;
            const percentage = (registered / capacity) * 100;

            document.getElementById('registered-count').textContent = registered;
            document.getElementById('capacity-count').textContent = capacity;
            document.getElementById('capacity-bar').style.width = `${percentage}%`;
            
            const spotsRemaining = capacity - registered;
            document.getElementById('spots-remaining').textContent = 
                spotsRemaining > 0 ? `${spotsRemaining} vagas restantes` : 'Evento lotado';

            // Informações rápidas
            document.getElementById('info-category').textContent = event.category;
            document.getElementById('info-price').textContent = event.price > 0 ? `R$ ${parseFloat(event.price).toFixed(2)}` : 'Gratuita';
            
            // Verificar se usuário já está inscrito
            console.log('=== VERIFICANDO INSCRIÇÃO ===');
            console.log('is_user_registered:', event.is_user_registered);
            console.log('user_registration:', event.user_registration);
            
            if (event.is_user_registered && event.user_registration) {
                const registration = event.user_registration;
                const container = document.getElementById('registration-container');
                
                console.log('=== USUÁRIO JÁ INSCRITO ===');
                console.log('Registration:', registration);
                console.log('Event Price:', event.price);
                console.log('Payment:', registration.payment);
                
                // Verificar se o evento é pago
                const eventPrice = parseFloat(event.price) || 0;
                const isFreeEvent = eventPrice === 0;
                
                console.log('Event Price (parsed):', eventPrice);
                console.log('Is Free Event:', isFreeEvent);
                
                // Calcular prazo de pagamento (1 dia antes do evento)
                const eventDate = new Date(currentEvent.date);
                const paymentDeadline = new Date(eventDate);
                paymentDeadline.setDate(paymentDeadline.getDate() - 1);
                const now = new Date();
                const isPastDeadline = now > paymentDeadline;
                
                // Determinar status do pagamento
                let paymentStatus = 'confirmed';
                let showPayButton = false;
                
                if (!isFreeEvent && registration.payment) {
                    paymentStatus = registration.payment.status;
                    showPayButton = paymentStatus === 'pending' && !isPastDeadline;
                }
                
                // Criar botão vermelho com informações da inscrição
                container.innerHTML = `
                    <div class="bg-red-50 border-2 border-red-600 rounded-lg p-4 mb-4">
                        <div class="flex items-center mb-3">
                            <svg class="w-6 h-6 text-red-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            <h4 class="text-lg font-bold text-red-900">VOCÊ JÁ ESTÁ INSCRITO NESTE EVENTO!</h4>
                        </div>
                        <div class="space-y-2 mb-4 text-sm text-red-800">
                            <p><strong>Status da Inscrição:</strong> ${getStatusText(registration.status)}</p>
                            <p><strong>Data da Inscrição:</strong> ${formatDateTime(registration.created_at)}</p>
                            <p><strong>Código de Check-in:</strong> <span class="font-mono font-bold">${registration.check_in_code}</span></p>
                            ${!isFreeEvent ? `
                                <p><strong>Valor:</strong> R$ ${eventPrice.toFixed(2)}</p>
                                <p><strong>Pagamento:</strong> ${getPaymentStatusText(paymentStatus)}</p>
                                ${paymentStatus === 'pending' ? `
                                    <div class="bg-orange-100 border border-orange-400 rounded p-2 mt-2">
                                        <p class="text-orange-900 font-bold">⚠️ PAGAMENTO PENDENTE</p>
                                        <p class="text-orange-800 text-xs mt-1">Prazo: até ${formatDate(paymentDeadline.toISOString())}</p>
                                        ${isPastDeadline ? `
                                            <p class="text-red-700 font-bold text-xs mt-1">❌ Prazo expirado!</p>
                                        ` : ''}
                                    </div>
                                ` : paymentStatus === 'paid' ? `
                                    <div class="bg-green-100 border border-green-400 rounded p-2 mt-2">
                                        <p class="text-green-900 font-bold">✅ PAGAMENTO CONFIRMADO</p>
                                    </div>
                                ` : ''}
                            ` : `
                                <div class="bg-green-100 border border-green-400 rounded p-2 mt-2">
                                    <p class="text-green-900 font-bold">✅ INSCRIÇÃO CONFIRMADA (Evento Gratuito)</p>
                                </div>
                            `}
                        </div>
                        <div class="space-y-2">
                            ${showPayButton ? `
                                <button onclick="payNow(${registration.payment.id})" class="w-full bg-green-600 text-white py-3 rounded-lg font-semibold hover:bg-green-700 transition flex items-center justify-center">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                                    </svg>
                                    Pagar Agora
                                </button>
                            ` : ''}
                            <button onclick="viewRegistrationReceipt(${registration.id})" class="w-full bg-red-600 text-white py-3 rounded-lg font-semibold hover:bg-red-700 transition flex items-center justify-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                                Ver Comprovante de Inscrição
                            </button>
                        </div>
                    </div>
                `;
                
                document.getElementById('info-status').textContent = 'Inscrito';
                document.getElementById('info-status').classList.remove('text-green-600');
                document.getElementById('info-status').classList.add('text-blue-600');
            } else {
                // Botão de inscrição normal
                if (spotsRemaining <= 0) {
                    const button = document.getElementById('register-button');
                    button.textContent = 'Evento Lotado';
                    button.disabled = true;
                    button.classList.add('opacity-50', 'cursor-not-allowed');
                    document.getElementById('info-status').textContent = 'Lotado';
                    document.getElementById('info-status').classList.remove('text-green-600');
                    document.getElementById('info-status').classList.add('text-red-600');
                }
            }
        }
        
        function getStatusText(status) {
            const statusMap = {
                'pending': '⏳ Aguardando Pagamento',
                'confirmed': '✅ Confirmada',
                'cancelled': '❌ Cancelada'
            };
            return statusMap[status] || status;
        }
        
        function getPaymentStatusText(status) {
            const statusMap = {
                'pending': '⏳ Pendente',
                'paid': '✅ Pago',
                'failed': '❌ Falhou',
                'cancelled': '❌ Cancelado'
            };
            return statusMap[status] || status;
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
        
        function viewRegistrationReceipt(registrationId) {
            window.location.href = `/my-registrations?highlight=${registrationId}`;
        }
        
        function payNow(paymentId) {
            // Salvar payment_id no localStorage
            const registrationData = {
                payment_id: paymentId,
                event_id: currentEvent.id
            };
            localStorage.setItem('registration_data', JSON.stringify(registrationData));
            
            // Redirecionar para página de pagamento
            window.location.href = `/events/${currentEvent.id}/payment`;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric' 
            });
        }

        async function registerForEvent() {
            if (!currentEvent) return;

            // Redirecionar para página de confirmação de inscrição
            window.location.href = `/events/${currentEvent.id}/register`;
        }

        async function submitQuestion() {
            const input = document.getElementById('question-input');
            const question = input.value.trim();

            if (!question) {
                alert('Por favor, digite sua pergunta');
                return;
            }

            // Aqui você implementaria a lógica para enviar a pergunta
            alert('Funcionalidade de perguntas será implementada em breve!');
            input.value = '';
        }

        let allQuestions = [];
        let editingQuestionId = null;

        // Carregar perguntas
        async function loadQuestions() {
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
                    allQuestions = await response.json();
                    displayQuestions();
                }
            } catch (error) {
                console.error('Erro ao carregar perguntas:', error);
            }
        }

        // Exibir perguntas
        function displayQuestions() {
            const list = document.getElementById('questions-list');
            const noQuestions = document.getElementById('no-questions');
            const currentUser = JSON.parse(localStorage.getItem('user') || '{}');

            if (allQuestions.length === 0) {
                list.innerHTML = '';
                noQuestions.classList.remove('hidden');
                return;
            }

            noQuestions.classList.add('hidden');

            list.innerHTML = allQuestions.map(q => {
                const isOwner = q.user_id === currentUser.id;
                const hasAnswer = q.answer !== null;

                return `
                    <div class="border border-gray-200 rounded-lg p-4 bg-white">
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
                                    ${isOwner ? `
                                        <div class="flex items-center space-x-2">
                                            <button onclick="editQuestion(${q.id}, '${escapeHtml(q.question)}')" class="text-blue-600 hover:text-blue-800 text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                                </svg>
                                            </button>
                                            <button onclick="deleteQuestion(${q.id})" class="text-red-600 hover:text-red-800 text-sm">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                </svg>
                                            </button>
                                        </div>
                                    ` : ''}
                                </div>
                                <p class="text-gray-700">${q.question}</p>
                            </div>
                        </div>

                        <!-- Resposta -->
                        ${hasAnswer ? `
                            <div class="ml-13 pl-4 border-l-2 border-green-500 bg-green-50 rounded-r-lg p-3">
                                <div class="flex items-center mb-2">
                                    <svg class="w-4 h-4 text-green-600 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="text-sm font-semibold text-green-800">Resposta do Admin IFFar</span>
                                    <span class="text-xs text-green-600 ml-2">${formatDateTime(q.answered_at)}</span>
                                </div>
                                <p class="text-gray-700">${q.answer}</p>
                            </div>
                        ` : `
                            <div class="ml-13 pl-4 border-l-2 border-gray-300 bg-gray-50 rounded-r-lg p-3">
                                <p class="text-sm text-gray-500 italic">Aguardando resposta...</p>
                            </div>
                        `}
                    </div>
                `;
            }).join('');
        }

        // Enviar pergunta
        async function submitQuestion() {
            const input = document.getElementById('new-question-input');
            const question = input.value.trim();

            if (!question) {
                alert('Por favor, digite sua pergunta');
                return;
            }

            const eventId = getEventIdFromUrl();
            if (!eventId) return;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events/${eventId}/questions`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ question })
                });

                if (response.ok) {
                    input.value = '';
                    loadQuestions();
                } else {
                    alert('Erro ao enviar pergunta');
                }
            } catch (error) {
                alert('Erro ao enviar pergunta');
            }
        }

        // Editar pergunta
        function editQuestion(questionId, currentQuestion) {
            const newQuestion = prompt('Editar pergunta:', currentQuestion);
            if (!newQuestion || newQuestion === currentQuestion) return;

            updateQuestion(questionId, newQuestion);
        }

        async function updateQuestion(questionId, question) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/questions/${questionId}`, {
                    method: 'PUT',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({ question })
                });

                if (response.ok) {
                    loadQuestions();
                } else {
                    alert('Erro ao atualizar pergunta');
                }
            } catch (error) {
                alert('Erro ao atualizar pergunta');
            }
        }

        // Deletar pergunta
        async function deleteQuestion(questionId) {
            if (!confirm('Tem certeza que deseja deletar esta pergunta?')) return;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/questions/${questionId}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    loadQuestions();
                } else {
                    alert('Erro ao deletar pergunta');
                }
            } catch (error) {
                alert('Erro ao deletar pergunta');
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

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
