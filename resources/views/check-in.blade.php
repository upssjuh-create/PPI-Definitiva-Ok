<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Check-in - Sistema IFFar</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
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
        
        #qr-reader {
            width: 100%;
            max-width: 500px;
            margin: 0 auto;
        }
        
        #qr-reader__dashboard_section_csr {
            display: none !important;
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
                    <span class="text-sm" id="user-name">Usuário</span>
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
    <main class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Botão Voltar -->
        <button onclick="window.location.href='/my-registrations'" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Minhas Inscrições
        </button>

        <!-- Título -->
        <div class="text-center mb-8">
            <div class="inline-block bg-[#1a5f3f] p-4 rounded-full mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <h2 class="text-4xl font-bold text-gray-900 mb-3">Confirmar Presença</h2>
            <p class="text-lg text-gray-600">Insira o código fornecido no local do evento ou escaneie o QR Code</p>
        </div>

        <!-- Card Principal -->
        <div class="bg-white rounded-xl shadow-lg p-8">
            <!-- Informações do Evento -->
            <div id="event-info" class="mb-8 pb-8 border-b">
                <div class="flex items-start space-x-4">
                    <div class="flex-shrink-0">
                        <div class="w-16 h-16 bg-[#1a5f3f] rounded-lg flex items-center justify-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm text-gray-600 mb-1">Evento:</p>
                        <h3 id="event-title" class="text-xl font-bold text-gray-900 mb-2">Carregando...</h3>
                        <div class="flex flex-wrap gap-4 text-sm text-gray-600">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                </svg>
                                <span id="event-date">--/--/----</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="event-time">--:--</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                </svg>
                                <span id="event-location">Local</span>
                            </div>
                        </div>
                        
                        <!-- Status Badges -->
                        <div class="mt-4 flex flex-wrap gap-2">
                            <!-- Status de Check-in -->
                            <div id="checkin-status-badge" class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="checkin-status-text">Aguardando Check-in</span>
                            </div>
                            
                            <!-- Status de Pagamento -->
                            <div id="payment-status-badge" class="hidden inline-flex items-center px-3 py-1 rounded-full text-sm font-medium">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <span id="payment-status-text">Pago</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Métodos de Check-in -->
            <div class="space-y-6">
                <!-- Método 1: Código Manual -->
                <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-[#1a5f3f] p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Código de Confirmação</h4>
                            <p class="text-sm text-gray-600">Digite o código fornecido no evento</p>
                        </div>
                    </div>
                    <input 
                        type="text" 
                        id="checkin-code" 
                        placeholder="DIGITE QUALQUER CÓDIGO"
                        class="w-full px-6 py-4 border-2 border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f] text-center text-2xl font-mono font-bold uppercase tracking-wider bg-white shadow-sm"
                        maxlength="20"
                        oninput="this.value = this.value.toUpperCase()"
                    >
                    <div class="mt-3 space-y-2">
                        <p class="text-xs text-gray-500 text-center flex items-center justify-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Digite o código fornecido no evento
                        </p>
                        <p class="text-xs text-green-600 font-semibold text-center">
                            ✅ Qualquer código será aceito para confirmar sua presença
                        </p>
                    </div>
                </div>

                <!-- Divisor -->
                <div class="relative">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-gray-300"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-gray-500">ou</span>
                    </div>
                </div>

                <!-- Método 2: QR Code -->
                <div class="bg-gray-50 rounded-xl p-6 border-2 border-gray-200">
                    <div class="flex items-center mb-4">
                        <div class="bg-blue-600 p-2 rounded-lg mr-3">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-bold text-gray-900">Escanear QR Code</h4>
                            <p class="text-sm text-gray-600">Use a câmera do seu dispositivo</p>
                        </div>
                    </div>
                    
                    <div id="qr-scanner-container" class="hidden">
                        <div id="qr-reader" class="border-4 border-blue-500 rounded-xl overflow-hidden shadow-lg mb-4"></div>
                        <button 
                            type="button"
                            onclick="stopScanner()" 
                            class="w-full bg-red-500 text-white px-6 py-3 rounded-lg font-semibold hover:bg-red-600 transition flex items-center justify-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Fechar Câmera
                        </button>
                    </div>

                    <button 
                        id="start-scanner-btn"
                        type="button"
                        onclick="startScanner()" 
                        class="w-full bg-blue-600 text-white px-6 py-4 rounded-lg font-bold text-lg hover:bg-blue-700 transition flex items-center justify-center shadow-md hover:shadow-lg"
                    >
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"/>
                        </svg>
                        Abrir Câmera para Escanear
                    </button>
                </div>

                <!-- Botão Confirmar -->
                <button 
                    onclick="confirmCheckIn()" 
                    class="w-full bg-gradient-to-r from-[#1a5f3f] to-[#155030] text-white px-8 py-5 rounded-xl font-bold text-xl hover:shadow-2xl transform hover:scale-105 transition-all flex items-center justify-center shadow-lg"
                >
                    <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    Confirmar Minha Presença
                </button>
                
                <p class="text-center text-sm text-gray-500 mt-4">
                    Ao confirmar, você estará registrando sua presença no evento
                </p>
            </div>
        </div>
    </main>

    <!-- Modal de Sucesso -->
    <div id="success-modal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full p-8 text-center animate-fade-in">
            <!-- Ícone de Sucesso -->
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6 animate-bounce-once">
                <svg class="w-12 h-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            
            <!-- Título -->
            <h3 class="text-3xl font-bold text-green-600 mb-3">🎉 Presença Confirmada!</h3>
            <p class="text-xl text-gray-800 font-semibold mb-2">Evento Concluído com Sucesso!</p>
            <p class="text-gray-600 mb-6">Parabéns por participar do evento.</p>
            
            <!-- Card de Certificado -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 border-2 border-blue-300 rounded-xl p-6 mb-6 shadow-md">
                <div class="flex items-center justify-center mb-3">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <p class="text-lg text-blue-900 font-bold mb-2">📜 Certificado Disponível</p>
                <p class="text-sm text-blue-800">Seu certificado de participação está pronto para ser gerado.</p>
            </div>
            
            <!-- Botões -->
            <div class="space-y-3">
                <button onclick="generateCertificate()" class="w-full bg-gradient-to-r from-[#1a5f3f] to-[#155030] text-white px-6 py-4 rounded-lg font-bold text-lg hover:shadow-lg transform hover:scale-105 transition-all flex items-center justify-center">
                    <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                    </svg>
                    Gerar Meu Certificado Agora
                </button>
                <button onclick="viewLater()" class="w-full bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:bg-gray-200 transition">
                    Ver Depois
                </button>
            </div>
        </div>
    </div>
    
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }
        
        @keyframes bounce-once {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-20px);
            }
        }
        
        .animate-fade-in {
            animation: fade-in 0.3s ease-out;
        }
        
        .animate-bounce-once {
            animation: bounce-once 0.6s ease-out;
        }
    </style>

    <script>
        const API_BASE_URL = window.location.origin;
        let html5QrCode = null;
        let currentRegistrationId = null;

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('user-name').textContent = user.name;
            }

            // Pegar ID da inscrição da URL (query parameter)
            const urlParams = new URLSearchParams(window.location.search);
            currentRegistrationId = urlParams.get('registration');
            
            if (currentRegistrationId) {
                loadRegistrationInfo();
            }
        });

        async function loadRegistrationInfo() {
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
                    const registration = registrations.find(r => r.id == currentRegistrationId);
                    
                    if (registration && registration.event) {
                        document.getElementById('event-title').textContent = registration.event.title;
                        document.getElementById('event-date').textContent = formatDate(registration.event.date);
                        document.getElementById('event-time').textContent = registration.event.time;
                        document.getElementById('event-location').textContent = registration.event.location;
                        
                        // Status de Check-in
                        const checkinBadge = document.getElementById('checkin-status-badge');
                        const checkinText = document.getElementById('checkin-status-text');
                        
                        if (registration.checked_in) {
                            checkinBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700 border border-green-200';
                            checkinText.textContent = 'Presença Confirmada';
                        } else {
                            checkinBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-50 text-blue-700 border border-blue-200';
                            checkinText.textContent = 'Aguardando Check-in';
                        }
                        
                        // Status de Pagamento (se o evento for pago)
                        if (registration.event.price > 0) {
                            const paymentBadge = document.getElementById('payment-status-badge');
                            const paymentText = document.getElementById('payment-status-text');
                            
                            paymentBadge.classList.remove('hidden');
                            
                            if (registration.payment && registration.payment.status === 'approved') {
                                paymentBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-50 text-green-700 border border-green-200';
                                paymentText.textContent = `Pago: R$ ${parseFloat(registration.event.price).toFixed(2)}`;
                            } else {
                                paymentBadge.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-50 text-orange-700 border border-orange-200';
                                paymentText.textContent = `Pendente: R$ ${parseFloat(registration.event.price).toFixed(2)}`;
                            }
                        }
                    }
                }
            } catch (error) {
                console.error('Erro ao carregar informações:', error);
            }
        }

        async function startScanner() {
            const scannerContainer = document.getElementById('qr-scanner-container');
            const startBtn = document.getElementById('start-scanner-btn');
            
            scannerContainer.classList.remove('hidden');
            startBtn.classList.add('hidden');

            html5QrCode = new Html5Qrcode("qr-reader");
            
            try {
                await html5QrCode.start(
                    { facingMode: "environment" },
                    {
                        fps: 10,
                        qrbox: { width: 250, height: 250 }
                    },
                    (decodedText) => {
                        document.getElementById('checkin-code').value = decodedText;
                        stopScanner();
                    }
                );
            } catch (err) {
                alert('Erro ao acessar a câmera. Verifique as permissões.');
                stopScanner();
            }
        }

        async function stopScanner() {
            if (html5QrCode) {
                try {
                    await html5QrCode.stop();
                } catch (err) {
                    console.error('Erro ao parar scanner:', err);
                }
            }
            
            document.getElementById('qr-scanner-container').classList.add('hidden');
            document.getElementById('start-scanner-btn').classList.remove('hidden');
        }

        async function confirmCheckIn() {
            const code = document.getElementById('checkin-code').value.trim();
            
            if (!code) {
                showError('Por favor, insira o código de confirmação ou escaneie o QR Code');
                return;
            }

            if (!currentRegistrationId) {
                showError('Inscrição não encontrada');
                return;
            }

            // Mostrar loading
            const button = event.target;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = `
                <svg class="animate-spin h-5 w-5 mr-3 inline-block" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Confirmando...
            `;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/check-in`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify({
                        check_in_code: code,
                        registration_id: currentRegistrationId
                    })
                });

                if (response.ok) {
                    showSuccessModal();
                } else {
                    const error = await response.json();
                    showError(error.message || 'Código inválido. Verifique e tente novamente.');
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            } catch (error) {
                console.error('Erro:', error);
                showError('Erro ao confirmar presença. Verifique sua conexão e tente novamente.');
                button.disabled = false;
                button.innerHTML = originalText;
            }
        }
        
        function showError(message) {
            // Criar toast de erro
            const toast = document.createElement('div');
            toast.className = 'fixed top-4 right-4 bg-red-500 text-white px-6 py-4 rounded-lg shadow-lg z-50 animate-fade-in';
            toast.innerHTML = `
                <div class="flex items-center">
                    <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <span>${message}</span>
                </div>
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, 4000);
        }

        function showSuccessModal() {
            document.getElementById('success-modal').classList.remove('hidden');
            document.getElementById('success-modal').classList.add('flex');
        }

        async function generateCertificate() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/registrations/${currentRegistrationId}/certificate`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const result = await response.json();
                    // Redirecionar para ver o certificado
                    window.location.href = `/certificates/${result.certificate.id}`;
                } else {
                    const error = await response.json();
                    alert(error.message || 'Erro ao gerar certificado');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao gerar certificado. Tente novamente.');
            }
        }
        
        function viewLater() {
            window.location.href = '/my-registrations';
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: '2-digit', year: 'numeric' });
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
