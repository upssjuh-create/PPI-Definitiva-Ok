<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Inscrição Confirmada - Sistema IFFar</title>
    
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
        
        @keyframes checkmark {
            0% {
                stroke-dashoffset: 100;
            }
            100% {
                stroke-dashoffset: 0;
            }
        }
        
        .checkmark {
            stroke-dasharray: 100;
            stroke-dashoffset: 100;
            animation: checkmark 0.5s ease-in-out 0.3s forwards;
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
    <main class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto">
            <!-- Card de Confirmação -->
            <div class="bg-white rounded-xl shadow-lg p-8 text-center">
                <!-- Ícone de Sucesso -->
                <div class="mb-6">
                    <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto">
                        <svg class="w-16 h-16 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path class="checkmark" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                </div>

                <!-- Título -->
                <h2 id="confirmation-title" class="text-3xl font-bold text-gray-900 mb-4">Pagamento Confirmado!</h2>
                
                <!-- Mensagem de Pagamento -->
                <div id="payment-message" class="mb-6">
                    <p class="text-gray-600 text-lg mb-2">Seu pagamento de <span id="payment-amount" class="font-bold text-green-600"></span> foi processado com sucesso.</p>
                </div>

                <!-- Informações do Evento -->
                <div class="bg-gray-50 rounded-lg p-6 mb-6 text-left">
                    <p class="text-gray-600 text-sm mb-3">Inscrição confirmada para:</p>
                    <h3 id="event-title" class="text-xl font-bold text-[#1a5f3f] mb-2"></h3>
                    <p id="event-datetime" class="text-gray-700 mb-1"></p>
                    <p id="event-location" class="text-gray-700"></p>
                </div>

                <!-- Mensagem de E-mail -->
                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                    <p class="text-blue-900 text-sm">
                        <svg class="w-5 h-5 inline mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                        </svg>
                        Um comprovante foi enviado para seu e-mail.
                    </p>
                </div>

                <!-- Botão -->
                <button onclick="window.location.href='/events'" class="w-full bg-[#1a5f3f] text-white py-4 rounded-lg font-semibold text-lg hover:bg-[#155030] transition">
                    Voltar para Eventos
                </button>
            </div>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        window.addEventListener('DOMContentLoaded', function() {
            const registrationResult = JSON.parse(localStorage.getItem('registration_result') || '{}');
            const eventId = getEventIdFromUrl();
            
            if (eventId) {
                loadEvent(eventId, registrationResult);
            }

            // Limpar dados temporários
            localStorage.removeItem('registration_data');
            localStorage.removeItem('registration_result');
        });

        function getEventIdFromUrl() {
            const path = window.location.pathname;
            const match = path.match(/\/events\/(\d+)\/confirmation/);
            return match ? match[1] : null;
        }

        async function loadEvent(eventId, registrationResult) {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/events/${eventId}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const event = await response.json();
                    displayConfirmation(event, registrationResult);
                }
            } catch (error) {
                console.error('Erro:', error);
            }
        }

        function displayConfirmation(event, registrationResult) {
            // Título e mensagem
            if (event.price > 0) {
                document.getElementById('confirmation-title').textContent = 'Pagamento Confirmado!';
                const priceFormatted = `R$ ${parseFloat(event.price).toFixed(2).replace('.', ',')}`;
                document.getElementById('payment-amount').textContent = priceFormatted;
            } else {
                document.getElementById('confirmation-title').textContent = 'Inscrição Confirmada!';
                document.getElementById('payment-message').innerHTML = '<p class="text-gray-600 text-lg">Sua inscrição foi realizada com sucesso!</p>';
            }

            // Informações do evento
            document.getElementById('event-title').textContent = event.title;
            document.getElementById('event-datetime').textContent = `${formatDate(event.date)} • ${event.time}`;
            document.getElementById('event-location').textContent = event.location;
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { 
                day: '2-digit', 
                month: 'long', 
                year: 'numeric' 
            });
        }
    </script>
</body>
</html>
