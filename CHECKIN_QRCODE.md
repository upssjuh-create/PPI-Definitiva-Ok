# Sistema de Check-in com QR Code

## Implementação Completa

Foi implementado um sistema completo de check-in que valida o QR Code do evento e registra a presença dos participantes.

## Funcionalidades

### ✅ Para Administradores
- Gerar QR Code único para cada evento
- Baixar PDF com QR Code para impressão
- Código de validação visível

### ✅ Para Participantes
- **Escanear QR Code** com a câmera do celular
- **Digitar código manualmente** (alternativa)
- Validação automática do código
- Verificação de inscrição no evento
- Registro de presença com data/hora

## Como Funciona

### 1. Administrador Gera QR Code
1. Acessa Dashboard Admin
2. Clica em "QR Code" no evento
3. Baixa o PDF
4. Imprime e coloca na entrada do evento

### 2. Participante Faz Check-in

#### Opção A: Escanear QR Code
1. Clica em "Check-in" no menu
2. Clica em "Iniciar Câmera"
3. Aponta para o QR Code
4. Check-in automático

#### Opção B: Código Manual
1. Clica em "Check-in" no menu
2. Seleciona "Código Manual"
3. Digite o código (ex: 1-A3F7B2C9)
4. Clica em "Fazer Check-in"

## Validações Implementadas

✅ **Código do Evento** - Valida se o código pertence ao evento
✅ **Inscrição** - Verifica se o participante está inscrito
✅ **Status** - Confirma se a inscrição está confirmada
✅ **Duplicação** - Impede check-in duplicado
✅ **Data/Hora** - Registra quando foi feito

## Estrutura Técnica

### Frontend

**Novo Componente: `CheckIn.tsx`**
- Scanner de QR Code usando `jsqr`
- Acesso à câmera do dispositivo
- Input manual de código
- Validação em tempo real

**Dependência Instalada:**
```json
{
  "jsqr": "^1.4.x"
}
```

### Backend

**Novo Método: `checkInWithCode()`**
```php
POST /api/events/{eventId}/check-in
Body: { "check_in_code": "1-A3F7B2C9" }
```

**Validações:**
1. Código corresponde ao evento
2. Usuário está inscrito
3. Inscrição está confirmada
4. Check-in não foi feito antes

**Resposta de Sucesso:**
```json
{
  "message": "Check-in realizado com sucesso",
  "registration": {...},
  "event": {...}
}
```

## Fluxo Completo

```
1. Admin cria evento
   ↓
2. Sistema gera código único (ex: A3F7B2C9)
   ↓
3. Admin gera QR Code
   ↓
4. QR Code contém: { eventId: 1, checkInCode: "1-A3F7B2C9" }
   ↓
5. Participante escaneia QR Code
   ↓
6. Sistema valida código com o evento
   ↓
7. Sistema verifica inscrição
   ↓
8. Check-in registrado com sucesso
```

## Formato do Código

**Formato:** `{eventId}-{codigo}`
**Exemplo:** `1-A3F7B2C9`

- `1` = ID do evento
- `A3F7B2C9` = Código único de 8 caracteres

## Mensagens de Erro

| Erro | Mensagem |
|------|----------|
| Código inválido | "Código de check-in inválido para este evento" |
| Não inscrito | "Você não está inscrito neste evento" |
| Já fez check-in | "Check-in já realizado anteriormente" |
| Inscrição pendente | "Sua inscrição não foi confirmada" |

## Instalação

### 1. Instalar Dependência

```bash
npm install jsqr
```

### 2. Fazer Commit e Push

```bash
git add .
git commit -m "Implementa sistema de check-in com validação de QR Code"
git push origin main
```

### 3. No Laravel Cloud

```bash
# Não precisa de migration nova, o campo check_in_code já existe
php artisan config:clear
php artisan cache:clear
```

## Teste

### Teste Local

1. Inicie os servidores:
```bash
php artisan serve
npm run dev
```

2. Crie um evento como admin

3. Gere o QR Code

4. Faça login como aluno

5. Clique em "Check-in"

6. Teste escanear ou digitar código

### Teste de Validação

**Código Correto:**
- Formato: `1-A3F7B2C9`
- Resultado: ✅ Check-in realizado

**Código Errado:**
- Formato: `1-INVALIDO`
- Resultado: ❌ "Código inválido"

**Não Inscrito:**
- Resultado: ❌ "Você não está inscrito"

**Já Fez Check-in:**
- Resultado: ❌ "Check-in já realizado"

## Segurança

✅ Código único por evento
✅ Validação no backend
✅ Verificação de inscrição
✅ Autenticação obrigatória
✅ Registro de data/hora
✅ Impossível fazer check-in duplicado

## Melhorias Futuras

- [ ] Notificação por email após check-in
- [ ] Estatísticas de presença em tempo real
- [ ] Exportar lista de presença
- [ ] Check-in por geolocalização
- [ ] Limite de horário para check-in
- [ ] QR Code com expiração

## Arquivos Criados/Modificados

### Frontend
- `src/components/CheckIn.tsx` (NOVO)
- `src/App.tsx`
- `src/components/EventDiscovery.tsx`
- `package.json`

### Backend
- `app/Http/Controllers/RegistrationController.php`
- `routes/api.php`

## Comandos Git

```bash
git add .
git commit -m "Implementa check-in com validação de QR Code

- Adiciona componente CheckIn com scanner
- Implementa validação de código no backend
- Adiciona botão Check-in no menu
- Valida inscrição e código do evento
- Registra presença com data/hora
- Impede check-in duplicado
- Instala dependência jsqr"

git push origin main
```

## Suporte

- **Documentação QR Code:** `QRCODE_CHECKIN.md`
- **Teste QR Code:** `TESTE_QRCODE.md`
- **Este arquivo:** `CHECKIN_QRCODE.md`
