# Sistema de QR Code para Check-in de Eventos

## Visão Geral

Foi implementado um sistema completo de geração de QR Code para check-in de eventos, permitindo que administradores gerem códigos únicos para cada evento e os salvem em PDF.

## Funcionalidades Implementadas

### 1. Geração Automática de Código
- Ao criar um evento, um código único de check-in é gerado automaticamente
- Formato: 8 caracteres alfanuméricos (ex: `A3F7B2C9`)
- O código é único e não se repete entre eventos

### 2. Página de QR Code
- Exibe o QR Code do evento
- Mostra o código de validação em formato legível
- Apresenta informações do evento (título, data, horário, local)
- Instruções de uso

### 3. Download em PDF
- Gera um PDF profissional com:
  - Título e informações do evento
  - QR Code centralizado
  - Código de validação em destaque
  - Instruções de uso
  - Rodapé institucional

### 4. Botão no Dashboard Admin
- Novo botão "QR Code" em cada evento
- Ícone de QR Code para fácil identificação
- Cor verde para destacar a funcionalidade

## Como Usar

### Para Administradores

1. **Acessar o Dashboard Admin**
   - Faça login como administrador
   - Clique em "Admin" no menu

2. **Gerar QR Code**
   - Localize o evento desejado
   - Clique no botão verde "QR Code"
   - Visualize o QR Code gerado

3. **Baixar PDF**
   - Na página do QR Code, clique em "Baixar PDF"
   - O arquivo será salvo automaticamente
   - Nome do arquivo: `qrcode-checkin-[nome-do-evento].pdf`

4. **Imprimir e Usar**
   - Imprima o PDF
   - Coloque na entrada do evento
   - Participantes podem escanear para fazer check-in

### Para Participantes

1. **Escanear QR Code**
   - Use um aplicativo de leitura de QR Code
   - Aponte para o código impresso
   - O sistema registrará o check-in automaticamente

2. **Código Manual (alternativa)**
   - Se não puder escanear, informe o código ao organizador
   - O código está impresso abaixo do QR Code
   - Formato: 8 caracteres (ex: `A3F7B2C9`)

## Estrutura Técnica

### Frontend

**Novo Componente: `EventQRCode.tsx`**
- Gera QR Code usando a biblioteca `qrcode`
- Cria PDF usando `jspdf`
- Interface responsiva e intuitiva

**Dependências Instaladas:**
```json
{
  "qrcode": "^1.5.x",
  "jspdf": "^2.5.x",
  "html2canvas": "^1.4.x"
}
```

### Backend

**Modelo Event Atualizado:**
- Novo campo: `check_in_code` (string, único)
- Gerado automaticamente ao criar evento

**Migration:**
- Arquivo: `2025_11_27_000001_add_check_in_code_to_events_table.php`
- Adiciona coluna `check_in_code` na tabela `events`

**Controller:**
- Método `generateCheckInCode()` no `EventController`
- Garante unicidade do código

## Instalação e Configuração

### 1. Instalar Dependências

```bash
npm install qrcode jspdf html2canvas
```

### 2. Executar Migration

```bash
php artisan migrate
```

### 3. Testar

1. Inicie o backend: `php artisan serve`
2. Inicie o frontend: `npm run dev`
3. Faça login como admin
4. Crie ou visualize um evento
5. Clique em "QR Code"
6. Baixe o PDF

## Formato do QR Code

O QR Code contém um JSON com as seguintes informações:

```json
{
  "eventId": 123,
  "eventTitle": "Nome do Evento",
  "checkInCode": "A3F7B2C9",
  "type": "check-in"
}
```

## Layout do PDF

```
┌─────────────────────────────────────┐
│   QR Code de Check-in               │
│                                     │
│   Nome do Evento                    │
│   Data: 26/11/2025 • 12:00         │
│   Local: Auditório                  │
│                                     │
│   ┌─────────────────┐              │
│   │                 │              │
│   │   [QR CODE]     │              │
│   │                 │              │
│   └─────────────────┘              │
│                                     │
│   Código de Validação:              │
│   ┌─────────────────┐              │
│   │   A3F7B2C9      │              │
│   └─────────────────┘              │
│                                     │
│   Instruções de uso...              │
│                                     │
│   Sistema de Eventos - IFFar        │
└─────────────────────────────────────┘
```

## Segurança

- Código único por evento
- Validação no backend
- Não é possível reutilizar códigos
- Registro de data/hora do check-in

## Próximas Melhorias (Sugestões)

- [ ] Implementar leitor de QR Code no sistema
- [ ] Registrar histórico de check-ins
- [ ] Notificação ao participante após check-in
- [ ] Estatísticas de presença em tempo real
- [ ] Exportar lista de presença
- [ ] Validação por geolocalização

## Troubleshooting

### QR Code não aparece
- Verifique se as dependências foram instaladas
- Limpe o cache do navegador
- Verifique o console para erros

### PDF não baixa
- Verifique permissões do navegador
- Tente em outro navegador
- Verifique se há bloqueadores de pop-up

### Código não é único
- Execute a migration novamente
- Verifique o banco de dados
- Limpe o cache do Laravel

## Arquivos Modificados

### Frontend
- `src/components/EventQRCode.tsx` (NOVO)
- `src/App.tsx`
- `src/components/AdminDashboard.tsx`
- `package.json`

### Backend
- `app/Models/Event.php`
- `app/Http/Controllers/EventController.php`
- `database/migrations/2025_11_27_000001_add_check_in_code_to_events_table.php` (NOVO)

## Comandos Úteis

```bash
# Instalar dependências frontend
npm install

# Executar migration
php artisan migrate

# Reverter migration (se necessário)
php artisan migrate:rollback

# Ver eventos com códigos
php artisan tinker
>>> Event::select('id', 'title', 'check_in_code')->get();
```
