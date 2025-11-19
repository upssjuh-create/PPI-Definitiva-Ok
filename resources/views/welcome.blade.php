<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CertificalFFar - Gestão de Eventos Acadêmicos</title>
    
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
        }
        
        /* Custom colors for IFFar */
        .bg-iffar-green {
            background-color: #1a5f3f;
        }
        
        /* Smooth animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }
        
        /* Hover effects for cards */
        .feature-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        
        /* Scroll behavior */
        html {
            scroll-behavior: smooth;
        }
    </style>
</head>
<body class="antialiased">
    <!-- Header -->
    <header class="bg-white text-gray-800 sticky top-0 z-50 shadow-lg border-b border-gray-200">
        <div class="container mx-auto px-6 py-4">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-3">
                    <svg class="w-8 h-8 text-[#1a5f3f]" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                    </svg>
                    <div>
                        <h1 class="text-xl font-bold text-gray-900">CertificalFFar</h1>
                        <p class="text-xs text-gray-600">Gestão de Eventos Acadêmicos</p>
                    </div>
                </div>
                <nav class="hidden md:flex items-center space-x-6">
                    <a href="https://www.iffar.edu.br" target="_blank" class="flex items-center space-x-1 text-gray-700 hover:text-[#1a5f3f] transition">
                        <span>Site IFFar</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="#" class="flex items-center space-x-1 text-gray-700 hover:text-[#1a5f3f] transition">
                        <span>Cursos</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="#" class="flex items-center space-x-1 text-gray-700 hover:text-[#1a5f3f] transition">
                        <span>Sobre o IFFar</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="bg-[#1a5f3f] hover:bg-[#155030] text-white px-6 py-2 rounded-lg font-semibold transition">
                        Acessar
                    </a>
                </nav>
                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden p-2 hover:bg-gray-100 rounded-lg transition text-gray-700">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
            </div>
            <!-- Mobile Menu -->
            <nav id="mobile-menu" class="hidden md:hidden mt-4 pb-4 border-t border-gray-200">
                <div class="flex flex-col space-y-4 pt-4">
                    <a href="https://www.iffar.edu.br" target="_blank" class="flex items-center space-x-2 text-gray-700 hover:text-[#1a5f3f] transition py-2">
                        <span>Site IFFar</span>
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                    </a>
                    <a href="#" class="text-gray-700 hover:text-[#1a5f3f] transition py-2">Cursos</a>
                    <a href="#" class="text-gray-700 hover:text-[#1a5f3f] transition py-2">Sobre o IFFar</a>
                    <a href="{{ route('login') }}" class="bg-[#1a5f3f] hover:bg-[#155030] text-white px-6 py-2 rounded-lg font-semibold transition text-center">
                        Acessar
                    </a>
                </div>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section class="bg-[#1a5f3f] text-white py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-4xl mx-auto text-center mb-12">
                <span class="inline-block bg-green-600 text-white text-xs px-3 py-1 rounded-full mb-4">
                    Plataforma oficial do IFFar
                </span>
                <h2 class="text-4xl md:text-5xl font-bold mb-4">
                    Gerencie eventos acadêmicos com <span class="text-green-300">facilidade</span>
                </h2>
                <p class="text-lg text-green-100 mb-8 max-w-2xl mx-auto">
                    Sistema completo para inscrição em eventos, pagamentos online, check-in digital e emissão de certificados validados.
                </p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('register') }}" class="bg-green-600 hover:bg-green-700 text-white px-8 py-4 rounded-lg font-semibold flex items-center justify-center space-x-2 transition shadow-lg hover:shadow-xl">
                        <span>Começar Agora</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"/>
                        </svg>
                    </a>
                    <a href="{{ route('login') }}" class="bg-white/10 hover:bg-white/20 backdrop-blur-sm text-white px-8 py-4 rounded-lg font-semibold flex items-center justify-center space-x-2 transition border border-white/20">
                        <span>Já tenho conta</span>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Features Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 max-w-6xl mx-auto mb-16">
                <div class="feature-card bg-green-600/20 backdrop-blur-sm rounded-lg p-6 border border-green-500/30">
                    <div class="bg-green-500 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Inscrições Fáceis</h3>
                    <p class="text-green-100 text-sm">Sistema intuitivo de busca e inscrição em eventos.</p>
                </div>

                <div class="feature-card bg-green-600/20 backdrop-blur-sm rounded-lg p-6 border border-green-500/30">
                    <div class="bg-green-500 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Pagamento Online</h3>
                    <p class="text-green-100 text-sm">PIX e cartão de crédito/débito.</p>
                </div>

                <div class="feature-card bg-green-600/20 backdrop-blur-sm rounded-lg p-6 border border-green-500/30">
                    <div class="bg-green-500 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Check-in Digital</h3>
                    <p class="text-green-100 text-sm">QR Code para registro de presença.</p>
                </div>

                <div class="feature-card bg-green-600/20 backdrop-blur-sm rounded-lg p-6 border border-green-500/30">
                    <div class="bg-green-500 w-12 h-12 rounded-lg flex items-center justify-center mb-4">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-lg mb-2">Certificados Digitais</h3>
                    <p class="text-green-100 text-sm">Emissão automática e validação online.</p>
                </div>
            </div>

            <!-- Statistics -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto text-center">
                <div>
                    <div class="text-4xl font-bold text-green-300 mb-2">500+</div>
                    <div class="text-green-100">Eventos realizados</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-300 mb-2">10K+</div>
                    <div class="text-green-100">Certificados emitidos</div>
                </div>
                <div>
                    <div class="text-4xl font-bold text-green-300 mb-2">95%</div>
                    <div class="text-green-100">Satisfação</div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="bg-white py-20">
        <div class="container mx-auto px-6">
            <div class="max-w-6xl mx-auto">
                <h2 class="text-3xl md:text-4xl font-bold text-center mb-4 text-gray-800">Como funciona?</h2>
                <p class="text-center text-gray-600 mb-12">Simples, rápido e seguro em 4 passos</p>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="bg-[#1a5f3f] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">1</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Cadastre-se</h3>
                        <p class="text-gray-600 text-sm">Crie sua conta com seus dados acadêmicos do IFFar de forma rápida e segura.</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-[#1a5f3f] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">2</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Escolha o Evento</h3>
                        <p class="text-gray-600 text-sm">Navegue pelos eventos disponíveis: workshops, palestras, minicursos e mais.</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-[#1a5f3f] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">3</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Inscreva-se</h3>
                        <p class="text-gray-600 text-sm">Realize o pagamento online (se necessário) via PIX ou cartão e confirme sua vaga.</p>
                    </div>

                    <div class="text-center">
                        <div class="bg-[#1a5f3f] text-white w-16 h-16 rounded-full flex items-center justify-center text-2xl font-bold mx-auto mb-4">4</div>
                        <h3 class="font-bold text-lg mb-2 text-gray-800">Receba seu Certificado</h3>
                        <p class="text-gray-600 text-sm">Após participar do evento, receba automaticamente seu certificado digital validado.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-900 text-white py-12">
            <div class="container mx-auto px-6">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                    <div>
                        <div class="flex items-center space-x-3 mb-4">
                            <svg class="w-8 h-8 text-green-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                            </svg>
                            <h3 class="text-xl font-bold">CertificalFFar</h3>
                        </div>
                        <p class="text-gray-400 text-sm">
                            Plataforma oficial do Instituto Federal Farroupilha para gestão de eventos acadêmicos.
                        </p>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Links Rápidos</h4>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="{{ route('login') }}" class="hover:text-green-400 transition">Acessar Sistema</a></li>
                            <li><a href="{{ route('register') }}" class="hover:text-green-400 transition">Criar Conta</a></li>
                            <li><a href="https://www.iffar.edu.br" target="_blank" class="hover:text-green-400 transition">Site IFFar</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Recursos</h4>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li><a href="#" class="hover:text-green-400 transition">Eventos</a></li>
                            <li><a href="#" class="hover:text-green-400 transition">Certificados</a></li>
                            <li><a href="#" class="hover:text-green-400 transition">Suporte</a></li>
                        </ul>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-4">Contato</h4>
                        <ul class="space-y-2 text-sm text-gray-400">
                            <li>IFFar - Instituto Federal Farroupilha</li>
                            <li>Email: contato@iffar.edu.br</li>
                            <li>Telefone: (55) 99999-9999</li>
                        </ul>
                    </div>
                </div>

                <div class="border-t border-gray-800 mt-8 pt-8 text-center text-sm text-gray-400">
                    <p>&copy; {{ date('Y') }} CertificalFFar - IFFar. Todos os direitos reservados.</p>
                </div>
            </div>
        </footer>

        <script>
            // Mobile menu toggle
            document.getElementById('mobile-menu-button')?.addEventListener('click', function() {
                const menu = document.getElementById('mobile-menu');
                if (menu) {
                    menu.classList.toggle('hidden');
                }
            });

            // Smooth scroll for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function (e) {
                    const href = this.getAttribute('href');
                    if (href !== '#' && href.length > 1) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });
        </script>
    </body>
</html>