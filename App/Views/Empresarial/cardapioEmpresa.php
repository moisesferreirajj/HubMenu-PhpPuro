<?php

$produtos = $Produtos ?? [];
$estabelecimento = $Estabelecimento ?? null;
$erroProdutos = $Erro ?? null;
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?? 'Menu de Alimentos' ?> Menu de Alimentos</title>
    <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css"> 
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
    <script src="/Views/Assets/Js/cad_products.js" defer></script>
    <script src="/Views/Assets/Js/sidebar.js" defer></script>
</head>
<body>
    <?php require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>
    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
            <div class="container">
                <?php if (!empty($estabelecimento[0]->nome)): ?>
                    <div class="banner-estabelecimento mb-4 d-flex align-items-center justify-content-center" style="width:100%;height:100px;overflow:hidden;">
                        <h2 class="mb-0"><?= htmlspecialchars($estabelecimento[0]->nome) ?></h2>
                    </div>
                <?php else: ?>
                    <div class="banner-estabelecimento mb-4 text-center p-4 bg-light border" style="height:220px;display:flex;align-items:center;justify-content:center;">
                        <p class="text-muted mb-0">Este estabelecimento ainda não possui um banner.</p>
                    </div>
                <?php endif; ?>

                <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
                    </svg>
                </button>
                <div class="d-flex gap-2 ms-auto">
                    <button id="open_cad" data-bs-toggle="modal" data-bs-target="#cadastrarModal" onclick="closeNav()" class="btn btn-light btn-circle">
                        <i class="bi bi-plus-lg"></i>
                    </button>
                    <form action="/empresarial/logout" method="POST" style="display: inline;">
                        <button type="submit" class="btn btn-light btn-circle" title="Sair">
                            <i class="bi bi-box-arrow-right"></i>
                        </button>
                    </form>
                </div>
            </div>
        </nav>

        <!-- Verifica se há erros -->
        <?php if ($erroProdutos): ?>
            <div class="alert alert-danger">Erro ao carregar produtos: <?= htmlspecialchars($erroProdutos) ?></div>
        <?php endif; ?>

        <!-- Banner do estabelecimento -->
        <?php if (!empty($estabelecimento[0]->banner)): ?>
            <div class="banner-estabelecimento mb-4" style="width:100%;height:220px;overflow:hidden;">
                <img src="<?= htmlspecialchars($estabelecimento[0]->banner) ?>" alt="Banner do Estabelecimento" style="width:100%;height:220px;object-fit:cover;">
            </div>
        <?php else: ?>
            <div class="banner-estabelecimento mb-4 text-center p-4 bg-light border" style="height:220px;display:flex;align-items:center;justify-content:center;">
                <p class="text-muted mb-0">Este estabelecimento ainda não possui um banner.</p>
            </div>
        <?php endif; ?>

        <!-- Conteúdo principal -->
        <div class="container py-4">
            <!-- Filtros -->
            <div id="filter-group" class="btn-group" role="group">
                <button type="button" class="btn btn-outline-success active" data-filter="todos">Todos</button>
                <button type="button" class="btn btn-outline-success" data-filter="comidas">Comidas</button>
                <button type="button" class="btn btn-outline-success" data-filter="bebidas">Bebidas</button>
                <button type="button" class="btn btn-outline-success" data-filter="sobremesas">Sobremesas</button>
            </div>

            <div class="search-container-wrapper d-flex align-items-center flex-grow-1">
                <div class="search-container">
                    <input type="text" class="form-control search-input" placeholder="Digite o produto">
                    <button class="btn btn-light search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>

            <h1 class="rowCategory">Principais</h1>
            <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4" id="produtos-lista">
                <?php foreach ($produtos as $produto): 
                    $catId = (int)$produto->categoria_id;
                    if ($catId === 9) {
                        $cardClass = 'category-dessert';
                        $badgeClass = 'badge-dessert';
                    } elseif ($catId === 10) {
                        $cardClass = 'category-drink';
                        $badgeClass = 'badge-drink';
                    } else {
                        $cardClass = 'category-food';
                        $badgeClass = 'badge-food';
                    }
                ?>
                    <div class="col animated-card"
                         data-categoria="<?php echo strtolower(htmlspecialchars($produto->categoria_nome ?? '')); ?>"
                         style="animation-delay: 0.4s">
                        <div class="card <?php echo $cardClass; ?>"
                             data-id="<?php echo $produto->id; ?>"
                             data-descricao="<?php echo htmlspecialchars($produto->descricao); ?>"
                             data-estabelecimento-id="<?php echo $produto->estabelecimento_id; ?>"
                             data-imagem="<?php echo htmlspecialchars($produto->imagem); ?>">
                            <span class="category-badge <?php echo $badgeClass; ?>" data-id="<?php echo $catId; ?>">
                                <?php echo htmlspecialchars($produto->categoria_nome ?? $catId); ?>
                            </span>
                            <button class="btn btn-circle edit-button" data-bs-toggle="modal" data-bs-target="#editModal">
                                <i class="bi bi-pencil"></i>
                            </button>
                            <img src="<?php echo ($produto->imagem ?: 'default.png'); ?>"
                                 class="card-img-top"
                                 alt="<?php echo htmlspecialchars($produto->nome); ?>">
                            <div class="card-body">
                                <h5 class="card-title mb-0"><?php echo htmlspecialchars($produto->nome); ?></h5>
                            </div>
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <span class="price-tag">R$<?php echo number_format($produto->valor, 2, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <!-- Modal de cadastro de produtos -->
        <?php require_once __DIR__ . '/../../Views/Components/Cadastros/cadastrarProdutos.php'; ?>

        <!-- Modal para editar produtos -->
        <?php require_once __DIR__ . '/../../Views/Components/Cadastros/editarProdutos.php'; ?>
    </div>

    <!-- Bootstrap Bundle -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Filtro de produtos por categoria
        document.querySelectorAll('#filter-group .btn').forEach(btn => {
            btn.addEventListener('click', function() {
                document.querySelectorAll('#filter-group .btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');
                const filtro = this.getAttribute('data-filter');
                document.querySelectorAll('#produtos-lista .col').forEach(card => {
                    const categoria = card.getAttribute('data-categoria');
                    if (filtro === 'todos' || categoria === filtro) {
                        card.style.display = '';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });

        // Função de pesquisa de produtos
        const searchBtn = document.querySelector('.search-btn');
        const searchInput = document.querySelector('.search-input');
        const produtosContainer = document.querySelector('#produtos-lista');

        searchBtn.addEventListener('click', () => {
            const query = searchInput.value.trim();
            const estabelecimentoId = <?= json_encode($estabelecimento[0]->id ?? null) ?>;
            if (!estabelecimentoId) return;

            fetch(`/api/produtos/procurar/${estabelecimentoId}?query=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        produtosContainer.innerHTML = '';
                        if (data.produtos.length === 0) {
                            produtosContainer.innerHTML = '<p>Nenhum produto encontrado.</p>';
                            return;
                        }
                        data.produtos.forEach(produto => {
                            const cardHtml = `
                                <div class="col animated-card" style="animation-delay: 0.4s">
                                    <div class="card category-drink" data-id="${produto.id}" data-descricao="${produto.descricao}" data-estabelecimento-id="${produto.estabelecimento_id}" data-imagem="${produto.imagem}">
                                        <span class="category-badge badge-drink" data-id="${produto.categoria_id}">${produto.categoria_id}</span>
                                        <button class="btn btn-circle edit-button" data-bs-toggle="modal" data-bs-target="#editModal">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                        <img src="${produto.imagem || 'default.png'}" class="card-img-top" alt="${produto.nome}">
                                        <div class="card-body">
                                            <h5 class="card-title mb-0">${produto.nome}</h5>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end align-items-center">
                                            <span class="price-tag">R$${Number(produto.valor).toFixed(2).replace('.', ',')}</span>
                                        </div>
                                    </div>
                                </div>`;
                            produtosContainer.insertAdjacentHTML('beforeend', cardHtml);
                        });
                    } else {
                        produtosContainer.innerHTML = '<p>Erro ao buscar produtos.</p>';
                    }
                })
                .catch(err => {
                    produtosContainer.innerHTML = '<p>Erro ao buscar produtos.</p>';
                    console.error(err);
                });
        });

        document.addEventListener('DOMContentLoaded', function () {
            const buttons = document.querySelectorAll('[data-filter]');
            const cards = document.querySelectorAll('#produtos-lista .animated-card');

            buttons.forEach(btn => {
                btn.addEventListener('click', () => {
                    const filtro = btn.getAttribute('data-filter');
                    cards.forEach(card => {
                        const categoria = card.getAttribute('data-categoria');
                        if (filtro === 'all' || categoria === filtro) {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        });

    </script>
</body>
</html>
