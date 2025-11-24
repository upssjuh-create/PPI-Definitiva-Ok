<!-- Navegação Admin -->
<nav class="bg-white border-b border-gray-200 shadow-sm">
    <div class="container mx-auto px-4">
        <div class="flex space-x-1 overflow-x-auto">
            <a href="/admin/dashboard" id="nav-dashboard"
                class="flex items-center space-x-2 px-4 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-[#1a5f3f] hover:border-gray-300 transition whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                </svg>
                <span>Visão Geral</span>
            </a>

            <a href="/admin/events" id="nav-events"
                class="flex items-center space-x-2 px-4 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-[#1a5f3f] hover:border-gray-300 transition whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <span>Gerenciar Eventos</span>
            </a>

            <a href="/admin/cancellations" id="nav-cancellations"
                class="flex items-center space-x-2 px-4 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-[#1a5f3f] hover:border-gray-300 transition whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
                <span>Cancelamentos</span>
            </a>

            <a href="/admin/validate-certificates" id="nav-validate"
                class="flex items-center space-x-2 px-4 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-[#1a5f3f] hover:border-gray-300 transition whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
                <span>Validar Certificados</span>
            </a>

            <a href="/admin/signatures" id="nav-signatures"
                class="flex items-center space-x-2 px-4 py-4 text-sm font-medium border-b-2 border-transparent text-gray-600 hover:text-[#1a5f3f] hover:border-gray-300 transition whitespace-nowrap">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
                <span>Assinaturas</span>
            </a>
        </div>
    </div>
</nav>

<script>
    // Marcar aba ativa baseado na URL
    document.addEventListener('DOMContentLoaded', function() {
        const path = window.location.pathname;
        const navLinks = document.querySelectorAll('nav a[id^="nav-"]');
        
        navLinks.forEach(link => {
            link.classList.remove('border-[#1a5f3f]', 'text-[#1a5f3f]');
            link.classList.add('border-transparent', 'text-gray-600');
        });
        
        if (path.includes('/admin/dashboard')) {
            document.getElementById('nav-dashboard')?.classList.add('border-[#1a5f3f]', 'text-[#1a5f3f]');
        } else if (path.includes('/admin/events')) {
            document.getElementById('nav-events')?.classList.add('border-[#1a5f3f]', 'text-[#1a5f3f]');
        } else if (path.includes('/admin/cancellations')) {
            document.getElementById('nav-cancellations')?.classList.add('border-[#1a5f3f]', 'text-[#1a5f3f]');
        } else if (path.includes('/admin/validate-certificates')) {
            document.getElementById('nav-validate')?.classList.add('border-[#1a5f3f]', 'text-[#1a5f3f]');
        } else if (path.includes('/admin/signatures')) {
            document.getElementById('nav-signatures')?.classList.add('border-[#1a5f3f]', 'text-[#1a5f3f]');
        }
    });
</script>

