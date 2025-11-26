<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pagamento - Sistema IFFar</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://sdk.mercadopago.com/js/v2"></script>
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
        
        .payment-tab {
            transition: all 0.3s ease;
        }
        
        .payment-tab.active {
            background-color: #1a5f3f;
            color: white;
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
            Voltar
        </button>

        <!-- Resumo do Pedido -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Resumo do Pedido</h3>
            
            <div class="flex items-center justify-between mb-4">
                <div class="flex-1">
                    <h4 id="event-title" class="text-lg font-semibold text-gray-900 mb-1"></h4>
                    <p id="event-datetime" class="text-gray-600 text-sm mb-1"></p>
                    <p id="event-location" class="text-gray-600 text-sm"></p>
                </div>
                <span id="event-category" class="bg-[#1a5f3f] text-white px-3 py-1 rounded text-sm font-semibold"></span>
            </div>

            <div class="border-t pt-4">
                <div class="flex items-center justify-between">
                    <span class="text-gray-700 font-medium">Valor da Inscrição:</span>
                    <span id="event-price" class="text-2xl font-bold text-green-600"></span>
                </div>
            </div>
        </div>

        <!-- Forma de Pagamento -->
        <div class="bg-white rounded-xl shadow-md p-6 mb-6">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Forma de Pagamento</h3>

            <!-- Tabs -->
            <div class="flex gap-2 mb-6" id="payment-tabs">
                <!-- Tabs serão inseridas aqui -->
            </div>

            <!-- PIX Content -->
            <div id="pix-content" class="hidden">
                <div class="bg-gray-50 rounded-lg p-4 mb-6">
                    <p class="text-sm text-gray-700 mb-2 font-medium">Como pagar:</p>
                    <p class="text-sm text-gray-600">Escaneie o QR Code ou copie o código PIX abaixo usando o app do seu banco.</p>
                </div>

                <!-- QR Code -->
                <div class="flex flex-col items-center mb-6">
                    <div class="bg-white p-6 rounded-lg shadow-md mb-4">
                        <div id="qr-code" class="w-64 h-64 bg-gray-200 flex items-center justify-center">
                            <div class="text-center text-gray-500">Carregando QR Code...</div>
                            <!-- QR Code será inserido aqui -->
                            <div id="qr-code-image" class="hidden">
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-black"></div>
                                <div class="w-6 h-6 bg-white"></div>
                            </div>
                        </div>
                    </div>
                    <p id="pix-amount" class="text-2xl font-bold text-gray-900 mb-2"></p>
                    <p class="text-sm text-gray-600">Escaneie com o app do seu banco</p>
                </div>

                <!-- Código PIX Copia e Cola -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Código PIX Copia e Cola</label>
                    <div class="flex gap-2">
                        <input type="text" id="pix-code" readonly value="00020126580014br.gov.bcb.pix0136a1b2c3d4-e5f6-7890-abcd-ef1234567890520400005303986540515.005802BR5913Instituto IFFAR6014SAO PAULO62070503***6304ABCD" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-sm">
                        <button onclick="copyPixCode()" class="bg-gray-200 hover:bg-gray-300 px-6 py-3 rounded-lg font-semibold transition flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                            </svg>
                            Copiar
                        </button>
                    </div>
                </div>

                <button onclick="confirmPixPayment()" class="w-full bg-[#1a5f3f] text-white py-4 rounded-lg font-semibold text-lg hover:bg-[#155030] transition mb-3">
                    Já fiz o pagamento
                </button>
                
                <button onclick="payLater()" class="w-full bg-gray-200 text-gray-700 py-4 rounded-lg font-semibold text-lg hover:bg-gray-300 transition">
                    Pagar Depois
                </button>

                <p class="text-sm text-gray-500 text-center mt-4">Após efetuar o pagamento, clique no botão acima para confirmar.</p>
                <p class="text-sm text-orange-600 text-center mt-2 font-semibold">⚠️ Prazo para pagamento: até 1 dia antes do evento</p>
            </div>

            <!-- Cartão Content -->
            <div id="card-content" class="hidden">
                <form id="card-form" onsubmit="handleCardPayment(event); return false;">
                    <!-- Tipo de Cartão -->
                    <div class="flex gap-4 mb-6">
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="card_type" value="credit" checked class="w-5 h-5 text-[#1a5f3f] border-gray-300 focus:ring-[#1a5f3f]">
                            <span class="ml-2 text-gray-700 font-medium">Crédito</span>
                        </label>
                        <label class="flex items-center cursor-pointer">
                            <input type="radio" name="card_type" value="debit" class="w-5 h-5 text-[#1a5f3f] border-gray-300 focus:ring-[#1a5f3f]">
                            <span class="ml-2 text-gray-700 font-medium">Débito</span>
                        </label>
                    </div>

                    <!-- Número do Cartão -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Número do Cartão *</label>
                        <input type="text" name="card_number" id="card_number" placeholder="0000 0000 0000 0000" maxlength="19" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" oninput="formatCardNumber(this)">
                    </div>

                    <!-- Nome do Titular -->
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nome do Titular *</label>
                        <input type="text" name="card_name" placeholder="Nome como está no cartão" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                    </div>

                    <!-- Validade e CVV -->
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Validade *</label>
                            <input type="text" name="card_expiry" id="card_expiry" placeholder="MM/AA" maxlength="5" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" oninput="formatExpiry(this)">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">CVV *</label>
                            <input type="text" name="card_cvv" placeholder="123" maxlength="4" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                        </div>
                    </div>

                    <!-- Aviso de Segurança -->
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                        <p class="text-sm text-blue-900 font-medium mb-1">Pagamento seguro:</p>
                        <p class="text-sm text-blue-800">Seus dados são criptografados e protegidos.</p>
                    </div>
                    
                    <!-- Dados de Teste do Cartão -->
                    <div class="bg-yellow-50 border border-yellow-300 rounded-lg p-4 mb-6">
                        <p class="text-xs font-bold text-yellow-900 mb-2">💳 CARTÃO DE TESTE (Mercado Pago):</p>
                        <div class="text-xs text-yellow-800 space-y-1">
                            <p><strong>Número:</strong> 5031 4332 1540 6351</p>
                            <p><strong>Nome:</strong> APRO</p>
                            <p><strong>Validade:</strong> 11/30</p>
                            <p><strong>CVV:</strong> 123</p>
                            <p class="text-xs text-yellow-700 mt-2 italic">* Configurado pela API do Mercado Pago para testes</p>
                        </div>
                    </div>

                    <button type="submit" class="w-full bg-[#1a5f3f] text-white py-4 rounded-lg font-semibold text-lg hover:bg-[#155030] transition mb-3">
                        <span id="card-button-text">Pagar R$ 0,00</span>
                    </button>
                    
                    <button type="button" onclick="payLater()" class="w-full bg-gray-200 text-gray-700 py-4 rounded-lg font-semibold text-lg hover:bg-gray-300 transition">
                        Pagar Depois
                    </button>
                    
                    <p class="text-sm text-orange-600 text-center mt-3 font-semibold">⚠️ Prazo para pagamento: até 1 dia antes do evento</p>
                </form>
            </div>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let currentEvent = null;
        let currentUser = null;
        let registrationData = null;

        window.addEventListener('DOMContentLoaded', function() {
            // Tentar obter payment_id da URL primeiro
            const urlParams = new URLSearchParams(window.location.search);
            const paymentIdFromUrl = urlParams.get('payment_id');
            
            // Carregar dados do localStorage
            registrationData = JSON.parse(localStorage.getItem('registration_data') || '{}');
            currentUser = JSON.parse(localStorage.getItem('user') || '{}');
            
            // Se payment_id veio da URL, atualizar localStorage
            if (paymentIdFromUrl) {
                registrationData.payment_id = parseInt(paymentIdFromUrl);
                const eventId = getEventIdFromUrl();
                if (eventId) {
                    registrationData.event_id = parseInt(eventId);
                }
                localStorage.setItem('registration_data', JSON.stringify(registrationData));
                console.log('Payment ID obtido da URL:', paymentIdFromUrl);
            }
            
            console.log('Registration Data:', registrationData);
            console.log('Current User:', currentUser);
            
            const eventId = getEventIdFromUrl();
            
            if (eventId) {
                loadEvent(eventId);
            }
            
            // Verificar se tem payment_id
            if (!registrationData.payment_id) {
                console.error('❌ Payment ID não encontrado!');
                console.log('Dados disponíveis:', registrationData);
                console.log('URL params:', window.location.search);
                
                // Tentar buscar o payment_id do backend
                fetchPaymentIdFromBackend(eventId);
            } else {
                console.log('✅ Payment ID encontrado:', registrationData.payment_id);
            }
        });
        
        async function fetchPaymentIdFromBackend(eventId) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/my-registrations`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });
                
                if (response.ok) {
                    const registrations = await response.json();
                    const registration = registrations.find(r => r.event_id == eventId && r.payment);
                    
                    if (registration && registration.payment) {
                        console.log('✅ Payment ID recuperado do backend:', registration.payment.id);
                        registrationData.payment_id = registration.payment.id;
                        registrationData.event_id = eventId;
                        localStorage.setItem('registration_data', JSON.stringify(registrationData));
                    } else {
                        console.error('❌ Nenhum pagamento encontrado para este evento');
                        alert('Erro: Pagamento não encontrado. Redirecionando...');
                        window.location.href = `/events/${eventId}`;
                    }
                } else {
                    console.error('❌ Erro ao buscar inscrições');
                }
            } catch (error) {
                console.error('❌ Erro ao buscar payment_id:', error);
            }
        }

        function getEventIdFromUrl() {
            const path = window.location.pathname;
            const match = path.match(/\/events\/(\d+)\/payment/);
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
                    setupPaymentTabs(currentEvent);
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
            
            const price = parseFloat(event.price);
            const priceFormatted = `R$ ${price.toFixed(2).replace('.', ',')}`;
            document.getElementById('event-price').textContent = priceFormatted;
            document.getElementById('pix-amount').textContent = priceFormatted;
            document.getElementById('card-button-text').textContent = `Pagar ${priceFormatted}`;
        }

        function setupPaymentTabs(event) {
            const tabsContainer = document.getElementById('payment-tabs');
            const paymentConfig = event.payment_config || {};
            
            let tabs = [];
            
            // Verificar se aceita PIX
            if (paymentConfig.accept_pix) {
                tabs.push({
                    id: 'pix',
                    label: 'PIX',
                    icon: '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>'
                });
            }
            
            // Verificar se aceita Cartão
            if (paymentConfig.accept_card) {
                tabs.push({
                    id: 'card',
                    label: 'Cartão',
                    icon: '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>'
                });
            }

            // Se não houver configuração, mostrar ambos
            if (tabs.length === 0) {
                tabs = [
                    { id: 'pix', label: 'PIX', icon: '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>' },
                    { id: 'card', label: 'Cartão', icon: '<svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>' }
                ];
            }

            tabsContainer.innerHTML = tabs.map((tab, index) => `
                <button type="button" onclick="switchTab('${tab.id}')" id="tab-${tab.id}" class="payment-tab flex-1 flex items-center justify-center px-6 py-3 rounded-lg font-semibold transition ${index === 0 ? 'active' : 'bg-gray-200 text-gray-700'}">
                    ${tab.icon}
                    ${tab.label}
                </button>
            `).join('');

            // Mostrar o primeiro tab por padrão
            if (tabs.length > 0) {
                console.log('Ativando tab:', tabs[0].id);
                switchTab(tabs[0].id);
            }
        }

        function switchTab(tabId) {
            // Atualizar tabs
            document.querySelectorAll('.payment-tab').forEach(tab => {
                tab.classList.remove('active', 'bg-[#1a5f3f]', 'text-white');
                tab.classList.add('bg-gray-200', 'text-gray-700');
            });
            
            const activeTab = document.getElementById(`tab-${tabId}`);
            if (activeTab) {
                activeTab.classList.add('active', 'bg-[#1a5f3f]', 'text-white');
                activeTab.classList.remove('bg-gray-200', 'text-gray-700');
            }

            // Mostrar conteúdo correspondente
            document.getElementById('pix-content').classList.add('hidden');
            document.getElementById('card-content').classList.add('hidden');
            document.getElementById(`${tabId}-content`).classList.remove('hidden');
            
            // Se mudou para PIX, gerar QR Code e iniciar verificação
            if (tabId === 'pix') {
                console.log('Tab PIX ativada, gerando QR Code...');
                // Aguardar um pouco para garantir que o DOM está pronto
                setTimeout(() => {
                    generatePixQRCode();
                }, 100);
            }
        }
        
        let paymentCheckInterval = null;
        let currentPaymentId = null;
        
        /**
         * Gera o QR Code PIX e inicia verificação automática
         */
        async function generatePixQRCode() {
            try {
                // Obter payment_id do localStorage
                currentPaymentId = registrationData.payment_id;
                
                if (!currentPaymentId) {
                    console.error('Payment ID não encontrado no localStorage:', registrationData);
                    alert('Erro: ID do pagamento não encontrado. Redirecionando...');
                    // Tentar redirecionar de volta
                    window.location.href = `/events/${currentEvent.id}/details`;
                    return;
                }
                
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/payments/${currentPaymentId}/pix/generate`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });
                
                if (!response.ok) {
                    throw new Error('Erro ao gerar QR Code PIX');
                }
                
                const data = await response.json();
                
                // Exibir QR Code
                console.log('=== EXIBINDO QR CODE ===');
                console.log('Dados recebidos:', data);
                console.log('QR Code base64:', data.qr_code ? 'Presente' : 'Ausente');
                
                const qrCodeContainer = document.getElementById('qr-code');
                
                if (!qrCodeContainer) {
                    console.error('Elemento qr-code não encontrado!');
                    return;
                }
                
                if (data.qr_code) {
                    console.log('Inserindo QR Code no DOM...');
                    
                    // Se já vier com data:image, usar direto
                    if (data.qr_code.startsWith('data:image')) {
                        qrCodeContainer.innerHTML = `<img src="${data.qr_code}" alt="QR Code PIX" class="w-64 h-64 object-contain">`;
                    } 
                    // Se vier com http/https, usar direto
                    else if (data.qr_code.startsWith('http')) {
                        qrCodeContainer.innerHTML = `<img src="${data.qr_code}" alt="QR Code PIX" class="w-64 h-64 object-contain">`;
                    }
                    // Se for base64 puro, adicionar prefixo
                    else {
                        qrCodeContainer.innerHTML = `<img src="data:image/png;base64,${data.qr_code}" alt="QR Code PIX" class="w-64 h-64 object-contain">`;
                    }
                    
                    console.log('QR Code inserido com sucesso!');
                } else {
                    console.error('QR Code não veio na resposta');
                    qrCodeContainer.innerHTML = '<p class="text-red-500">Erro ao carregar QR Code</p>';
                }
                
                // Preencher código PIX
                document.getElementById('pix-code').value = data.pix_payload || '';
                
                // Iniciar verificação automática do pagamento (apenas se for Mercado Pago)
                if (data.provider === 'mercadopago') {
                    startPaymentStatusCheck();
                }
                
            } catch (error) {
                console.error('Erro ao gerar QR Code:', error);
                alert('Erro ao gerar QR Code PIX. Tente novamente.');
            }
        }
        
        /**
         * Inicia verificação automática do status do pagamento
         */
        function startPaymentStatusCheck() {
            // Limpar intervalo anterior se existir
            if (paymentCheckInterval) {
                clearInterval(paymentCheckInterval);
            }
            
            // Verificar a cada 3 segundos
            paymentCheckInterval = setInterval(checkPaymentStatus, 3000);
            
            // Parar após 10 minutos (200 verificações)
            let checkCount = 0;
            const maxChecks = 200;
            
            const originalInterval = paymentCheckInterval;
            paymentCheckInterval = setInterval(async () => {
                checkCount++;
                
                if (checkCount >= maxChecks) {
                    clearInterval(paymentCheckInterval);
                    console.log('Verificação automática encerrada após 10 minutos');
                    return;
                }
                
                await checkPaymentStatus();
            }, 3000);
        }
        
        /**
         * Verifica o status do pagamento
         */
        async function checkPaymentStatus() {
            if (!currentPaymentId) return;
            
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/payments/${currentPaymentId}/pix/status`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });
                
                if (!response.ok) return;
                
                const data = await response.json();
                
                // Se pagamento foi aprovado, redirecionar
                if (data.status === 'paid') {
                    clearInterval(paymentCheckInterval);
                    
                    // Mostrar mensagem de sucesso
                    alert('Pagamento confirmado! Redirecionando...');
                    
                    // Redirecionar para página de confirmação
                    window.location.href = `/events/${currentEvent.id}/registration-confirmation`;
                }
                
            } catch (error) {
                console.error('Erro ao verificar status do pagamento:', error);
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

        function copyPixCode() {
            const pixCode = document.getElementById('pix-code');
            pixCode.select();
            document.execCommand('copy');
            alert('Código PIX copiado!');
        }
        
        // Formatar número do cartão
        function formatCardNumber(input) {
            let value = input.value.replace(/\s/g, '');
            let formattedValue = value.match(/.{1,4}/g)?.join(' ') || value;
            input.value = formattedValue;
        }
        
        // Formatar validade
        function formatExpiry(input) {
            let value = input.value.replace(/\D/g, '');
            if (value.length >= 2) {
                value = value.substring(0, 2) + '/' + value.substring(2, 4);
            }
            input.value = value;
        }

        async function confirmPixPayment() {
            if (!confirm('Você já realizou o pagamento via PIX?')) return;

            await processPayment('pix');
        }

        // Inicializar Mercado Pago
        const mp = new MercadoPago('<?php echo env("MERCADOPAGO_PUBLIC_KEY"); ?>', {
            locale: 'pt-BR'
        });
        
        async function handleCardPayment(event) {
            event.preventDefault();
            
            console.log('=== PROCESSANDO CARTÃO ===');
            
            const formData = new FormData(event.target);
            const cardNumber = formData.get('card_number').replace(/\s/g, '');
            const cardExpiry = formData.get('card_expiry').split('/');
            const cardName = formData.get('card_name');
            const cardCvv = formData.get('card_cvv');
            
            try {
                // Criar token do cartão via backend
                console.log('=== CRIANDO TOKEN DO CARTÃO ===');
                console.log('Número:', cardNumber);
                console.log('Nome:', cardName);
                console.log('Validade:', cardExpiry);
                console.log('CVV:', cardCvv);
                
                const token = localStorage.getItem('auth_token');
                
                if (!token) {
                    alert('Você precisa estar logado para fazer o pagamento');
                    return;
                }
                
                const requestData = {
                    card_number: cardNumber,
                    card_name: cardName,
                    expiration_month: cardExpiry[0],
                    expiration_year: '20' + cardExpiry[1],
                    cvv: cardCvv,
                    cpf: (currentUser && currentUser.cpf) ? currentUser.cpf.replace(/\D/g, '') : '12345678909',
                };
                
                console.log('Dados da requisição:', requestData);
                console.log('URL:', `${API_BASE_URL}/api/payments/card/token`);
                
                const response = await fetch(`${API_BASE_URL}/api/payments/card/token`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(requestData)
                });
                
                console.log('Status da resposta:', response.status);
                
                if (!response.ok) {
                    const errorText = await response.text();
                    console.error('Erro na resposta:', errorText);
                    throw new Error(`Erro HTTP ${response.status}: ${errorText}`);
                }
                
                const result = await response.json();
                console.log('Resposta do token:', result);
                
                if (result.success) {
                    console.log('✅ Token criado:', result.token);
                    // Processar pagamento
                    await processCardPayment({
                        id: result.token,
                        payment_method_id: result.payment_method_id
                    });
                } else {
                    throw new Error(result.error || 'Erro ao criar token do cartão');
                }
                
            } catch (error) {
                console.error('❌ Erro ao processar cartão:', error);
                alert('Erro ao processar cartão: ' + (error.message || 'Tente novamente'));
            }
        }
        
        async function processCardPayment(cardToken) {
            try {
                const token = localStorage.getItem('auth_token');
                const paymentId = registrationData.payment_id;
                
                if (!paymentId) {
                    alert('Erro: ID do pagamento não encontrado');
                    return;
                }
                
                console.log('Processando pagamento com payment_id:', paymentId);
                
                const response = await fetch(`${API_BASE_URL}/api/payments/${paymentId}/card`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        token: cardToken.id,
                        payment_method_id: cardToken.payment_method_id,
                        installments: 1,
                    })
                });
                
                const result = await response.json();
                console.log('Resposta do pagamento:', result);
                
                if (response.ok && result.success) {
                    alert(result.message);
                    window.location.href = `/events/${currentEvent.id}/confirmation`;
                } else {
                    alert('Erro: ' + (result.message || 'Pagamento não aprovado'));
                }
                
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao processar pagamento. Tente novamente.');
            }
        }

        async function processPayment(method, paymentData = {}) {
            try {
                const token = localStorage.getItem('auth_token');
                
                // Primeiro, criar a inscrição
                const registrationResponse = await fetch(`${API_BASE_URL}/api/events/${currentEvent.id}/register`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(registrationData)
                });

                if (!registrationResponse.ok) {
                    throw new Error('Erro ao processar inscrição');
                }

                const registration = await registrationResponse.json();

                // Depois, processar o pagamento
                const paymentResponse = await fetch(`${API_BASE_URL}/api/payments/${registration.payment_id}/${method}`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(paymentData)
                });

                if (paymentResponse.ok) {
                    const result = await paymentResponse.json();
                    localStorage.setItem('registration_result', JSON.stringify({
                        ...registration,
                        payment: result
                    }));
                    window.location.href = `/events/${currentEvent.id}/confirmation`;
                } else {
                    throw new Error('Erro ao processar pagamento');
                }
            } catch (error) {
                alert('Erro ao processar pagamento. Tente novamente.');
            }
        }
        
        /**
         * Confirma pagamento PIX automaticamente (sem validação)
         */
        async function confirmPixPayment() {
            try {
                const token = localStorage.getItem('auth_token');
                const paymentId = registrationData.payment_id;
                
                if (!paymentId) {
                    alert('Erro: ID do pagamento não encontrado.');
                    return;
                }
                
                // Confirmar pagamento diretamente
                const response = await fetch(`${API_BASE_URL}/api/payments/${paymentId}/confirm`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        status: 'approved',
                        method: 'pix'
                    })
                });
                
                if (response.ok) {
                    const result = await response.json();
                    localStorage.setItem('registration_result', JSON.stringify({
                        registration: registrationData,
                        payment: result
                    }));
                    window.location.href = `/events/${currentEvent.id}/confirmation`;
                } else {
                    throw new Error('Erro ao confirmar pagamento');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao confirmar pagamento. Tente novamente.');
            }
        }
        
        /**
         * Processa pagamento com cartão (confirma automaticamente)
         */
        async function handleCardPayment(event) {
            event.preventDefault();
            
            try {
                const token = localStorage.getItem('auth_token');
                const paymentId = registrationData.payment_id;
                
                if (!paymentId) {
                    alert('Erro: ID do pagamento não encontrado.');
                    return;
                }
                
                const formData = new FormData(event.target);
                const cardData = {
                    card_number: formData.get('card_number').replace(/\s/g, ''),
                    card_name: formData.get('card_name'),
                    card_expiry: formData.get('card_expiry'),
                    card_cvv: formData.get('card_cvv'),
                    card_type: formData.get('card_type'),
                    status: 'approved' // Confirmar automaticamente
                };
                
                // Confirmar pagamento diretamente
                const response = await fetch(`${API_BASE_URL}/api/payments/${paymentId}/confirm`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        status: 'approved',
                        method: 'card',
                        card_data: cardData
                    })
                });
                
                if (response.ok) {
                    const result = await response.json();
                    localStorage.setItem('registration_result', JSON.stringify({
                        registration: registrationData,
                        payment: result
                    }));
                    window.location.href = `/events/${currentEvent.id}/confirmation`;
                } else {
                    const error = await response.json();
                    throw new Error(error.message || 'Erro ao processar pagamento');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert(`Erro ao processar cartão: ${error.message}`);
            }
        }
        
        function payLater() {
            if (!confirm('Você deseja deixar para pagar depois?\n\nLembre-se: o pagamento deve ser feito até 1 dia antes do evento.')) {
                return;
            }
            
            // Redirecionar para página de confirmação com status pendente
            localStorage.setItem('registration_result', JSON.stringify({
                registration: registrationData,
                payment: {
                    status: 'pending',
                    message: 'Pagamento pendente. Você pode pagar até 1 dia antes do evento.'
                }
            }));
            
            window.location.href = `/events/${currentEvent.id}/confirmation`;
        }
    </script>
</body>
</html>
