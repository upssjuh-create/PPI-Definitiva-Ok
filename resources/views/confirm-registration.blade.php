<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirmar Inscrição - Sistema IFFar</title>
    
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
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-3xl">
        <!-- Botão Voltar -->
        <button onclick="history.back()" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Detalhes do Evento
        </button>

        <h2 class="text-3xl font-bold text-gray-900 mb-8">Confirmar Inscrição</h2>

        <form id="registration-form" onsubmit="handleSubmit(event); return false;">
            <!-- Informações do Evento -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex-1">
                        <h3 id="event-title" class="text-2xl font-bold text-gray-900 mb-2"></h3>
                        <p id="event-datetime" class="text-gray-600 mb-1"></p>
                        <p id="event-location" class="text-gray-600"></p>
                    </div>
                    <span id="event-category" class="bg-[#1a5f3f] text-white px-4 py-2 rounded-lg font-semibold text-sm"></span>
                </div>
            </div>

            <!-- Seus Dados -->
            <div class="bg-gray-50 rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Seus Dados</h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <p class="text-sm text-gray-600 mb-1">Nome</p>
                        <p id="user-name" class="text-gray-900 font-medium"></p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-600 mb-1">E-mail</p>
                        <p id="user-email" class="text-gray-900 font-medium"></p>
                    </div>

                    <div id="user-registration-field">
                        <p class="text-sm text-gray-600 mb-1">Matrícula</p>
                        <p id="user-registration" class="text-gray-900 font-medium"></p>
                    </div>

                    <div id="user-course-field">
                        <p class="text-sm text-gray-600 mb-1">Curso</p>
                        <p id="user-course" class="text-gray-900 font-medium"></p>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mt-4">Suas informações foram carregadas automaticamente do seu perfil.</p>
            </div>

            <!-- Informações Adicionais -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Informações Adicionais (Opcional)</h3>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Necessidades de Acessibilidade</label>
                    <textarea name="accessibility_needs" rows="4" placeholder="Descreva qualquer necessidade de acessibilidade..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"></textarea>
                </div>
            </div>

            <!-- Termos e Condições -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="space-y-4">
                    <div class="flex items-start">
                        <input type="checkbox" id="terms" name="terms" required class="w-5 h-5 text-[#1a5f3f] border-gray-300 rounded focus:ring-[#1a5f3f] mt-0.5">
                        <label for="terms" class="ml-3 text-gray-700">
                            Concordo com os termos e condições do evento e entendo que sou responsável pela minha própria segurança e conduta durante o evento. *
                        </label>
                    </div>

                    <div class="flex items-start">
                        <input type="checkbox" id="photo-consent" name="photo_consent" class="w-5 h-5 text-[#1a5f3f] border-gray-300 rounded focus:ring-[#1a5f3f] mt-0.5">
                        <label for="photo-consent" class="ml-3 text-gray-700">
                            Autorizo ser fotografado ou filmado durante o evento para fins promocionais.
                        </label>
                    </div>
                </div>
            </div>

            <!-- Aviso Importante -->
            <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <p class="font-semibold text-green-900 mb-1">Importante:</p>
                        <p class="text-sm text-green-800">A confirmação da inscrição será enviada para seu e-mail. Por favor, chegue 15 minutos antes do início do evento para o check-in.</p>
                    </div>
                </div>
            </div>

            <!-- Botão Confirmar -->
            <button type="submit" class="w-full bg-[#1a5f3f] text-white py-4 rounded-lg font-semibold text-lg hover:bg-[#155030] transition">
                Confirmar Inscrição
            </button>
        </form>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let currentEvent = null;
        let currentUser = null;

        window.addEventListener('DOMContentLoaded', function() {
            currentUser = JSON.parse(localStorage.getItem('user') || '{}');
            const eventId = getEventIdFromUrl();
            
            if (eventId) {
                loadEvent(eventId);
                loadUserData();
            }
        });

        function getEventIdFromUrl() {
            const path = window.location.pathname;
            const match = path.match(/\/events\/(\d+)\/register/);
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
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        }

        function displayEvent(event) {
            document.getElementById('event-title').textContent = event.title;
            document.getElementById('event-datetime').textContent = `${formatDate(event.date)} • ${event.time}`;
            document.getElementById('event-location').textContent = event.location;
            document.getElementById('event-category').textContent = event.category;
        }

        function loadUserData() {
            document.getElementById('user-name').textContent = currentUser.name || '';
            document.getElementById('user-email').textContent = currentUser.email || '';
            
            if (currentUser.registration_number) {
                document.getElementById('user-registration').textContent = currentUser.registration_number;
            } else {
                document.getElementById('user-registration-field').style.display = 'none';
            }

            if (currentUser.course) {
                document.getElementById('user-course').textContent = currentUser.course;
            } else {
                document.getElementById('user-course-field').style.display = 'none';
            }
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric' 
            });
        }

        async function handleSubmit(event) {
            event.preventDefault();

            if (!currentEvent) {
                console.error('Evento não carregado!');
                return;
            }

            console.log('=== VERIFICANDO EVENTO ===');
            console.log('Evento completo:', currentEvent);
            console.log('Preço (raw):', currentEvent.price);
            console.log('Tipo do preço:', typeof currentEvent.price);
            console.log('Preço > 0?', currentEvent.price > 0);
            console.log('Preço parseFloat:', parseFloat(currentEvent.price));

            const formData = new FormData(event.target);
            const data = {
                event_id: currentEvent.id,
                accessibility_needs: formData.get('accessibility_needs'),
                terms_accepted: formData.get('terms') === 'on',
                photo_consent: formData.get('photo-consent') === 'on',
            };

            // Converter preço para número
            const eventPrice = parseFloat(currentEvent.price) || 0;

            // Se o evento for pago, processar inscrição primeiro para obter payment_id
            if (eventPrice > 0) {
                console.log('✅ Evento PAGO - Chamando processRegistrationForPayment');
                await processRegistrationForPayment(data);
            } else {
                console.log('ℹ️ Evento GRATUITO - Chamando processRegistration');
                // Se for gratuito, processar inscrição diretamente
                await processRegistration(data);
            }
        }
        
        async function processRegistrationForPayment(data) {
            try {
                console.log('=== INICIANDO REGISTRO ===');
                console.log('Evento ID:', currentEvent.id);
                console.log('Preço do evento:', currentEvent.price);
                console.log('Dados enviados:', data);
                
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events/${currentEvent.id}/register`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                console.log('Status da resposta:', response.status);
                
                if (response.ok) {
                    const result = await response.json();
                    
                    console.log('=== RESPOSTA DA API ===');
                    console.log('Resposta completa:', result);
                    console.log('Registration:', result.registration);
                    console.log('Payment:', result.payment);
                    
                    // Verificar se payment existe
                    if (!result.payment || !result.payment.id) {
                        console.error('Payment não encontrado na resposta:', result);
                        alert('Erro: Pagamento não foi criado. Tente novamente.');
                        return;
                    }
                    
                    // Salvar dados completos incluindo payment_id
                    const registrationData = {
                        ...data,
                        registration_id: result.registration?.id,
                        payment_id: result.payment.id,
                        event_id: currentEvent.id
                    };
                    
                    console.log('Salvando no localStorage:', registrationData);
                    localStorage.setItem('registration_data', JSON.stringify(registrationData));
                    
                    // Redirecionar para página de pagamento
                    window.location.href = `/events/${currentEvent.id}/payment`;
                } else {
                    const error = await response.json();
                    alert(error.message || 'Erro ao processar inscrição');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao processar inscrição. Tente novamente.');
            }
        }

        async function processRegistration(data) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events/${currentEvent.id}/register`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    const result = await response.json();
                    localStorage.setItem('registration_result', JSON.stringify(result));
                    window.location.href = `/events/${currentEvent.id}/confirmation`;
                } else {
                    const error = await response.json();
                    alert(error.message || 'Erro ao processar inscrição');
                }
            } catch (error) {
                alert('Erro ao processar inscrição. Tente novamente.');
            }
        }
    </script>
</body>
</html>
