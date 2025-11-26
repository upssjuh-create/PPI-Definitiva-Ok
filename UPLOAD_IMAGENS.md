# Configuração de Upload de Imagens

## Configuração do Backend (Laravel)

### 1. Criar o link simbólico do storage

Execute o comando no terminal:

```bash
php artisan storage:link
```

Este comando cria um link simbólico de `storage/app/public` para `public/storage`, permitindo que as imagens sejam acessíveis publicamente.

### 2. Verificar permissões

Certifique-se de que o diretório `storage` tem permissões de escrita:

```bash
# Linux/Mac
chmod -R 775 storage
chmod -R 775 bootstrap/cache

# Windows (executar como administrador)
icacls storage /grant Users:F /t
```

### 3. Estrutura de diretórios

O Laravel criará automaticamente a estrutura:
```
storage/
  app/
    public/
      events/          <- Imagens dos eventos serão salvas aqui
```

## Configuração do Frontend (React)

### 1. Variáveis de ambiente

Crie um arquivo `.env.local` na raiz do projeto frontend com:

```
VITE_API_URL=http://localhost:8000/api
```

### 2. Como funciona

1. O usuário seleciona uma imagem no formulário de evento
2. A imagem é enviada como `FormData` para a API
3. O Laravel salva a imagem em `storage/app/public/events/`
4. O caminho relativo é salvo no banco de dados
5. A imagem fica acessível em `http://localhost:8000/storage/events/nome-do-arquivo.jpg`

## Testando

1. Inicie o backend Laravel:
```bash
php artisan serve
```

2. Inicie o frontend:
```bash
npm run dev
```

3. Faça login como admin e crie um evento com uma imagem

## Troubleshooting

### Erro 404 ao acessar imagem

- Verifique se o link simbólico foi criado: `php artisan storage:link`
- Verifique se o arquivo existe em `storage/app/public/events/`

### Erro de permissão ao fazer upload

- Verifique as permissões do diretório storage
- No Windows, execute o terminal como administrador

### Imagem não aparece no preview

- Verifique o console do navegador para erros
- Verifique se a URL da API está correta no `.env.local`
