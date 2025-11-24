<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Validar Certificados - Admin</title>
    
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
                        <h1 class="text-lg font-bold">Painel Administrativo</h1>
                        <p class="text-sm text-white/90">Validar Certificados</p>
                    </div>
                </div>
                <a href="/admin/dashboard" class="text-sm hover:underline">Voltar ao Dashboard</a>
            </div>
        </div>
    </header>

    @include('admin.partials.nav')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-4xl">
        <div class="mb-6">
            <h2 class="text-2xl font-bold text-gray-900 mb-2">Validar Certificados</h2>
            <p class="text-gray-600">Digite o código de validação para verificar a autenticidade de um certificado</p>
        </div>

        <!-- Formulário de Validação -->
        <div class="bg-white rounded-xl shadow-lg p-6 mb-6">
            <form id="validateForm" class="space-y-4">
                <div>
                    <label for="certificate_code" class="block text-sm font-semibold text-gray-700 mb-2">
                        Código de Validação
                    </label>
                    <div class="flex gap-3">
                        <input 
                            type="text" 
                            id="certificate_code" 
                            name="certificate_code"
                            placeholder="Ex: IFFAR2025IWP6XI"
                            class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent uppercase font-mono"
                            required
                        >
                        <button 
                            type="submit" 
                            class="bg-[#1a5f3f] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center"
                        >
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                            </svg>
                            Validar
                        </button>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">O código está localizado na parte inferior do certificado</p>
                </div>
            </form>
        </div>

        <!-- Resultado da Validação -->
        <div id="result" class="hidden"></div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        document.getElementById('validateForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const code = document.getElementById('certificate_code').value.trim().toUpperCase();
            const resultDiv = document.getElementById('result');
            
            // Mostrar loading
            resultDiv.className = 'bg-gray-100 rounded-xl shadow-lg p-6 animate-pulse';
            resultDiv.innerHTML = '<p class="text-center text-gray-600">Validando certificado...</p>';
            resultDiv.classList.remove('hidden');
            
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/certificates/validate/${code}`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });
                
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
            
            resultDiv.className = 'bg-white rounded-xl shadow-lg overflow-hidden';
            resultDiv.innerHTML = `
                <!-- Status Badge -->
                <div class="bg-green-600 text-white px-6 py-4">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="text-xl font-bold">Certificado Válido!</h3>
                            <p class="text-green-100">Este certificado é autêntico e foi emitido pelo IFFar.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Informações do Certificado -->
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Participante -->
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600 mb-1">Participante</p>
                            <p class="text-lg font-bold text-gray-900">${cert.user.name}</p>
                            <p class="text-sm text-gray-500">${cert.user.email}</p>
                        </div>
                        
                        <!-- Evento -->
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600 mb-1">Evento</p>
                            <p class="text-lg font-bold text-gray-900">${cert.event.title}</p>
                            <p class="text-sm text-gray-500">${cert.event.category || 'Evento'}</p>
                        </div>
                        
                        <!-- Data -->
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600 mb-1">Data do Evento</p>
                            <p class="font-semibold text-gray-900">${eventDate}</p>
                        </div>
                        
                        <!-- Carga Horária -->
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600 mb-1">Carga Horária</p>
                            <p class="font-semibold text-gray-900">${cert.event.certificate_hours || 8} horas</p>
                        </div>
                        
                        <!-- Local -->
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600 mb-1">Local</p>
                            <p class="font-semibold text-gray-900">${cert.event.location}</p>
                        </div>
                        
                        <!-- Código -->
                        <div class="border-b pb-4">
                            <p class="text-sm text-gray-600 mb-1">Código de Validação</p>
                            <p class="font-mono font-bold text-[#1a5f3f]">${cert.certificate_code}</p>
                        </div>
                    </div>
                    
                    <!-- Estatísticas -->
                    <div class="mt-6 bg-gray-50 rounded-lg p-4">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm text-gray-600">Emitido em</p>
                                <p class="font-semibold text-gray-900">${new Date(cert.issued_at).toLocaleDateString('pt-BR')}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Validações</p>
                                <p class="font-semibold text-gray-900">${cert.validation_count || 0} vez(es)</p>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Ações -->
                    <div class="mt-6 flex gap-3">
                        <a href="/certificates/${cert.id}" target="_blank" class="flex-1 bg-[#1a5f3f] text-white px-4 py-3 rounded-lg font-semibold hover:bg-[#155030] transition text-center">
                            Ver Certificado Completo
                        </a>
                        <a href="/certificates/${cert.id}/download" class="flex-1 bg-blue-600 text-white px-4 py-3 rounded-lg font-semibold hover:bg-blue-700 transition text-center">
                            Baixar PDF
                        </a>
                    </div>
                </div>
            `;
        }

        function displayInvalidCertificate() {
            const resultDiv = document.getElementById('result');
            resultDiv.className = 'bg-white rounded-xl shadow-lg overflow-hidden';
            resultDiv.innerHTML = `
                <div class="bg-red-600 text-white px-6 py-4">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        <div>
                            <h3 class="text-xl font-bold">Certificado Não Encontrado</h3>
                            <p class="text-red-100">O código informado não corresponde a nenhum certificado em nosso sistema.</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700 mb-4">Possíveis motivos:</p>
                    <ul class="list-disc list-inside space-y-2 text-gray-600">
                        <li>O código foi digitado incorretamente</li>
                        <li>O certificado ainda não foi gerado</li>
                        <li>O código não pertence a este sistema</li>
                    </ul>
                    <p class="text-sm text-gray-500 mt-4">Verifique se o código foi digitado corretamente e tente novamente.</p>
                </div>
            `;
        }

        function displayError() {
            const resultDiv = document.getElementById('result');
            resultDiv.className = 'bg-white rounded-xl shadow-lg overflow-hidden';
            resultDiv.innerHTML = `
                <div class="bg-yellow-600 text-white px-6 py-4">
                    <div class="flex items-center">
                        <svg class="w-8 h-8 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                        </svg>
                        <div>
                            <h3 class="text-xl font-bold">Erro ao Validar</h3>
                            <p class="text-yellow-100">Ocorreu um erro ao tentar validar o certificado.</p>
                        </div>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-700">Tente novamente mais tarde ou entre em contato com o suporte.</p>
                </div>
            `;
        }
    </script>
</body>
</html>
