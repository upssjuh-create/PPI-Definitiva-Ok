<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Criar Novo Evento - CertificalFFar</title>
    
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
        
        .section-card {
            transition: all 0.3s ease;
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
                        <p class="text-sm text-white/90">Painel Administrativo</p>
                    </div>
                </div>
                <div class="flex items-center space-x-4">
                    <span class="text-sm">Administrador</span>
                    <span class="text-sm font-semibold" id="admin-name">Admin IFFar</span>
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

    @include('admin.partials.nav')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-4xl">
        <!-- Botão Voltar -->
        <button onclick="window.location.href='/admin/events'" class="flex items-center text-gray-600 hover:text-[#1a5f3f] mb-6 transition">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            Voltar para Dashboard
        </button>

        <!-- Título -->
        <div class="mb-8">
            <h2 class="text-3xl font-bold text-gray-900 mb-2">Criar Novo Evento</h2>
            <p class="text-gray-600">Preencha os dados para criar um novo evento</p>
        </div>

        <form id="event-form" onsubmit="handleSubmit(event); return false;">
            <!-- Informações Básicas -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Informações Básicas</h3>

                <div class="space-y-4">
                    <!-- Título -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Título do Evento *</label>
                        <input type="text" name="title" placeholder="Ex: Semana Acadêmica de Tecnologia 2025" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                    </div>

                    <!-- Descrição -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descrição *</label>
                        <textarea name="description" rows="4" placeholder="Descreva o evento, objetivos e principais atividades..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required></textarea>
                    </div>

                    <!-- Categoria e Organizador -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Categoria *</label>
                            <select name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                                <option value="">Selecione uma categoria</option>
                                <option value="Tecnologia">Tecnologia</option>
                                <option value="Workshop">Workshop</option>
                                <option value="Palestra">Palestra</option>
                                <option value="Minicurso">Minicurso</option>
                                <option value="Semana Acadêmica">Semana Acadêmica</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Organizador *</label>
                            <input type="text" name="organizer" placeholder="Ex: Departamento de Ciência da Computação" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Data, Horário e Local -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Data, Horário e Local</h3>
                </div>

                <div class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Data *</label>
                            <input type="date" name="date" placeholder="Ex: 15 de Março de 2025" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Horário *</label>
                            <input type="text" name="time" placeholder="Ex: 14:00 - 18:00" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Local *</label>
                        <input type="text" name="location" placeholder="Ex: Auditório Principal, Bloco A" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                    </div>
                </div>
            </div>
            <!-- Capacidade e Preço -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Capacidade e Preço</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Capacidade Máxima *</label>
                        <input type="number" name="capacity" placeholder="100" min="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Preço da Inscrição (R$) *</label>
                        <input type="number" id="price-input" name="price" placeholder="0.00" min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]" required>
                        <p class="text-sm text-gray-500 mt-1">Digite 0 para evento gratuito. Pagamentos via PIX e Cartão são processados pelo Mercado Pago.</p>
                    </div>
                </div>
            </div>


            <!-- Imagem do Evento -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Imagem do Evento</h3>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">URL da Imagem</label>
                    <input type="url" name="image" placeholder="https://exemplo.com/imagem.jpg" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                    <p class="text-sm text-gray-500 mt-2">Cole a URL de uma imagem ou use uma imagem do Unsplash</p>
                </div>
            </div>

            <!-- Palestrantes -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Palestrantes e Apresentadores</h3>
                </div>

                <div class="flex gap-2">
                    <input type="text" id="speaker-input" placeholder="Ex: Dr. João Silva - Especialista em IA" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                    <button type="button" onclick="addSpeaker()" class="bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition">
                        Adicionar
                    </button>
                </div>

                <div id="speakers-list" class="mt-4 space-y-2">
                    <!-- Palestrantes adicionados aparecerão aqui -->
                </div>
            </div>

            <!-- Tags -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <div class="flex items-center mb-4">
                    <svg class="w-6 h-6 text-[#1a5f3f] mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                    <h3 class="text-xl font-bold text-gray-900">Tags do Evento</h3>
                </div>

                <div class="flex gap-2">
                    <input type="text" id="tag-input" placeholder="Ex: IA, Networking, Carreira" class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                    <button type="button" onclick="addTag()" class="bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition">
                        Adicionar
                    </button>
                </div>

                <div id="tags-list" class="mt-4 flex flex-wrap gap-2">
                    <!-- Tags adicionadas aparecerão aqui -->
                </div>
            </div>

            <!-- Certificado -->
            <div class="section-card bg-white rounded-xl shadow-md p-6 mb-6">
                <h3 class="text-xl font-bold text-gray-900 mb-4">Configurações do Certificado</h3>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Carga Horária (horas)</label>
                        <input type="number" name="certificate_hours" placeholder="40" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Descrição do Certificado</label>
                        <textarea name="certificate_description" rows="3" placeholder="Texto que aparecerá no certificado..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]"></textarea>
                    </div>

                    <!-- Assinaturas -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Assinatura 1 (Coordenador)</label>
                            <select name="signature1_id" id="signature1_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                                <option value="">Selecione uma assinatura</option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Assinatura 2 (Diretor)</label>
                            <select name="signature2_id" id="signature2_id" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-[#1a5f3f]">
                                <option value="">Selecione uma assinatura</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Botões -->
            <div class="flex items-center justify-end space-x-4">
                <button type="button" onclick="window.location.href='/admin/events'" class="px-6 py-3 border-2 border-gray-300 text-gray-700 rounded-lg font-semibold hover:bg-gray-50 transition">
                    Cancelar
                </button>
                <button type="submit" class="bg-[#1a5f3f] text-white px-8 py-3 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Criar Evento
                </button>
            </div>
        </form>
    </main>

    <script>
        const API_BASE_URL = window.location.origin;
        let speakers = [];
        let tags = [];

        window.addEventListener('DOMContentLoaded', function() {
            const user = JSON.parse(localStorage.getItem('user') || '{}');
            if (user.name) {
                document.getElementById('admin-name').textContent = user.name;
            }
            
            // Carregar assinaturas
            loadSignatures();
        });

        // Carregar assinaturas disponíveis
        async function loadSignatures() {
            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/signatures`, {
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    const signatures = await response.json();
                    const activeSignatures = signatures.filter(s => s.is_active);
                    
                    const select1 = document.getElementById('signature1_id');
                    const select2 = document.getElementById('signature2_id');
                    
                    activeSignatures.forEach(sig => {
                        const option1 = new Option(`${sig.name} - ${sig.title}`, sig.id);
                        const option2 = new Option(`${sig.name} - ${sig.title}`, sig.id);
                        select1.add(option1);
                        select2.add(option2);
                    });
                }
            } catch (error) {
                console.error('Erro ao carregar assinaturas:', error);
            }
        }

        // Adicionar palestrante
        function addSpeaker() {
            const input = document.getElementById('speaker-input');
            const speaker = input.value.trim();

            if (speaker) {
                speakers.push(speaker);
                input.value = '';
                renderSpeakers();
            }
        }

        function renderSpeakers() {
            const list = document.getElementById('speakers-list');
            list.innerHTML = speakers.map((speaker, index) => `
                <div class="flex items-center justify-between bg-gray-100 px-4 py-2 rounded-lg">
                    <span class="text-gray-900">${speaker}</span>
                    <button type="button" onclick="removeSpeaker(${index})" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            `).join('');
        }

        function removeSpeaker(index) {
            speakers.splice(index, 1);
            renderSpeakers();
        }

        // Adicionar tag
        function addTag() {
            const input = document.getElementById('tag-input');
            const tag = input.value.trim();

            if (tag) {
                tags.push(tag);
                input.value = '';
                renderTags();
            }
        }

        function renderTags() {
            const list = document.getElementById('tags-list');
            list.innerHTML = tags.map((tag, index) => `
                <span class="inline-flex items-center bg-[#1a5f3f] text-white px-3 py-1 rounded-full text-sm">
                    ${tag}
                    <button type="button" onclick="removeTag(${index})" class="ml-2 hover:text-red-200">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </span>
            `).join('');
        }

        function removeTag(index) {
            tags.splice(index, 1);
            renderTags();
        }

        // Submit form
        async function handleSubmit(event) {
            event.preventDefault();

            const formData = new FormData(event.target);
            const data = {
                title: formData.get('title'),
                description: formData.get('description'),
                category: formData.get('category'),
                organizer: formData.get('organizer'),
                date: formData.get('date'),
                time: formData.get('time'),
                location: formData.get('location'),
                capacity: parseInt(formData.get('capacity')),
                price: parseFloat(formData.get('price')),
                image: formData.get('image'),
                speakers: speakers,
                tags: tags,
                certificate_hours: parseInt(formData.get('certificate_hours')) || null,
                certificate_description: formData.get('certificate_description')
            };

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/admin/events`, {
                    method: 'POST',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(data)
                });

                if (response.ok) {
                    alert('Evento criado com sucesso!');
                    window.location.href = '/admin/events';
                } else {
                    const error = await response.json();
                    alert('Erro ao criar evento: ' + (error.message || 'Tente novamente'));
                }
            } catch (error) {
                alert('Erro ao criar evento. Tente novamente.');
            }
        }

        function logout() {
            localStorage.removeItem('auth_token');
            localStorage.removeItem('user');
            window.location.href = '/login';
        }
    </script>
</body>
</html>
