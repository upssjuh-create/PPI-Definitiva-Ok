# Guia Rápido de Teste - Upload de Imagem

## Passo a Passo

### 1. Preparar o Ambiente

```bash
# No terminal do backend (Laravel)
php artisan storage:link
php artisan serve
```

```bash
# No terminal do frontend (React) - em outra janela
npm run dev
```

### 2. Testar o Upload

1. Abra o navegador em `http://localhost:5173` (ou a porta que o Vite indicar)

2. Faça login como administrador

3. Clique em "Admin" → "Criar Evento"

4. Preencha os campos:
   - Título: "Teste de Upload"
   - Descrição: "Testando upload de imagem"
   - Data: "2025-12-01"
   - Horário: "14:00"
   - Local: "Auditório"
   - Categoria: "Teste"
   - Organizador: "Admin"
   - Capacidade: 50
   - Preço: 0

5. No campo "Imagem do Evento":
   - Clique no botão de seleção
   - Escolha uma imagem do seu computador
   - Verifique se o preview aparece abaixo

6. Clique em "Salvar"

7. Verifique se o evento aparece no dashboard com a imagem

### 3. Verificar no Backend

```bash
# Verificar se a imagem foi salva
ls storage/app/public/events/

# Verificar se o link simbólico existe
ls -la public/storage
```

### 4. Testar Edição

1. No dashboard admin, clique em "Editar" no evento criado
2. Selecione uma nova imagem
3. Salve e verifique se a imagem foi atualizada

## Possíveis Problemas

### Erro 404 ao carregar imagem

**Solução:**
```bash
php artisan storage:link
```

### Erro de permissão ao fazer upload

**Solução (Linux/Mac):**
```bash
chmod -R 775 storage
```

**Solução (Windows):**
Execute o terminal como administrador

### Imagem não aparece no preview

**Solução:**
- Verifique o console do navegador (F12)
- Certifique-se de que o arquivo é uma imagem válida
- Verifique se o tamanho é menor que 2MB

### Erro ao salvar evento

**Solução:**
- Verifique se o backend está rodando
- Verifique o arquivo `.env.local` no frontend
- Verifique o console do navegador para erros de rede
- Verifique os logs do Laravel: `storage/logs/laravel.log`

## Comandos Úteis

```bash
# Ver logs do Laravel em tempo real
tail -f storage/logs/laravel.log

# Limpar cache do Laravel
php artisan cache:clear
php artisan config:clear

# Recriar link simbólico
php artisan storage:link --force
```

## Checklist de Teste

- [ ] Link simbólico criado
- [ ] Backend rodando
- [ ] Frontend rodando
- [ ] Login como admin funcionando
- [ ] Formulário de criação abre
- [ ] Campo de upload aparece
- [ ] Preview da imagem funciona
- [ ] Evento é salvo com sucesso
- [ ] Imagem aparece no dashboard
- [ ] Imagem aparece na lista de eventos
- [ ] Edição de evento funciona
- [ ] Nova imagem substitui a antiga
