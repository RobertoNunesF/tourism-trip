# Tourism Trip — Painel Administrativo COINPEL

Sistema web administrativo para gerenciamento de viagens de turismo de uma
empresa fictícia (COINPEL): gerenciamento de viagens, veículos, motoristas
e usuários administradores, com autenticação e troca de senha obrigatória
no primeiro acesso.

Projeto desenvolvido como teste prático para a Companhia de Informática de
Pelotas.

## Tecnologias utilizadas

- **[Laravel 12](https://laravel.com/)** — framework PHP, em modo monolítico (Blade) + API REST no mesmo projeto
- **[PostgreSQL](https://www.postgresql.org/)** — banco de dados relacional
- **[Tailwind CSS](https://tailwindcss.com/)** — estilização das telas
- **[Laravel Breeze](https://laravel.com/docs/starter-kits)** — scaffolding de autenticação (login, registro, troca de senha)
- **[Alpine.js](https://alpinejs.dev/)** — interatividade leve no front-end (menu mobile, dropdowns)
- **[Blade Heroicons](https://github.com/blade-ui-kit/blade-heroicons)** — ícones usados na interface
- **[Vite](https://vitejs.dev/)** — bundler de assets (CSS/JS)

## Requisitos pra rodar o projeto

- PHP 8.3 ou superior
- Composer
- Node.js + npm
- PostgreSQL rodando localmente (ou acessível pela rede)

## Como executar

1. Clone o repositório e entre na pasta do projeto:

    ```bash
    git clone <url-do-repositorio>
    cd tourism-trip
    ```

2. Instale as dependências PHP e JS:

    ```bash
    composer install
    npm install
    ```

3. Copie o arquivo de variáveis de ambiente e gere a chave da aplicação:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. No `.env`, configure o acesso ao PostgreSQL (crie o banco antes, se ainda não existir):

    ```env
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=tourism_travel
    DB_USERNAME=<seu_usuario>
    DB_PASSWORD=<sua_senha>
    ```

5. Rode as migrations e os seeders (cria as tabelas e os usuários administradores iniciais):

    ```bash
    php artisan migrate --seed
    ```

6. Compile os assets do front-end:

    ```bash
    npm run build
    ```

    Durante o desenvolvimento, pode usar `npm run dev` em paralelo (recarrega automaticamente ao salvar).

7. Suba o servidor da aplicação:

    ```bash
    php artisan serve
    ```

8. Acesse `http://localhost:8000` no navegador.

## Acesso inicial

Após rodar o seeder, dois usuários administradores são criados:

| E-mail               | Senha      |
| -------------------- | ---------- |
| `adm@example.com`    | `password` |
| `gestor@example.com` | `password` |

No primeiro login, o sistema obriga a troca dessa senha antes de liberar o
acesso ao restante do sistema (RF06).

## Módulos disponíveis

- **Veículos** — cadastro, edição, exclusão e busca por placa/modelo
- **Motoristas** — cadastro, edição, exclusão e busca por nome/CNH/telefone
- **Viagens** — cadastro vinculando veículo e motorista, com validação de
  conflito de horário (um mesmo veículo ou motorista não pode estar em
  duas viagens no mesmo horário de saída)
- **Usuários** — gerenciamento dos administradores do sistema (um usuário
  não pode excluir a própria conta)

## API REST

O projeto expõe também uma API, no mesmo código-base da aplicação web:

```
GET /api/trips
```

Retorna a lista de viagens em JSON, já com os dados do veículo e do
motorista de cada viagem carregados.

## Funcionalidade extra

Além dos requisitos formais, foi implementado um log automático: toda vez
que um veículo, motorista ou viagem é criado, um registro também é
adicionado a um arquivo JSON compartilhado
(`storage/app/private/registros.json`), além do banco de dados — útil
como uma trilha simples de auditoria/exportação.

## Design

As telas seguem o design disponível no Figma do projeto, mantendo a
paleta de cores, tipografia e hierarquia de componentes apresentados.
