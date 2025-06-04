# HubMenu

O **HubMenu** é um sistema de gerenciamento de restaurantes, refeitórios e estabelecimentos gastronômicos, desenvolvido em PHP puro com arquitetura MVC. Ele permite o controle de cardápios digitais, pedidos, avaliações, gestão de usuários e estabelecimentos, tanto para consumo local (via tablets/QR Code) quanto para delivery.

## Tecnologias Utilizadas

- **PHP Puro** (backend, MVC)
- **MySQL/MariaDB** (banco de dados relacional)
- **HTML5, CSS3, JavaScript** (frontend)
- **Bootstrap 5** (framework CSS responsivo)
- **Font Awesome & Bootstrap Icons** (ícones)
- **AJAX** (carregamento dinâmico de dados)
- **Arquitetura MVC** (Models, Views, Controllers)
- **Sistema de rotas customizado**
- **Componentização de layouts**
- **Responsividade mobile**

## Estrutura do Projeto

```
App/
├── Assets/           # CSS, JS, imagens
├── Controllers/      # Lógica de controle (MVC)
├── Core/             # Núcleo do sistema (MVC, renderização)
├── Models/           # Modelos de dados (PHP)
├── Router/           # Rotas do sistema
├── Views/            # Telas e componentes visuais
├── Modelagem/        # Scripts SQL e documentação de banco
├── index.php         # Bootstrap do app
└── global.php        # Configurações globais
```

## Funcionalidades

- Cadastro e gerenciamento de estabelecimentos e usuários
- Cardápio digital com categorias e imagens
- Pedidos online e no salão (via QR Code/tablet)
- Avaliações de clientes e sistema de notas
- Filtros e busca de restaurantes/produtos
- Painel administrativo para empresas
- Interface amigável e responsiva
- Relatórios e análises para o gestor

## Como Executar

1. Clone o repositório e coloque a pasta `App` em seu servidor local (ex: XAMPP).
2. Importe o banco de dados a partir de `App/Modelagem/HubMenuBackup.sql`.
3. Execute o servidor PHP na pasta `App`:
   ```sh
   C:\Xampp\Php\php.exe -S localhost:8080
   ```
4. Acesse [http://localhost:8080](http://localhost:8080) no navegador.

## Créditos

Desenvolvido por Igor Dias, Mark Stolfi, Moises João Ferreira & Yohan Siedschlag.

---

Para mais detalhes, consulte a documentação e os arquivos de código-fonte nas respectivas pastas.