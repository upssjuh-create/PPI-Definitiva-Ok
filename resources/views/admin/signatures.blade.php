<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gerenciar Assinaturas - Admin</title>
    
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
                        <p class="text-sm text-white/90">Gerenciar Assinaturas</p>
                    </div>
                </div>
                <a href="/admin/dashboard" class="text-sm hover:underline">Voltar ao Dashboard</a>
            </div>
        </div>
    </header>

    @include('admin.partials.nav')

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8 max-w-6xl">
        <div class="flex justify-between items-center mb-6">
            <div>
                <h2 class="text-2xl font-bold text-gray-900 mb-2">Assinaturas para Certificados</h2>
                <p class="text-gray-600">Gerencie as assinaturas que aparecerão nos certificados</p>
            </div>
            <button onclick="openCreateModal()" class="bg-[#1a5f3f] text-white px-6 py-3 rounded-lg font-semibold hover:bg-[#155030] transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
                </svg>
                Nova Assinatura
            </button>
        </div>

        <!-- Lista de Assinaturas -->
        <div id="signatures-list" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Carregando... -->
            <div class="col-span-full text-center py-12">
                <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-[#1a5f3f] mx-auto"></div>
                <p class="text-gray-600 mt-4">Carregando assinaturas...</p>
            </div>
        </div>
    </main>

    <!-- Modal Criar/Editar Assinatura -->
    <div id="signatureModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white rounded-xl shadow-2xl max-w-md w-full mx-4">
            <div class="bg-[#1a5f3f] text-white px-6 py-4 rounded-t-xl">
                <h3 class="text-xl font-bold" id="modalTitle">Nova Assinatura</h3>
            </div>
            <form id="signatureForm" class="p-6 space-y-4">
                <input type="hidden" id="signature_id">
                
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Nome Completo</label>
                    <input type="text" id="signature_name" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                        placeholder="Ex: Prof. Carlos Alberto Santos">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Cargo/Função</label>
                    <input type="text" id="signature_title" required
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent"
                        placeholder="Ex: Coordenador do Evento">
                </div>

                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">Imagem da Assinatura</label>
                    <input type="file" id="signature_image" accept="image/png,image/jpeg,image/jpg"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#1a5f3f] focus:border-transparent">
                    <p class="text-xs text-gray-500 mt-1">PNG, JPG ou JPEG (máx. 2MB)</p>
                    <div id="imagePreview" class="mt-3 hidden">
                        <img id="previewImg" class="max-h-32 border rounded">
                    </div>
                </div>

                <div class="flex gap-3 pt-4">
                    <button type="button" onclick="closeModal()" 
                        class="flex-1 px-4 py-2 border border-gray-300 rounded-lg hover:bg-gray-50 transition">
                        Cancelar
                    </button>
                    <button type="submit" 
                        class="flex-1 bg-[#1a5f3f] text-white px-4 py-2 rounded-lg hover:bg-[#155030] transition">
                        Salvar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        const API_BASE_URL = window.location.origin;
        let signatures = [];

        // Carregar assinaturas ao iniciar
        window.addEventListener('DOMContentLoaded', loadSignatures);

        // Preview da imagem
        document.getElementById('signature_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('previewImg').src = e.target.result;
                    document.getElementById('imagePreview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });

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
                    signatures = await response.json();
                    displaySignatures();
                } else {
                    throw new Error('Erro ao carregar assinaturas');
                }
            } catch (error) {
                console.error('Erro:', error);
                document.getElementById('signatures-list').innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <p class="text-red-600">Erro ao carregar assinaturas</p>
                    </div>
                `;
            }
        }

        function displaySignatures() {
            const container = document.getElementById('signatures-list');
            
            if (signatures.length === 0) {
                container.innerHTML = `
                    <div class="col-span-full text-center py-12">
                        <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                        <p class="text-gray-600">Nenhuma assinatura cadastrada</p>
                        <button onclick="openCreateModal()" class="mt-4 text-[#1a5f3f] hover:underline">
                            Criar primeira assinatura
                        </button>
                    </div>
                `;
                return;
            }

            container.innerHTML = signatures.map(sig => `
                <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 mb-1">${sig.name}</h3>
                                <p class="text-sm text-gray-600">${sig.title}</p>
                            </div>
                            <span class="px-2 py-1 text-xs rounded ${sig.is_active ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800'}">
                                ${sig.is_active ? 'Ativa' : 'Inativa'}
                            </span>
                        </div>
                        
                        <div class="bg-gray-50 rounded-lg p-4 mb-4">
                            <img src="/storage/${sig.image_path}" alt="${sig.name}" class="max-h-24 mx-auto">
                        </div>
                        
                        <div class="flex gap-2">
                            <button onclick="editSignature(${sig.id})" 
                                class="flex-1 bg-blue-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-blue-700 transition">
                                Editar
                            </button>
                            <button onclick="deleteSignature(${sig.id})" 
                                class="flex-1 bg-red-600 text-white px-3 py-2 rounded-lg text-sm hover:bg-red-700 transition">
                                Excluir
                            </button>
                        </div>
                    </div>
                </div>
            `).join('');
        }

        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Nova Assinatura';
            document.getElementById('signatureForm').reset();
            document.getElementById('signature_id').value = '';
            document.getElementById('imagePreview').classList.add('hidden');
            document.getElementById('signature_image').required = true;
            document.getElementById('signatureModal').classList.remove('hidden');
        }

        function editSignature(id) {
            const signature = signatures.find(s => s.id === id);
            if (!signature) return;

            document.getElementById('modalTitle').textContent = 'Editar Assinatura';
            document.getElementById('signature_id').value = signature.id;
            document.getElementById('signature_name').value = signature.name;
            document.getElementById('signature_title').value = signature.title;
            document.getElementById('signature_image').required = false;
            
            // Mostrar preview da imagem atual
            document.getElementById('previewImg').src = `/storage/${signature.image_path}`;
            document.getElementById('imagePreview').classList.remove('hidden');
            
            document.getElementById('signatureModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('signatureModal').classList.add('hidden');
        }

        document.getElementById('signatureForm').addEventListener('submit', async function(e) {
            e.preventDefault();

            const id = document.getElementById('signature_id').value;
            const formData = new FormData();
            formData.append('name', document.getElementById('signature_name').value);
            formData.append('title', document.getElementById('signature_title').value);
            
            const imageFile = document.getElementById('signature_image').files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }

            try {
                const token = localStorage.getItem('auth_token');
                const url = id ? `${API_BASE_URL}/api/signatures/${id}` : `${API_BASE_URL}/api/signatures`;
                const method = id ? 'POST' : 'POST';
                
                if (id) {
                    formData.append('_method', 'PUT');
                }

                const response = await fetch(url, {
                    method: method,
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    },
                    body: formData
                });

                if (response.ok) {
                    alert(id ? 'Assinatura atualizada com sucesso!' : 'Assinatura criada com sucesso!');
                    closeModal();
                    loadSignatures();
                } else {
                    const data = await response.json();
                    alert(data.message || 'Erro ao salvar assinatura');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao salvar assinatura');
            }
        });

        async function deleteSignature(id) {
            if (!confirm('Tem certeza que deseja excluir esta assinatura?')) return;

            try {
                const token = localStorage.getItem('auth_token');
                const response = await fetch(`${API_BASE_URL}/api/signatures/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'Authorization': `Bearer ${token}`,
                        'Accept': 'application/json',
                    }
                });

                if (response.ok) {
                    alert('Assinatura excluída com sucesso!');
                    loadSignatures();
                } else {
                    alert('Erro ao excluir assinatura');
                }
            } catch (error) {
                console.error('Erro:', error);
                alert('Erro ao excluir assinatura');
            }
        }
    </script>
</body>
</html>
