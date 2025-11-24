<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validar Certificado - Sistema IFFar</title>
    
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
</head>
<body class="bg-gray-50">
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
                <a href="/" class="text-sm hover:underline">Voltar ao Início</a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-12 max-w-3xl">
        <div class="text-center mb-8">
            <div class="inline-block bg-[#1a5f3f] p-4 rounded-full mb-4">
                <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Validar Certificado</h2>
            <p class="text-gray-600">Digite o código do certificado para verificar sua autenticidade</p>
        </div>

        <!-- Formulário de Validação -->
        <div class="bg-white rounded-xl shadow-lg p-8 mb-6">
            <form id="validateForm" class="space-y-4">
                <div>
                    <label for="certificate_code" class="block text-sm font-semibold text-gray-700 mb-2">
                        Código do Certificado
                    </label>
                    <input 
                        type="text" 
                        id="certificate_code" 
                        name="certificate_code"
                        placeholder="Ex: IFFAR2025ABC123"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent uppercase"
                        required
                    >
                    <p class="text-sm text-gray-500 mt-2">O código está localizado na parte inferior do certificado</p>
                </div>
                
                <button 
                    type="submit" 
                    class="w-full bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center justify-center"
                >
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                    </svg>
                    Validar Certificado
                </button>
            </form>
        </div>

        <!-- Resultado da Validação -->
        <div id="result" class="hidden"></div>

        <!-- Informações -->
        <div class="bg-blue-50 rounded-lg p-6">
            <h3 class="font-bold text-blue-900 mb-3 flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Como validar um certificado
            </h3>
            <ul class="space-y-2 text-sm text-blue-800">
                <li class="flex items-start">
                    <span class="font-bold mr-2">1.</span>
                    Localize o código de validação no certificado (geralmente na parte inferior)
                </li>
                <li class="flex items-start">
                    <span class="font-bold mr-2">2.</span>
                    Digite o código completo no campo acima
                </li>
                <li class="flex items-start">
                    <span class="font-bold mr-2">3.</span>
                    Clique em "Validar Certificado" para verificar a autenticidade
                </li>
                <li class="flex items-start">
                    <span class="font-bold mr-2">4.</span>
                    O sistema mostrará as informações do certificado se ele for válido
                </li>
            </ul>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        document.getElementById('validateForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const code = document.getElementById('certificate_code').value.trim().toUpperCase();
            const resultDiv = document.getElementById('result');
            
            // Mostrar loading
            resultDiv.className = 'bg-gray-100 rounded-lg p-6 animate-pulse';
            resultDiv.innerHTML = '<p class="text-center text-gray-600">Validando certificado...</p>';
            resultDiv.classList.remove('hidden');
            
            try {
                const response = await fetch(`${API_BASE_URL}/api/certificates/validate/${code}`);
                const data = await response.json();
                
                if (response.ok && data.valid) {
                    displayValidCertificate(data.certificate);
                } else {
                    displayInvalidCertificate();
                }
            } catch (error) {
                console.error('Erro:', error);
                displayError();
            }
        });

        function displayValidCertificate(cert) {
            const resultDiv = document.getElementById('result');
            const eventDate = new Date(cert.event.date).toLocaleDateString('pt-BR', { 
                day: 'numeric', 
                month: 'long', 
                year: 'numeric' 
            });
            
            resultDiv.className = 'bg-green-50 border-2 border-green-500 rounded-lg p-6';
            resultDiv.innerHTML = `
                <div class="flex items-start mb-4">
                    <svg class="w-8 h-8 text-green-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-green-900 mb-2">Certificado Válido!</h3>
                        <p class="text-green-800">Este certificado é autêntico e foi emitido pelo IFFar.</p>
                    </div>
                </div>
                
                <div class="bg-white rounded-lg p-4 space-y-3">
                    <div class="border-b pb-3">
                        <p class="text-sm text-gray-600">Participante</p>
                        <p class="font-bold text-gray-900">${cert.user.name}</p>
                    </div>
                    <div class="border-b pb-3">
                        <p class="text-sm text-gray-600">Evento</p>
                        <p class="font-bold text-gray-900">${cert.event.title}</p>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <p class="text-sm text-gray-600">Data do Evento</p>
                            <p class="font-semibold text-gray-900">${eventDate}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Carga Horária</p>
                            <p class="font-semibold text-gray-900">${cert.event.certificate_hours || 8} horas</p>
                        </div>
                    </div>
                    <div>
                        <p class="text-sm text-gray-600">Local</p>
                        <p class="font-semibold text-gray-900">${cert.event.location}</p>
                    </div>
                    <div class="pt-3 border-t">
                        <p class="text-xs text-gray-500">Código de Validação: <span class="font-mono font-bold">${cert.certificate_code}</span></p>
                        <p class="text-xs text-gray-500">Validado ${cert.validation_count || 0} vez(es)</p>
                    </div>
                </div>
            `;
        }

        function displayInvalidCertificate() {
            const resultDiv = document.getElementById('result');
            resultDiv.className = 'bg-red-50 border-2 border-red-500 rounded-lg p-6';
            resultDiv.innerHTML = `
                <div class="flex items-start">
                    <svg class="w-8 h-8 text-red-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-red-900 mb-2">Certificado Não Encontrado</h3>
                        <p class="text-red-800 mb-3">O código informado não corresponde a nenhum certificado em nosso sistema.</p>
                        <p class="text-sm text-red-700">Verifique se o código foi digitado corretamente e tente novamente.</p>
                    </div>
                </div>
            `;
        }

        function displayError() {
            const resultDiv = document.getElementById('result');
            resultDiv.className = 'bg-yellow-50 border-2 border-yellow-500 rounded-lg p-6';
            resultDiv.innerHTML = `
                <div class="flex items-start">
                    <svg class="w-8 h-8 text-yellow-600 mr-3 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                    <div>
                        <h3 class="text-xl font-bold text-yellow-900 mb-2">Erro ao Validar</h3>
                        <p class="text-yellow-800">Ocorreu um erro ao tentar validar o certificado. Tente novamente mais tarde.</p>
                    </div>
                </div>
            `;
        }
    </script>
</body>
</html>
