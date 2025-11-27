# Instalação Rápida - QR Code de Check-in

## Comandos para Executar

### 1. Instalar Dependências do Frontend

```bash
npm install
```

Isso instalará automaticamente:
- qrcode
- jspdf
- html2canvas

### 2. Executar Migration do Backend

```bash
php artisan migrate
```

Isso criará a coluna `check_in_code` na tabela `events`.

### 3. Iniciar os Servidores

**Terminal 1 - Backend:**
```bash
php artisan serve
```

**Terminal 2 - Frontend:**
```bash
npm run dev
```

## Pronto!

O sistema está instalado e funcionando. Agora você pode:

1. Fazer login como administrador
2. Ir para o Dashboard Admin
3. Clicar no botão verde "QR Code" em qualquer evento
4. Baixar o PDF com o QR Code

## Verificar Instalação

### Verificar se as dependências foram instaladas:

```bash
npm list qrcode jspdf html2canvas
```

**Resultado esperado:**
```
├── qrcode@1.x.x
├── jspdf@2.x.x
└── html2canvas@1.x.x
```

### Verificar se a migration foi executada:

```bash
php artisan tinker
```

Depois execute:
```php
Schema::hasColumn('events', 'check_in_code')
```

**Resultado esperado:** `true`

## Troubleshooting

### Se o npm install falhar:

```bash
# Limpar cache
npm cache clean --force

# Tentar novamente
npm install
```

### Se a migration falhar:

```bash
# Verificar status
php artisan migrate:status

# Tentar novamente
php artisan migrate --force
```

### Se o PowerShell bloquear npm:

Use o CMD ao invés:
```bash
cmd /c "npm install"
```

Ou execute como administrador e rode:
```powershell
Set-ExecutionPolicy -ExecutionPolicy RemoteSigned -Scope CurrentUser
```

## Teste Rápido

Após a instalação, teste:

1. Acesse: `http://localhost:5173`
2. Login como admin
3. Vá para Dashboard Admin
4. Veja se o botão "QR Code" aparece nos eventos
5. Clique e veja se o QR Code é exibido
6. Clique em "Baixar PDF" e veja se o arquivo é baixado

## Arquivos Importantes

- `src/components/EventQRCode.tsx` - Componente do QR Code
- `database/migrations/2025_11_27_000001_add_check_in_code_to_events_table.php` - Migration
- `QRCODE_CHECKIN.md` - Documentação completa
- `TESTE_QRCODE.md` - Guia de testes

## Suporte

Se tiver problemas, consulte:
- `QRCODE_CHECKIN.md` - Documentação completa
- `TESTE_QRCODE.md` - Guia de testes e troubleshooting
- `RESUMO_QRCODE.md` - Resumo das funcionalidades
