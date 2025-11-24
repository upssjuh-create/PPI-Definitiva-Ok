<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Eventos Concluídos - Sistema IFFar</title>
    
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
        
        .tab-active {
            border-bottom: 3px solid #1a5f3f;
            color: #1a5f3f;
            font-weight: 600;
        }
        
        .certificate-card {
            transition: all 0.3s ease;
        }
        
        .certificate-card:hover {
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

    <!-- Tabs -->
    <div class="bg-white border-b">
        <div class="container mx-auto px-4">
            <div class="flex space-x-8">
                <button onclick="window.location.href='/events'" class="py-4 text-gray-600 hover:text-[#1a5f3f] transition">
                    Todos os Eventos
                </button>
                <button class="py-4 tab-active flex items-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                    <span>Eventos Concluídos</span>
                </button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <!-- Botão Voltar -->
        <button onclick="window.location.href='/events'" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Eventos
        </button>

        <!-- Título -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Eventos Concluídos</h2>
            <p class="text-gray-600">Acesse seus certificados de eventos já realizados</p>
        </div>

        <!-- Cards de Estatísticas -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Eventos Concluídos -->
            <div class="bg-gradient-to-br from-[#1a5f3f] to-[#155030] rounded-xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/90 text-sm mb-1">Eventos Concluídos</p>
                        <p class="text-5xl font-bold" id="completed-events">0</p>
                    </div>
                    <div class="bg-white/20 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Certificados Disponíveis -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 rounded-xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/90 text-sm mb-1">Certificados Disponíveis</p>
                        <p class="text-5xl font-bold" id="available-certificates">0</p>
                    </div>
                    <div class="bg-white/20 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Total de Horas -->
            <div class="bg-gradient-to-br from-purple-600 to-purple-700 rounded-xl p-6 shadow-lg text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-white/90 text-sm mb-1">Total de Horas</p>
                        <p class="text-5xl font-bold"><span id="total-hours">0</span>h</p>
                    </div>
                    <div class="bg-white/20 w-16 h-16 rounded-lg flex items-center justify-center">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        <!-- Aviso sobre Certificados -->
        <div class="bg-green-50 border-l-4 border-green-500 rounded-lg p-6 mb-8">
            <div class="flex items-start">
                <svg class="w-6 h-6 text-green-500 mr-3 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div>
                    <h3 class="text-lg font-semibold text-green-900 mb-2">Sobre os Certificados</h3>
                    <ul class="space-y-2 text-sm text-green-800">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Todos os certificados possuem código único de validação que pode ser verificado publicamente.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Os documentos em PDF contêm assinatura digital para garantir autenticidade.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Você pode baixar seus certificados a qualquer momento, sem limite de downloads.</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                            </svg>
                            <span>Compartilhe o código de validação para que terceiros possam verificar a autenticidade do certificado.</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Título da Seção -->
        <h3 class="text-2xl font-bold text-gray-900 mb-6">Seus Certificados</h3>

        <!-- Lista de Certificados -->
        <div id="certificates-list" class="space-y-6">
            <!-- Os certificados serão carregados aqui -->
        </div>

        <!-- Loading -->
        <div id="loading" class="text-center py-12">
            <div class="inline-block animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f]"></div>
            <p class="mt-4 text-gray-600">Carregando certificados...</p>
        </div>

        <!-- Sem Certificados -->
        <div id="no-certificates" class="text-center py-16 hidden">
            <svg class="w-24 h-24 text-gray-300 mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
            </svg>
            <h3 class="text-2xl font-bold text-gray-900 mb-2">Nenhum certificado disponível</h3>
            <p class="text-gray-600 mb-6">Você ainda não possui certificados de eventos concluídos</p>
            <button onclick="window.location.href='/events'" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold">
                Explorar Eventos
            </button>
        </div>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('user-name').textContent = user.name;
            }
            
            loadCertificates();
        });

        async function loadCertificates() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/my-certificates`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const data = await response.json();
                    displayCertificates(data);
                    updateStats(data);
                    document.getElementById('loading').style.display = 'none';
                } else {
                    throw new Error('Erro ao carregar certificados');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('loading').innerHTML = '<p class="text-red-600">Erro ao carregar certificados</p>';
            }
        }

        function updateStats(certificates) {
            const total = certificates.length;
            const totalHours = certificates.reduce((sum, cert) => sum + (cert.event?.certificate_hours || 0), 0);

            document.getElementById('completed-events').textContent = total;
            document.getElementById('available-certificates').textContent = total;
            document.getElementById('total-hours').textContent = totalHours;
        }

        function displayCertificates(certificates) {
            const list = document.getElementById('certificates-list');
            const noCertificates = document.getElementById('no-certificates');

            if (certificates.length === 0) {
                list.innerHTML = '';
                noCertificates.classList.remove('hidden');
                return;
            }

            noCertificates.classList.add('hidden');

            list.innerHTML = certificates.map(cert => {
                const event = cert.event;
                const speakers = event.speakers || [];

                return `
                    <div class="certificate-card bg-white rounded-xl overflow-hidden shadow-md">
                        <div class="flex flex-col md:flex-row">
                            <!-- Imagem -->
                            <div class="md:w-64 h-48 md:h-auto bg-gradient-to-br from-[#1a5f3f] to-[#155030] relative">
                                ${event.image ? `<img src="${event.image}" alt="${event.title}" class="w-full h-full object-cover">` : ''}
                                <div class="absolute top-3 left-3">
                                    <span class="bg-green-500 text-white px-3 py-1 rounded-full text-xs font-semibold flex items-center">
                                        <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/>
                                        </svg>
                                        Concluído
                                    </span>
                                </div>
                                <div class="absolute top-3 right-3">
                                    <span class="bg-[#1a5f3f] text-white px-3 py-1 rounded text-sm font-semibold">${event.category}</span>
                                </div>
                            </div>

                            <!-- Conteúdo -->
                            <div class="flex-1 p-6">
                                <h3 class="text-2xl font-bold text-gray-900 mb-2">${event.title}</h3>
                                <p class="text-gray-600 mb-4">${event.description}</p>

                                <!-- Info Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                    <div>
                                        <div class="flex items-center text-sm text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="font-medium">Data de Realização:</span>
                                        </div>
                                        <p class="text-gray-900 ml-6">${formatDate(event.date)}</p>
                                    </div>

                                    <div>
                                        <div class="flex items-center text-sm text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="font-medium">Horário:</span>
                                        </div>
                                        <p class="text-gray-900 ml-6">${event.time}</p>
                                    </div>

                                    <div>
                                        <div class="flex items-center text-sm text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                            </svg>
                                            <span class="font-medium">Local:</span>
                                        </div>
                                        <p class="text-gray-900 ml-6">${event.location}</p>
                                    </div>

                                    <div>
                                        <div class="flex items-center text-sm text-gray-600 mb-2">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                            </svg>
                                            <span class="font-medium">Carga Horária:</span>
                                        </div>
                                        <p class="text-gray-900 ml-6">${event.certificate_hours || 0} horas</p>
                                    </div>
                                </div>

                                <!-- Palestrantes -->
                                ${speakers.length > 0 ? `
                                    <div class="mb-4">
                                        <p class="text-sm text-gray-600 mb-2">Palestrantes:</p>
                                        <div class="flex flex-wrap gap-2">
                                            ${speakers.map(speaker => `
                                                <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm">
                                                    ${speaker}
                                                </span>
                                            `).join('')}
                                        </div>
                                    </div>
                                ` : ''}

                                <!-- Botões -->
                                <div class="flex flex-wrap gap-3">
                                    <button onclick="downloadCertificate(${cert.id})" class="btn-primary text-white px-6 py-3 rounded-lg font-semibold flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                                        </svg>
                                        Ver Certificado
                                    </button>

                                    <button onclick="downloadPDF(${cert.id})" class="bg-white border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:border-[#1a5f3f] hover:text-[#1a5f3f] transition flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                        </svg>
                                        Baixar PDF
                                    </button>

                                    <button onclick="copyValidationCode('${cert.validation_code}')" class="bg-white border-2 border-gray-300 text-gray-700 px-6 py-3 rounded-lg font-semibold hover:border-[#1a5f3f] hover:text-[#1a5f3f] transition flex items-center">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                        </svg>
                                        Copiar Código de Validação
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function formatDate(dateString) {
            const date = new Date(dateString);
            return date.toLocaleDateString('pt-BR', { day: '2-digit', month: 'long', year: 'numeric' });
        }

        function downloadCertificate(certificateId) {
            const token = localStorage.getItem('auth_token');
            window.open(`${API_BASE_URL}/api/certificates/${certificateId}/download?token=${token}`, '_blank');
        }

        function downloadPDF(certificateId) {
            downloadCertificate(certificateId);
        }

        function copyValidationCode(code) {
            navigator.clipboard.writeText(code);
            alert('Código de validação copiado: ' + code);
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
