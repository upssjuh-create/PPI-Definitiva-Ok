<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Certificado - {{ $certificate->event->title }}</title>
    
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700|playfair-display:700" rel="stylesheet" />
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'iffar-green': '#1a5f3f',
                    },
                    fontFamily: {
                        'playfair': ['Playfair Display', 'serif'],
                    }
                }
            }
        }
    </script>
    
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        }
        
        /* Orientação paisagem para o certificado */
        .certificate-container {
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .certificate-border {
            border: 8px solid #1a5f3f;
            border-image: linear-gradient(45deg, #1a5f3f, #2d8659) 1;
            aspect-ratio: 1.414 / 1; /* Proporção A4 paisagem */
        }
        
        .signature-line {
            border-bottom: 2px solid #333;
            display: inline-block;
            min-width: 250px;
        }
        
        @media print {
            body {
                background: white;
            }
            .no-print {
                display: none !important;
            }
            @page {
                size: landscape;
                margin: 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="bg-[#1a5f3f] text-white shadow-lg no-print">
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
                    <span class="text-sm">{{ $certificate->user->name }}</span>
                    <a href="/my-registrations" class="flex items-center space-x-2 bg-white/10 hover:bg-white/20 px-4 py-2 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                        </svg>
                        <span class="text-sm">Voltar</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="certificate-container px-4 py-8">
        <!-- Botão Voltar -->
        <button onclick="window.location.href='/my-registrations'" class="flex items-center text-gray-700 hover:text-[#1a5f3f] mb-6 transition no-print">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Meus Eventos
        </button>

        <!-- Status Badge -->
        <div class="text-center mb-6 no-print">
            <div class="inline-flex items-center bg-green-100 text-green-800 px-6 py-3 rounded-full font-semibold">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                </svg>
                Certificado Disponível
            </div>
            <p class="text-gray-600 mt-2">Sua presença foi confirmada. O certificado está pronto para download.</p>
        </div>

        <!-- Certificado -->
        <div class="bg-white rounded-xl shadow-2xl p-6 md:p-10 certificate-border mb-6">
            <!-- Logo e Cabeçalho -->
            <div class="text-center mb-4">
                <div class="inline-block bg-[#1a5f3f] p-3 rounded-full mb-3">
                    <svg class="w-12 h-12 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/>
                    </svg>
                </div>
                <h2 class="text-xl font-bold text-[#1a5f3f] mb-1">INSTITUTO FEDERAL FARROUPILHA</h2>
                <p class="text-sm text-gray-600">Campus Santa Rosa</p>
            </div>

            <div class="border-t-2 border-b-2 border-gray-300 py-4 mb-4">
                <h3 class="text-2xl font-bold text-center text-gray-800 mb-4">CERTIFICADO</h3>
                
                <p class="text-center text-gray-700 text-base mb-3">Certificamos que</p>
                
                <h4 class="text-center font-playfair text-3xl font-bold text-[#1a5f3f] mb-4 signature-line px-8">
                    {{ $certificate->user->name }}
                </h4>
                
                <p class="text-center text-gray-700 text-base leading-relaxed px-4">
                    participou do evento <strong class="text-gray-900">{{ $certificate->event->title }}</strong>, 
                    realizado em <strong class="text-gray-900">{{ $dataFormatada }}</strong>, 
                    com carga horária de <strong class="text-gray-900">{{ $certificate->event->certificate_hours ?? 8 }} horas</strong>, 
                    no <strong class="text-gray-900">{{ $certificate->event->location }}</strong>.
                </p>
            </div>

            <!-- Informações do Evento -->
            <div class="grid grid-cols-3 gap-4 mb-6 text-center">
                <div>
                    <svg class="w-6 h-6 text-[#1a5f3f] mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="text-xs text-gray-600">Data</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $dataFormatada }}</p>
                </div>
                <div>
                    <svg class="w-6 h-6 text-[#1a5f3f] mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                    </svg>
                    <p class="text-xs text-gray-600">Local</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $certificate->event->location }}</p>
                </div>
                <div>
                    <svg class="w-6 h-6 text-[#1a5f3f] mx-auto mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-xs text-gray-600">Carga Horária</p>
                    <p class="text-sm font-semibold text-gray-900">{{ $certificate->event->certificate_hours ?? 8 }} horas</p>
                </div>
            </div>

            <!-- Assinaturas -->
            <div class="grid grid-cols-2 gap-8 mb-6">
                @if($certificate->event->signature1)
                <div class="text-center">
                    @if($certificate->event->signature1->image_path)
                    <div class="mb-2 h-16 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $certificate->event->signature1->image_path) }}" alt="{{ $certificate->event->signature1->name }}" class="max-h-16">
                    </div>
                    @else
                    <div class="signature-line mb-2"></div>
                    @endif
                    <p class="text-sm font-semibold text-gray-900">{{ $certificate->event->signature1->name }}</p>
                    <p class="text-xs text-gray-600">{{ $certificate->event->signature1->title }}</p>
                </div>
                @else
                <div class="text-center">
                    <div class="signature-line mb-2"></div>
                    <p class="text-sm font-semibold text-gray-900">{{ $certificate->event->organizer ?? 'Coordenador' }}</p>
                    <p class="text-xs text-gray-600">Coordenador do Evento</p>
                </div>
                @endif

                @if($certificate->event->signature2)
                <div class="text-center">
                    @if($certificate->event->signature2->image_path)
                    <div class="mb-2 h-16 flex items-center justify-center">
                        <img src="{{ asset('storage/' . $certificate->event->signature2->image_path) }}" alt="{{ $certificate->event->signature2->name }}" class="max-h-16">
                    </div>
                    @else
                    <div class="signature-line mb-2"></div>
                    @endif
                    <p class="text-sm font-semibold text-gray-900">{{ $certificate->event->signature2->name }}</p>
                    <p class="text-xs text-gray-600">{{ $certificate->event->signature2->title }}</p>
                </div>
                @else
                <div class="text-center">
                    <div class="signature-line mb-2"></div>
                    <p class="text-sm font-semibold text-gray-900">Diretor(a)</p>
                    <p class="text-xs text-gray-600">Direção de Ensino</p>
                </div>
                @endif
            </div>

            <!-- Código de Validação -->
            <div class="bg-gray-50 rounded-lg p-3 text-center">
                <div class="flex items-center justify-center mb-1">
                    <svg class="w-4 h-4 text-gray-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                    <p class="text-xs text-gray-600 font-semibold">Código de Validação</p>
                </div>
                <p class="text-base font-mono font-bold text-[#1a5f3f]">{{ $certificate->certificate_code }}</p>
                <p class="text-xs text-gray-500 mt-1">Valide este certificado em: <span class="font-semibold">eventos.iffar.edu.br/validar</span></p>
            </div>
        </div>

        <!-- Botões de Ação -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 no-print">
            <a href="/certificates/{{ $certificate->id }}/download" class="bg-[#1a5f3f] text-white px-6 py-4 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                Baixar Certificado (PDF)
            </a>
            <button onclick="validateCertificate('{{ $certificate->certificate_code }}')" class="bg-blue-600 text-white px-6 py-4 rounded-lg font-semibold hover:bg-blue-700 transition flex items-center justify-center shadow-lg">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                Validar Certificado
            </button>
        </div>

        <!-- Informações Sobre o Certificado -->
        <div class="bg-gray-100 rounded-lg p-6 mt-6 no-print">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center">
                <svg class="w-5 h-5 mr-2 text-[#1a5f3f]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Sobre o Certificado
            </h3>
            <ul class="space-y-2 text-sm text-gray-700">
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Este certificado possui um código único de validação que pode ser verificado publicamente.
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    O documento em PDF contém assinatura digital para garantir sua autenticidade.
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    Você pode compartilhar o código de validação para que terceiros verifiquem a autenticidade.
                </li>
                <li class="flex items-start">
                    <svg class="w-5 h-5 text-green-600 mr-2 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                    O certificado ficará disponível permanentemente em sua conta.
                </li>
            </ul>
        </div>

        <!-- Botão Voltar -->
        <div class="text-center mt-6 no-print">
            <a href="/my-registrations" class="text-gray-600 hover:text-[#1a5f3f] font-semibold">
                Voltar para Meus Eventos
            </a>
        </div>
    </main>

    <script>
        function validateCertificate(code) {
            // Copiar código para clipboard
            navigator.clipboard.writeText(code).then(() => {
                alert(`Código copiado: ${code}\n\nVocê pode validar em: eventos.iffar.edu.br/validar`);
            }).catch(() => {
                alert(`Código de validação: ${code}\n\nVocê pode validar em: eventos.iffar.edu.br/validar`);
            });
        }
    </script>
</body>
</html>
