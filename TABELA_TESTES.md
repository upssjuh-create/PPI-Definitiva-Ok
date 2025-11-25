# Tabela de Testes - Sistema de Eventos IFFar

## Funcionalidades Principais Testadas

| Nº | Cenário de Teste | Pré-condições | Resultado Esperado | Resultado Obtido | Evidência (ID/link) | Status |
|----|------------------|---------------|-------------------|------------------|---------------------|--------|
| 1 | **Cadastro de Usuário Aluno** | Acesso à página de login/cadastro | Usuário aluno cadastrado com matrícula, curso e semestre | Usuário criado com validação de campos acadêmicos, email único e senha criptografada | `resources/views/auth.blade.php` | ✅ |
| 2 | **Cadastro de Usuário Externo** | Acesso à página de login/cadastro | Usuário externo cadastrado com instituição | Usuário criado com campo instituição, sem campos acadêmicos obrigatórios | `resources/views/auth.blade.php` | ✅ |
| 3 | **Login de Usuário** | Usuário cadastrado no sistema | Autenticação bem-sucedida e redirecionamento para eventos | Token JWT gerado, sessão iniciada, redirecionamento para `/events` | `app/Http/Controllers/AuthController.php` | ✅ |
| 4 | **Listar Eventos Disponíveis** | Usuário autenticado | Exibir lista de eventos com filtros funcionais | Lista exibida com busca por nome, filtro por categoria e indicador de inscrição | `resources/views/events.blade.php` | ✅ |
| 5 | **Visualizar Detalhes do Evento** | Evento existente, usuário autenticado | Mostrar informações completas incluindo status de inscrição | Detalhes completos com palestrantes, tags, perguntas e card vermelho se já inscrito | `resources/views/event-details.blade.php` | ✅ |
| 6 | **Verificar Inscrição Existente** | Usuário já inscrito em evento | Card vermelho destacado informando inscrição existente | Card exibido com status, pagamento, código check-in e botão para comprovante | `resources/views/event-details.blade.php` (linha 415-470) | ✅ |
| 7 | **Inscrição em Evento Gratuito** | Evento gratuito com vagas, usuário autenticado | Inscrição confirmada imediatamente | Inscrição criada com status "confirmed", código de check-in gerado | `app/Http/Controllers/RegistrationController.php` | ✅ |
| 8 | **Inscrição em Evento Pago** | Evento pago com vagas, usuário autenticado | Inscrição criada com status "pending" | Inscrição criada, payment criado, redirecionamento para página de pagamento | `app/Http/Controllers/RegistrationController.php` | ✅ |
| 9 | **Pagamento via PIX** | Inscrição pendente, evento pago | QR Code PIX gerado e pagamento processado | QR Code gerado via Mercado Pago, webhook confirma pagamento automaticamente | `app/Http/Controllers/PixController.php` | ✅ |
| 10 | **Pagamento via Cartão** | Inscrição pendente, evento pago | Pagamento processado via cartão | Tokenização de cartão, processamento via Mercado Pago, confirmação instantânea | `app/Http/Controllers/CardController.php` | ✅ |
| 11 | **Webhook Mercado Pago** | Pagamento aprovado no Mercado Pago | Sistema atualiza status automaticamente | Webhook recebe notificação, atualiza payment para "paid", confirma inscrição | `app/Http/Controllers/PixController.php` (mercadoPagoWebhook) | ✅ |
| 12 | **Minhas Inscrições** | Usuário com inscrições | Listar todas as inscrições do usuário | Lista com status, pagamento, check-in, botão de cancelamento e comprovante | `resources/views/my-registrations.blade.php` | ✅ |
| 13 | **Check-in no Evento** | Inscrição confirmada, código válido | Check-in registrado com timestamp | Check-in realizado, `checked_in=true`, `check_in_time` salvo | `app/Http/Controllers/RegistrationController.php` | ✅ |
| 14 | **Gerar Certificado** | Check-in realizado | Certificado PDF gerado com código único | Certificado criado com assinaturas em base64, código de validação único | `app/Http/Controllers/CertificateController.php` | ✅ |
| 15 | **Assinaturas no Certificado** | Evento com assinaturas configuradas | Assinaturas aparecem no PDF | Imagens convertidas para base64, exibidas corretamente no certificado | `resources/views/certificate-pdf.blade.php` (linha 230-280) | ✅ |
| 16 | **Validar Certificado** | Certificado emitido | Validação por código retorna dados | Verificação de autenticidade, contador de validações incrementado | `resources/views/validate-certificate.blade.php` | ✅ |
| 17 | **Perguntas sobre Evento** | Usuário autenticado, evento existente | Pergunta enviada e exibida | Pergunta salva, admin pode responder, autor pode editar/excluir | `app/Http/Controllers/QuestionController.php` | ✅ |
| 18 | **Atualizar Perfil** | Usuário autenticado | Dados atualizados com sucesso | Dados salvos incluindo curso, semestre, instituição (externos) | `resources/views/profile.blade.php` | ✅ |
| 19 | **Admin - Dashboard** | Admin autenticado | Estatísticas exibidas corretamente | Total de eventos, inscrições, receita e eventos recentes | `resources/views/admin/dashboard.blade.php` | ✅ |
| 20 | **Admin - Criar Evento** | Admin autenticado | Evento criado com todas as informações | Evento salvo com palestrantes, tags, preço, capacidade e certificado | `resources/views/admin/create-event.blade.php` | ✅ |
| 21 | **Admin - Editar Evento** | Admin autenticado, evento existente | Evento atualizado | Dados atualizados, validação de data passada impede edição | `resources/views/admin/edit-event.blade.php` | ✅ |
| 22 | **Admin - Visualizar Inscritos** | Admin autenticado, evento com inscritos | Lista de participantes com filtros | Lista completa com filtros por nome, curso, semestre | `resources/views/admin/view-event.blade.php` | ✅ |
| 23 | **Admin - Destaque Usuários Externos** | Usuário externo inscrito em evento | Identificação visual de externos | Badge "EXTERNO" azul, fundo destacado, exibição da instituição | `resources/views/admin/view-event.blade.php` (linha 510-530) | ✅ |
| 24 | **Admin - Gerenciar Assinaturas** | Admin autenticado | CRUD de assinaturas funcional | Criar, editar, excluir assinaturas com upload de imagem | `resources/views/admin/signatures.blade.php` | ✅ |
| 25 | **Admin - Navegação Unificada** | Admin em qualquer página do painel | Todas as 5 abas visíveis | Navegação consistente: Visão Geral, Eventos, Cancelamentos, Validar, Assinaturas | `resources/views/admin/partials/nav.blade.php` | ✅ |

---

## Dados de Teste Disponíveis

### 👤 Usuários de Teste

| Tipo | Email | Senha | Observações |
|------|-------|-------|-------------|
| **Admin** | admin@iffar.edu.br | admin123 | Acesso total ao painel administrativo |
| **Aluno IFFar** | juliasoaresportela@gmail.com | teste1234 | Usuário com matrícula e curso |
| **Externo** | julia.portela.testes@gmail.com | teste123 | Usuário externo com instituição |

### 💳 Cartão de Teste (Mercado Pago)

| Campo | Valor | Observações |
|-------|-------|-------------|
| **Número** | 5031 4332 1540 6351 | Cartão de teste aprovado |
| **Nome** | APRO | Nome do titular |
| **Validade** | 11/30 | Mês/Ano |
| **CVV** | 123 | Código de segurança |
| **Tipo** | Crédito ou Débito | Ambos funcionam |

> **Nota**: Estes dados estão configurados pela API do Mercado Pago para ambiente de testes e sempre aprovam o pagamento.

---

## Fluxos de Teste Principais

### 🔄 Fluxo 1: Inscrição em Evento Gratuito
```
1. Login → 2. Listar Eventos → 3. Visualizar Detalhes → 4. Inscrever-se → 
5. Confirmar Dados → 6. Aceitar Termos → 7. Inscrição Confirmada ✅
```

### 🔄 Fluxo 2: Inscrição em Evento Pago (PIX)
```
1. Login → 2. Visualizar Evento → 3. Inscrever-se → 4. Confirmar Dados → 
5. Escolher PIX → 6. Gerar QR Code → 7. Pagar (simulado) → 
8. Webhook Confirma → 9. Inscrição Confirmada ✅
```

### 🔄 Fluxo 3: Inscrição em Evento Pago (Cartão)
```
1. Login → 2. Visualizar Evento → 3. Inscrever-se → 4. Confirmar Dados → 
5. Escolher Cartão → 6. Preencher Dados (usar dados de teste) → 
7. Processar Pagamento → 8. Inscrição Confirmada ✅
```

### 🔄 Fluxo 4: Gerar Certificado
```
1. Participar do Evento → 2. Fazer Check-in (código) → 
3. Acessar "Minhas Inscrições" → 4. Gerar Certificado → 
5. Download PDF → 6. Validar Certificado (código único) ✅
```

### 🔄 Fluxo 5: Admin - Criar Evento Completo
```
1. Login Admin → 2. Dashboard → 3. Criar Evento → 4. Preencher Dados → 
5. Adicionar Palestrantes/Tags → 6. Configurar Certificado → 
7. Selecionar Assinaturas → 8. Salvar → 9. Evento Publicado ✅
```

---

## Tecnologias Utilizadas

| Tecnologia | Versão | Finalidade |
|------------|--------|------------|
| **Laravel** | 11.x | Framework PHP backend |
| **MySQL** | 8.x | Banco de dados relacional |
| **Laravel Sanctum** | 4.x | Autenticação API (JWT tokens) |
| **Mercado Pago SDK** | 3.x | Processamento de pagamentos PIX e Cartão |
| **DomPDF** | 2.x | Geração de certificados em PDF |
| **Tailwind CSS** | 3.x | Framework CSS para estilização |
| **JavaScript** | ES6+ | Interatividade no frontend |

---

## Segurança Implementada

| Recurso | Implementação | Status |
|---------|---------------|--------|
| **Autenticação** | Laravel Sanctum (JWT tokens) | ✅ |
| **Senhas** | Hash bcrypt | ✅ |
| **CSRF Protection** | Token Laravel em formulários | ✅ |
| **Validação de Dados** | Request validation em todos os endpoints | ✅ |
| **Autorização** | Middleware `auth:sanctum` e `admin` | ✅ |
| **SQL Injection** | Eloquent ORM (prepared statements) | ✅ |
| **XSS Protection** | Blade templates (auto-escape) | ✅ |

---

## Observações Importantes

1. ✅ **Dados de Teste Visíveis**: Usuários e cartão de teste aparecem nas páginas de login e pagamento
2. ✅ **Pagamentos**: Sistema integrado com Mercado Pago (ambiente de testes)
3. ✅ **Certificados**: Gerados apenas após check-in no evento
4. ✅ **Assinaturas**: Devem ser cadastradas antes de criar eventos
5. ✅ **Usuários Externos**: Identificados visualmente com badge azul para o admin
6. ✅ **Validação de Certificados**: Pública, não requer autenticação
7. ✅ **Navegação Admin**: Todas as 5 abas aparecem em todas as páginas do painel

---

## Status Geral do Sistema

### ✅ **Sistema 100% Funcional**

Todas as funcionalidades principais foram implementadas, testadas e estão operacionais.

---

**Data da Última Atualização**: 24 de Novembro de 2025  
**Desenvolvido para**: Instituto Federal Farroupilha (IFFar)  
**Ambiente**: Produção/Testes
