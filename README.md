# HubMenu

O **HubMenu** é um sistema de gerenciamento de restaurantes, refeitórios e estabelecimentos gastronômicos, desenvolvido em PHP puro com arquitetura MVC. Permite o controle de cardápios digitais, pedidos, avaliações, gestão de usuários e estabelecimentos, tanto para consumo local (via tablets/QR Code) quanto para delivery.

## Tecnologias Utilizadas

- **PHP 8.1+** (backend, MVC puro)
- **MySQL 8.0 / MariaDB** (banco de dados relacional)
- **HTML5, CSS3, JavaScript** (frontend)
- **Bootstrap 5** (framework CSS responsivo)
- **Font Awesome & Bootstrap Icons** (ícones)
- **AJAX** (carregamento dinâmico de dados)
- **Arquitetura MVC** (Models, Views, Controllers)
- **Sistema de rotas customizado** (App/Router/Routes.php)
- **Componentização de layouts** (Views/Components/)
- **Responsividade mobile-first**
- **Docker / Docker Compose** (ambiente de desenvolvimento)
- **Composer** (gerenciamento de dependências PHP)
- **PHPMailer** (envio de e-mails)
- **FPDF** (geração de relatórios PDF)

---

## Estrutura do Projeto

```
HubMenu-PhpPuro/
├── App/
│   ├── Assets/              # CSS, JS, imagens, fontes
│   ├── Controllers/         # Lógica de controle (MVC)
│   │   ├── Administracao/   # Controllers administrativos
│   │   ├── Cadastros/       # Controllers de cadastros
│   │   ├── Clientes/        # Controllers área do cliente
│   │   └── Empresarial/     # Controllers área empresarial
│   ├── Core/                # Núcleo do sistema (Core.php, RenderView.php)
│   ├── Models/              # Modelos de dados (PHP + PDO)
│   ├── Router/              # Rotas do sistema (Routes.php)
│   ├── Views/               # Telas e componentes visuais
│   │   ├── Administracao/
│   │   ├── Clientes/
│   │   ├── Components/      # Componentes reutilizáveis
│   │   └── Empresarial/
│   ├── Modelagem/           # Scripts SQL e documentação do banco
│   │   ├── HubMenuBackup.sql
│   │   └── Prototipação HubMenu.pdf
│   ├── Tests/               # Testes automatizados (Python/Selenium)
│   ├── index.php            # Bootstrap do app (entry point)
│   ├── global.php           # Configurações globais (DB, env, URLs)
│   ├── autoload.php         # Autoloader PSR-4
│   ├── .htaccess            # Configuração Apache
│   └── web.config           # Configuração IIS
├── vendor/                  # Dependências Composer
├── composer.json            # Dependências PHP
├── composer.lock
├── Dockerfile               # Imagem Docker PHP + Apache
├── docker-compose.yml       # Orquestração (web + db)
├── .gitignore
├── .gitattributes
└── README.md
```

---

## Como Executar

### Opção 1: Docker (Recomendado)

Pré-requisitos: **Docker** e **Docker Compose** instalados.

```bash
# 1. Clone o repositório
git clone <url-do-repositorio>
cd HubMenu-PhpPuro

# 2. Suba os containers (web + banco de dados)
docker-compose up -d --build

# 3. Aguarde o healthcheck do banco passar (~30-60s) e acesse:
# http://localhost:8080
```

**O que o Docker faz:**
- Sobe container `hubmenu_web` (PHP 8.2 + Apache) na porta **8080**
- Sobe container `hubmenu_db` (MySQL 8.0) na porta **3307** (host) / **3306** (container)
- Cria banco `hubmenu`, usuário `hubmenu_user` e aplica o schema via `App/Modelagem/HubMenuBackup.sql` (precisa importar manualmente na primeira vez — veja seção Banco de Dados)
- Monta o código local em `/var/www/html` (hot reload ativo)

**Parar containers:**
```bash
docker-compose down
```

**Parar e remover volumes (apaga dados do banco):**
```bash
docker-compose down -v
```

**Logs:**
```bash
docker-compose logs -f web
docker-compose logs -f db
```

---

### Opção 2: Servidor PHP Built-in (Desenvolvimento Local)

Pré-requisitos: **PHP 8.1+**, **Composer**, **MySQL/MariaDB** rodando localmente.

```bash
# 1. Clone o repositório
git clone <url-do-repositorio>
cd HubMenu-PhpPuro

# 2. Instale dependências PHP
composer install

# 3. Configure o banco de dados (veja seção "Banco de Dados" abaixo)

# 4. Ajuste App/global.php se necessário (DB_HOST=localhost, DB_PORT=3306, etc.)

# 5. Inicie o servidor PHP na pasta App/
cd App
php -S localhost:8080

# 6. Acesse http://localhost:8080
```

> **Nota:** O `global.php` padrão usa `DB_HOST=db` (nome do container Docker). Para rodar localmente sem Docker, altere para `DB_HOST=localhost` e `DB_PORT=3306` (ou sua porta MySQL).

---

### Opção 3: XAMPP / WAMP / MAMP / Laragon

1. Copie a pasta `App/` para `htdocs/` (XAMPP) ou `www/` (WAMP/Laragon)
2. Inicie Apache e MySQL no painel de controle
3. Importe o banco de dados (veja seção abaixo)
4. Ajuste `App/global.php` com credenciais locais do MySQL
5. Acesse `http://localhost/HubMenu-PhpPuro/App` (ou configure VirtualHost)

---

## Banco de Dados

### Credenciais Padrão (Docker)

| Parâmetro      | Valor                        |
|----------------|------------------------------|
| Host           | `db` (container) / `localhost` (host) |
| Porta          | `3306` (container) / `3307` (host)    |
| Banco          | `hubmenu`                    |
| Usuário        | `hubmenu_user`               |
| Senha          | `FOnoenp3o5623ionhono36`     |
| Root password  | `root`                       |

### Importar Schema (Primeira vez)

O arquivo SQL está em: `App/Modelagem/HubMenuBackup.sql`

**Via Docker (recomendado):**
```bash
# Com containers rodando:
docker exec -i hubmenu_db mysql -u hubmenu_user -pFOnoenp3o5623ionhono36 hubmenu < App/Modelagem/HubMenuBackup.sql
```

**Via MySQL CLI local:**
```bash
mysql -u root -p hubmenu < App/Modelagem/HubMenuBackup.sql
```

**Via phpMyAdmin / DBeaver / Workbench:**
- Crie o banco `hubmenu`
- Importe o arquivo `.sql`

> O schema cria todas as tabelas (`categorias`, `produtos`, `pedidos`, `usuarios`, `estabelecimentos`, `avaliacoes`, `cargos`, etc.) e insere dados de seed (cargos, categorias, usuários de teste).

---

## Configuração (App/global.php)

Edite `App/global.php` para ajustar credenciais e URLs:

```php
define('DB_HOST',     'db');        // 'localhost' se não usar Docker
define('DB_PORT',     '3306');
define('DB_USER',     'hubmenu_user');
define('DB_PASSWORD', 'FOnoenp3o5623ionhono36');
define('DB_DRIVER',   'mysql');
define('DB_NAME',     'hubmenu');

// PHPMailer (configure para envio real de e-mails)
define('PHPMAILER_USERNAME', 'seu@email.com');
define('PHPMAILER_PASSWORD', 'sua_senha_app');

// IAgente SMS (configure se usar SMS)
define('IAgente_USER', 'seu@email.com');
define('IAgente_PASS', 'sua_senha');

$Title   = "HubMenu |";
$Website = "http://localhost:8080";  // ajuste se usar porta/VH diferente
```

---

## Dependências PHP (Composer)

```json
{
  "require": {
    "phpmailer/phpmailer": "^6.10",
    "setasign/fpdf": "^1.8"
  }
}
```

Instale/atualize com:
```bash
composer install
# ou
composer update
```

O autoload PSR-4 está configurado para namespace `App\\` mapeando para pasta `App/`.

---

## Rotas Principais (App/Router/Routes.php)

| Rota | Controller / Ação | Descrição |
|------|-------------------|-----------|
| `/` | `DashClienteController@index` | Dashboard do cliente |
| `/restaurantes` | `RestaurantesController@index` | Listagem de restaurantes |
| `/restaurante/{id}` | `RestaurantesController@indexRestaurante` | Detalhe do restaurante |
| `/empresarial` | `HomeController@index` | Landing empresarial |
| `/empresarial/login` | `LoginController@index` | Login empresa |
| `/empresarial/cadastro` | `CadastroController@index` | Cadastro empresa |
| `/empresarial/dashboard/{id}` | `DashboardController@index` | Dashboard empresa |
| `/cardapio/{id}` | `CardapioController@indexCliente` | Cardápio cliente |
| `/gerenciar/cardapio/{id}` | `CardapioController@indexAdmin` | Gestão cardápio |
| `/admin` | `AdminController@index` | Painel admin |
| `/api/autenticar/usuario` | `LoginController@autenticar` | API login usuário |
| `/api/cadastrar/usuario` | `CadastroController@cadastrar` | API cadastro usuário |
| `/api/produtos/cadastrar` | `ProdutosController@cadastrar` | API cadastro produto |
| `/api/pedidos/register` | `PedidosController@registerOrder` | API registrar pedido |

---

## Usuários de Teste (Seed do Banco)

Após importar o `HubMenuBackup.sql`, existem usuários de exemplo:

| Perfil | Email | Senha | Observação |
|--------|-------|-------|------------|
| Admin | `admin@hubmenu.com` | `123456` | Acesso `/admin` |
| Empresa | `empresa@teste.com` | `123456` | Acesso `/empresarial` |
| Cliente | `cliente@teste.com` | `123456` | Acesso `/` |

> **⚠️ Segurança:** Altere as senhas padrão em produção. O hash usado é `password_hash()` (bcrypt).

---

## Funcionalidades Principais

- **Gestão de Estabelecimentos**: Cadastro, edição, exclusão lógica (lixeira), categorias
- **Cardápio Digital**: Produtos com imagens, preços, categorias, ativação/desativação
- **Pedidos**: Salão (QR Code/tablet) e delivery, status de preparo, histórico
- **Avaliações**: Notas e comentários de clientes, média por estabelecimento
- **Usuários & Permissões**: Cargos (Admin, Gerente, Atendente, Cozinheiro, Entregador, etc.)
- **Painel Administrativo**: Logs, relatórios PDF (FPDF), gestão global
- **Autenticação**: Login, recuperação de senha (e-mail/SMS via IAgente), sessões
- **API RESTful**: Endpoints JSON para integração frontend/mobile
- **Responsivo**: Mobile-first, Bootstrap 5, componentes reutilizáveis

---

## Testes Automatizados

Local: `App/Tests/`

- `test.py`, `registerStoreTest.py`, `registerLoginTest.py`, `registerProductsTest.py`, `registerUserTest.py`, `registerCategoryTest.py`
- Requerem **Python**, **Selenium**, **ChromeDriver** (incluso em `App/Tests/webdriver/`)
- Executam testes de UI (cadastro, login, produtos, categorias)

```bash
cd App/Tests
python registerLoginTest.py
```

---

## Estrutura MVC - Resumo

```
App/
├── Core/
│   ├── Core.php       # Boot, roteamento, dispatch, sessão
│   └── RenderView.php # Renderização de views + components
├── Models/            # Classes PDO (Database.php + *Model.php)
├── Controllers/       # Lógica de negócio por domínio
├── Views/             # PHP + HTML (layouts, pages, components)
├── Router/Routes.php  # Mapa de rotas URI -> Controller@action
└── index.php          # require global.php, autoload, Core::run()
```

---

## Comandos Úteis

```bash
# Instalar dependências
composer install

# Limpar cache Composer
composer dump-autoload -o

# Ver logs do container web
docker-compose logs -f web

# Acessar shell do container web
docker-compose exec web bash

# Acessar MySQL no container
docker-compose exec db mysql -u hubmenu_user -p hubmenu

# Rebuild imagem Docker
docker-compose build --no-cache web
```

---

## Variáveis de Ambiente (Produção)

Em produção, **não commite** segredos. Use `.env` ou variáveis de ambiente do servidor/Docker:

```env
DB_HOST=seu-host-db
DB_PORT=3306
DB_USER=usuario_prod
DB_PASSWORD=senha_forte
DB_NAME=hubmenu_prod
PHPMAILER_USERNAME=seu@email.com
PHPMAILER_PASSWORD=senha_app
IAgente_USER=seu@email.com
IAgente_PASS=senha_sms
APP_URL=https://seudominio.com
```

E ajuste `global.php` para ler de `$_ENV` ou `getenv()`.

---

## Licença

Projeto acadêmico / interno. Consulte os autores para uso comercial.

---

## Créditos

Desenvolvido por **Igor Dias**, **Mark Stolfi**, **Moises João Ferreira** & **Yohan Siedschlag**.

---

## Documentação Adicional

- `App/Modelagem/Prototipação HubMenu.pdf` — Prototipagem das telas
- `App/Modelagem/HubMenuBackup.sql` — Schema completo + seeds
- `App/Tests/Testes_A_Serem_Feitos.txt` — Backlog de testes

Para dúvidas ou contribuições, abra uma issue ou contate a equipe.