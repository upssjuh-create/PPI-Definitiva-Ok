# Instruções para Deploy no Laravel Cloud

## Problemas Identificados

1. ✅ **Conflitos de merge no arquivo auth.blade.php** - RESOLVIDO
2. ✅ **Tailwind CDN em produção** - RESOLVIDO (agora usa Vite)
3. ⚠️ **Assets não compilados** - PRECISA COMPILAR

## Passos para Corrigir

### 1. Compilar os Assets para Produção

Execute no terminal local:

```bash
npm install
npm run build
```

Isso vai criar a pasta `public/build` com os assets compilados do Tailwind.

### 2. Fazer Commit das Mudanças

```bash
git add .
git commit -m "Fix: Resolve conflitos de merge e configura Tailwind para produção"
git push origin main
```

### 3. Configurar Variáveis de Ambiente no Laravel Cloud

No painel do Laravel Cloud, configure:

```
APP_ENV=production
APP_DEBUG=false
APP_URL=https://ppi-definitiva-ok-main-l8p2ja.laravel.cloud
```

### 4. Verificar Build no Laravel Cloud

O Laravel Cloud deve automaticamente:
- Instalar dependências: `composer install --no-dev`
- Compilar assets: `npm install && npm run build`
- Executar migrations: `php artisan migrate --force`

### 5. Limpar Cache (se necessário)

Se ainda houver problemas, execute no Laravel Cloud:

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

## O que foi Corrigido

### auth.blade.php
- ✅ Removidos conflitos de merge (`<<<<<<< HEAD`, `=======`, `>>>>>>>`)
- ✅ Código JavaScript completo e funcional
- ✅ Função `toggleMode()` definida corretamente
- ✅ Função `handleUserTypeChange()` definida corretamente
- ✅ Função `handleLogin()` completa
- ✅ Função `handleRegister()` completa
- ✅ Substituído CDN do Tailwind por `@vite` directive

### resources/css/app.css
- ✅ Adicionada cor personalizada `--color-iffar-green: #1a5f3f`

## Testando Localmente

Antes de fazer push, teste localmente:

```bash
# Terminal 1 - Servidor Laravel
php artisan serve

# Terminal 2 - Vite dev server
npm run dev
```

Acesse: http://localhost:8000/login

## Notas Importantes

- O Laravel Cloud compila automaticamente os assets durante o deploy
- Certifique-se de que `package.json` e `vite.config.js` estão commitados
- O arquivo `.env` no servidor deve ter `APP_ENV=production`
