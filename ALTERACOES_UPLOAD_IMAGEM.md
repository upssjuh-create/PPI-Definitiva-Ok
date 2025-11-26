# Alterações Implementadas - Upload de Imagem

## Resumo

Foi implementado um sistema completo de upload de imagens para eventos, permitindo que o administrador selecione uma imagem diretamente dos arquivos da máquina ao criar ou editar um evento.

## Arquivos Modificados

### Frontend (React/TypeScript)

1. **src/components/EventForm.tsx**
   - Adicionado campo de upload de arquivo (`<input type="file">`)
   - Implementado preview da imagem selecionada
   - Adicionado estado para gerenciar o arquivo de imagem
   - Removido campo de texto para URL da imagem

2. **src/App.tsx**
   - Modificado `handleSaveEvent` para ser assíncrono
   - Integrado com o serviço de API para enviar dados com FormData
   - Adicionado tratamento de erros

3. **src/services/api.ts** (NOVO)
   - Criado serviço de API para criar e atualizar eventos
   - Implementado envio de FormData com arquivo de imagem
   - Configurado headers de autenticação

4. **src/utils/imageHelper.ts** (NOVO)
   - Criada função `getImageUrl()` para construir URLs corretas das imagens
   - Suporte para URLs externas e caminhos do storage

5. **Componentes atualizados para usar `getImageUrl()`:**
   - src/components/EventDiscovery.tsx
   - src/components/EventDetails.tsx
   - src/components/AdminDashboard.tsx
   - src/components/MyEvents.tsx
   - src/components/CompletedEvents.tsx

### Backend (Laravel)

1. **config/filesystems.php**
   - Configurado disco 'public' para armazenamento de imagens
   - Definido URL pública para acesso às imagens

2. **app/Http/Controllers/EventController.php**
   - Já estava configurado para receber upload de imagens
   - Validação: `'image' => 'nullable|image|max:2048'`
   - Armazena em `storage/app/public/events/`

### Configuração

1. **.env.local** (NOVO)
   - Configurado URL da API: `VITE_API_URL=http://localhost:8000/api`

## Como Usar

### 1. Configurar o Backend

```bash
# Criar link simbólico do storage
php artisan storage:link

# Verificar permissões (Linux/Mac)
chmod -R 775 storage
chmod -R 775 bootstrap/cache
```

### 2. Iniciar os Servidores

```bash
# Backend (Laravel)
php artisan serve

# Frontend (React)
npm run dev
```

### 3. Criar Evento com Imagem

1. Faça login como administrador
2. Clique em "Criar Evento"
3. Preencha os campos do formulário
4. Clique no campo "Imagem do Evento" e selecione uma imagem do seu computador
5. Visualize o preview da imagem
6. Clique em "Salvar"

## Funcionalidades

✅ Upload de imagem diretamente do computador
✅ Preview da imagem antes de salvar
✅ Validação de tipo de arquivo (apenas imagens)
✅ Armazenamento seguro no servidor
✅ URLs corretas para exibição das imagens
✅ Suporte para edição de eventos (atualizar imagem)
✅ Compatibilidade com URLs externas (para eventos antigos)

## Estrutura de Armazenamento

```
storage/
  app/
    public/
      events/
        nome-do-arquivo-123456.jpg
        outro-arquivo-789012.png

public/
  storage/ -> link simbólico para storage/app/public
```

## URLs de Acesso

- Imagem salva: `http://localhost:8000/storage/events/nome-arquivo.jpg`
- API de eventos: `http://localhost:8000/api/admin/events`

## Observações

- Tamanho máximo de arquivo: 2MB
- Formatos aceitos: jpg, jpeg, png, gif, svg, webp
- As imagens antigas com URLs externas continuam funcionando
- O preview usa base64 para exibição imediata
