# Guia Rápido - Teste do QR Code de Check-in

## Passo a Passo para Testar

### 1. Preparar o Ambiente

```bash
# Terminal 1 - Backend
php artisan migrate
php artisan serve
```

```bash
# Terminal 2 - Frontend
npm install
npm run dev
```

### 2. Testar a Funcionalidade

#### A. Criar um Novo Evento

1. Abra o navegador em `http://localhost:5173`
2. Faça login como administrador
3. Clique em "Admin" → "Criar Evento"
4. Preencha todos os campos:
   - Título: "Workshop de Tecnologia"
   - Descrição: "Evento teste para QR Code"
   - Data: "2025-12-15"
   - Horário: "14:00"
   - Local: "Auditório Principal"
   - Categoria: "Workshop"
   - Organizador: "Departamento de TI"
   - Capacidade: 50
   - Preço: 0
   - Imagem: (selecione uma imagem)
5. Clique em "Salvar"
6. **Resultado esperado:** Evento criado com código de check-in gerado automaticamente

#### B. Gerar QR Code

1. No Dashboard Admin, localize o evento criado
2. Clique no botão verde "QR Code" (com ícone de QR)
3. **Resultado esperado:** 
   - Página com QR Code exibido
   - Código de validação visível (8 caracteres)
   - Informações do evento

#### C. Baixar PDF

1. Na página do QR Code, clique em "Baixar PDF"
2. **Resultado esperado:**
   - PDF baixado automaticamente
   - Nome: `qrcode-checkin-workshop-de-tecnologia.pdf`
   - Arquivo contém QR Code e código de validação

#### D. Verificar PDF

1. Abra o PDF baixado
2. **Verifique:**
   - ✅ Título "QR Code de Check-in"
   - ✅ Nome do evento
   - ✅ Data, horário e local
   - ✅ QR Code centralizado
   - ✅ Código de validação legível
   - ✅ Instruções de uso
   - ✅ Rodapé institucional

### 3. Testar com Evento Existente

1. No Dashboard Admin, escolha um evento já existente
2. Clique em "QR Code"
3. **Resultado esperado:**
   - Se o evento foi criado antes da atualização, um código será gerado na hora
   - Se foi criado depois, usará o código já existente

### 4. Verificar no Banco de Dados

```bash
# Abrir tinker
php artisan tinker

# Ver códigos gerados
Event::select('id', 'title', 'check_in_code')->get();

# Ver um evento específico
Event::find(1)->check_in_code;
```

## Checklist de Teste

### Funcionalidades Básicas
- [ ] Botão "QR Code" aparece no dashboard admin
- [ ] Botão tem ícone de QR Code
- [ ] Botão tem cor verde
- [ ] Clique no botão abre página de QR Code

### Página de QR Code
- [ ] QR Code é exibido corretamente
- [ ] Código de validação é exibido (8 caracteres)
- [ ] Informações do evento estão corretas
- [ ] Instruções são exibidas
- [ ] Botão "Voltar" funciona
- [ ] Botão "Sair" funciona

### Download de PDF
- [ ] Botão "Baixar PDF" está visível
- [ ] Clique baixa o arquivo
- [ ] Nome do arquivo está correto
- [ ] PDF abre sem erros
- [ ] Conteúdo do PDF está completo
- [ ] QR Code no PDF está legível
- [ ] Código de validação está legível

### Backend
- [ ] Migration executada com sucesso
- [ ] Campo `check_in_code` existe na tabela
- [ ] Código é gerado ao criar evento
- [ ] Código é único (não se repete)
- [ ] Código tem 8 caracteres

### Integração
- [ ] Eventos novos recebem código automaticamente
- [ ] Eventos antigos podem gerar código
- [ ] Código persiste no banco de dados
- [ ] Código não muda ao editar evento

## Possíveis Problemas e Soluções

### Problema: Botão "QR Code" não aparece

**Solução:**
1. Verifique se o frontend foi atualizado
2. Limpe o cache do navegador (Ctrl+Shift+R)
3. Reinicie o servidor de desenvolvimento

### Problema: QR Code não é exibido

**Solução:**
1. Verifique se as dependências foram instaladas:
   ```bash
   npm install qrcode jspdf html2canvas
   ```
2. Verifique o console do navegador (F12)
3. Reinicie o servidor frontend

### Problema: PDF não baixa

**Solução:**
1. Verifique permissões do navegador
2. Desabilite bloqueadores de pop-up
3. Tente em outro navegador
4. Verifique o console para erros

### Problema: Erro na migration

**Solução:**
```bash
# Reverter e executar novamente
php artisan migrate:rollback
php artisan migrate

# Ou forçar
php artisan migrate:fresh
```

### Problema: Código não é gerado

**Solução:**
1. Verifique se a migration foi executada
2. Verifique o EventController
3. Limpe o cache:
   ```bash
   php artisan cache:clear
   php artisan config:clear
   ```

## Teste de Escaneamento

### Usando Smartphone

1. Baixe um app de leitura de QR Code
   - Android: Google Lens, QR Code Reader
   - iOS: Câmera nativa

2. Abra o PDF no computador ou imprima

3. Escaneie o QR Code com o smartphone

4. **Resultado esperado:**
   - App lê o código
   - Mostra dados JSON do evento
   - Contém: eventId, eventTitle, checkInCode, type

### Dados do QR Code

O QR Code contém um JSON:
```json
{
  "eventId": 1,
  "eventTitle": "Workshop de Tecnologia",
  "checkInCode": "A3F7B2C9",
  "type": "check-in"
}
```

## Comandos de Debug

```bash
# Ver logs do Laravel
tail -f storage/logs/laravel.log

# Ver eventos no banco
php artisan tinker
>>> Event::all();

# Ver último evento criado
>>> Event::latest()->first();

# Ver código de um evento específico
>>> Event::find(1)->check_in_code;

# Gerar código manualmente (se necessário)
>>> $event = Event::find(1);
>>> $event->check_in_code = strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));
>>> $event->save();
```

## Teste de Impressão

1. Baixe o PDF
2. Abra no Adobe Reader ou navegador
3. Imprima em papel A4
4. Verifique:
   - QR Code está nítido
   - Código é legível
   - Texto não está cortado
   - Margens estão corretas

## Próximos Passos

Após confirmar que tudo funciona:

1. Teste com eventos reais
2. Imprima e coloque na entrada de um evento
3. Teste o escaneamento com participantes
4. Colete feedback
5. Ajuste conforme necessário

## Suporte

Se encontrar problemas:

1. Verifique os logs: `storage/logs/laravel.log`
2. Verifique o console do navegador (F12)
3. Verifique se todas as dependências estão instaladas
4. Revise a documentação em `QRCODE_CHECKIN.md`
