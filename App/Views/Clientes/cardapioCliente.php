<?php
// Mapa de categorias para valores normalizados
$categoriaMap = [
    9 => 'sobremesas',
    10 => 'bebidas',
    // Adicione outros mapeamentos conforme necessário, ex.: 1 => 'comidas'
];

$produtos = $Produtos ?? [];
$estabelecimento = $Estabelecimento ?? null;
$erroProdutos = $Erro ?? null;

// Extrair categorias únicas dos produtos
$categoriasExistentes = [];
foreach ($produtos as $produto) {
    if ($produto->status_produtos == 1) { // Considerar apenas produtos com status_produtos = 1
        $catId = (int) $produto->categoria_id;
        $categoriaFiltro = $categoriaMap[$catId] ?? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $produto->categoria_nome ?? 'comidas'));
        $categoriaNome = htmlspecialchars($produto->categoria_nome ?? $catId);
        $categoriasExistentes[$categoriaFiltro] = $categoriaNome;
    }
}
ksort($categoriasExistentes); // Ordenar categorias alfabeticamente

if ($erroProdutos) {
    echo '<div class="alert alert-danger">Erro ao carregar produtos: ' . htmlspecialchars($erroProdutos) . '</div>';
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?? 'Menu de Alimentos' ?> Menu de Alimentos</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
    <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <style>
        .filter-group-centered {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            margin-bottom: 1rem;
            flex-wrap: wrap;
        }
        .filter-group-centered .btn-group {
            flex-wrap: wrap;
            justify-content: center;
        }
    </style>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
    <script src="/Views/Assets/Js/sidebar.js" defer></script>
</head>
<body>


    <div class="content">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-navbar">
            <div class="container">
                    <!-- Botão voltar -->
                    <a href="/restaurantes" class="btn btn-light btn-circle" title="Voltar ao Cardápio" aria-label="Voltar ao Cardápio">
                        <i class="bi bi-arrow-left"></i>
                    </a>
        
                <!-- Nome do estabelecimento (centro) -->
                <?php if (!empty($estabelecimento[0]->nome)): ?>
                    <div class="banner-estabelecimento mb-4 d-flex align-items-center p-4" style="width:100%; min-height: 120px; background: none; border-radius: 12px;">
                        <?php if (!empty($estabelecimento[0]->imagem)): ?>
                            <div class="me-4" style="width: 100px; height: 100px; overflow: hidden; border-radius: 50%; border: 3px solid #fff; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                                <img class="w-100 h-100" src="<?= htmlspecialchars($estabelecimento[0]->imagem) ?>" alt="<?= htmlspecialchars($estabelecimento[0]->nome) ?>" style="object-fit: cover;">
                            </div>
                        <?php endif; ?>
                        <div class="d-flex flex-column">
                            <h2 class="mb-1 fw-bold text-dark"><?= htmlspecialchars($estabelecimento[0]->nome) ?></h2>
                            <div class="d-flex align-items-center text-muted">
                                <i class="bi bi-geo-alt-fill me-2"></i>
                                <span><?= htmlspecialchars($estabelecimento[0]->endereco) ?></span>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="banner-estabelecimento mb-4 d-flex align-items-center justify-content-center p-4" 
                         style="height: 120px; background: #f8f9fa; border: 2px dashed #dee2e6; border-radius: 12px;">
                        <div class="text-center">
                            <i class="bi bi-image text-muted" style="font-size: 2rem;"></i>
                            <p class="text-muted mt-2 mb-0">Este estabelecimento ainda não possui um banner.</p>
                        </div>
                    </div>
                <?php endif; ?>
        </nav>

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
            <!-- Filtros dinâmicos -->
            <div class="filter-group-centered">
                <div id="filter-group" class="btn-group" role="group">
                    <button type="button" class="btn btn-outline-success active" data-filter="todos" aria-label="Filtrar por todos os produtos">Todos</button>
                    <?php foreach ($categoriasExistentes as $filtro => $nome): ?>
                        <button type="button" class="btn btn-outline-success" data-filter="<?= htmlspecialchars($filtro); ?>" aria-label="Filtrar por <?= htmlspecialchars($nome); ?>">
                            <?= htmlspecialchars(ucfirst($nome)); ?>
                        </button>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="search-container-wrapper d-flex align-items-center flex-grow-1 search-container-centered">
                <div class="search-container">
                    <input type="text" class="form-control search-input" placeholder="Digite o produto" aria-label="Pesquisar produtos">
                    <button class="btn btn-light search-btn" aria-label="Pesquisar"><i class="bi bi-search"></i></button>
                </div>
            </div>

            <h1 class="rowCategory">Principais</h1>
            <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4" id="produtos-lista">
                <?php foreach ($produtos as $produto): 
                    if ($produto->status_produtos == 1): // Exibir apenas produtos com status_produtos = 1
                        $catId = (int)$produto->categoria_id;
                        $categoriaFiltro = $categoriaMap[$catId] ?? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $produto->categoria_nome ?? 'comidas'));
                        $cardClass = $categoriaFiltro === 'sobremesas' ? 'category-dessert' : ($categoriaFiltro === 'bebidas' ? 'category-drink' : 'category-food');
                        $badgeClass = $categoriaFiltro === 'sobremesas' ? 'badge-dessert' : ($categoriaFiltro === 'bebidas' ? 'badge-drink' : 'badge-food');
                ?>
                    <div class="col animated-card"
                         data-categoria="<?= htmlspecialchars($categoriaFiltro); ?>"
                         style="animation-delay: 0.4s">
                        <div class="card <?= $cardClass; ?>">
                            <span class="category-badge <?= $badgeClass; ?>" data-id="<?= $catId; ?>">
                                <?= htmlspecialchars($produto->categoria_nome ?? $catId); ?>
                            </span>
                            <img src="<?= ($produto->imagem ?: 'default.png'); ?>"
                                 class="card-img-top"
                                 alt="<?= htmlspecialchars($produto->nome); ?>">
                            <div class="card-body">
                                <h5 class="card-title mb-0"><?= htmlspecialchars($produto->nome); ?></h5>
                            </div>
                            <div class="card-footer d-flex justify-content-end align-items-center">
                                <span class="price-tag">R$<?= number_format($produto->valor, 2, ',', '.'); ?></span>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script>
        // Mapa de categorias para consistência
        const categoriaMap = {
            9: 'sobremesas',
            10: 'bebidas',
            // Adicione outros mapeamentos conforme necessário, ex.: 1: 'comidas'
        };

        // Filtro de produtos por categoria
        document.querySelectorAll('#filter-group .btn').forEach(btn => {
            btn.addEventListener('click', () => {
                // Remove a classe 'active' de todos os botões
                document.querySelectorAll('#filter-group .btn').forEach(b => b.classList.remove('active'));
                btn.classList.add('active');

                const filtro = btn.dataset.filter;
                const cards = document.querySelectorAll('#produtos-lista .col');
                let hasVisibleCards = false;

                cards.forEach(card => {
                    const categoria = card.dataset.categoria;
                    const isVisible = filtro === 'todos' || categoria === filtro;
                    card.style.display = isVisible ? '' : 'none';
                    if (isVisible) hasVisibleCards = true;
                });

                // Exibe mensagem se nenhum produto for encontrado
                const noResults = document.querySelector('#no-results-message');
                if (!hasVisibleCards) {
                    if (!noResults) {
                        const message = document.createElement('p');
                        message.id = 'no-results-message';
                        message.textContent = 'Nenhum produto encontrado para esta categoria.';
                        message.className = 'text-muted text-center mt-4';
                        document.querySelector('#produtos-lista').appendChild(message);
                    }
                } else if (noResults) {
                    noResults.remove();
                }
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
                    produtosContainer.innerHTML = '';
                    if (data.status !== 'success' || !data.produtos.length) {
                        produtosContainer.innerHTML = '<p class="text-muted text-center mt-4">Nenhum produto encontrado.</p>';
                        return;
                    }

                    data.produtos.forEach(produto => {
                        if (produto.status_produtos == 1) { // Exibir apenas produtos com status_produtos = 1
                            const categoriaFiltro = categoriaMap[produto.categoria_id] || 
                                (produto.categoria_nome ? produto.categoria_nome.toLowerCase().replace(/[^a-z0-9]/g, '') : 'comidas');
                            const cardClass = categoriaFiltro === 'sobremesas' ? 'category-dessert' : 
                                            (categoriaFiltro === 'bebidas' ? 'category-drink' : 'category-food');
                            const badgeClass = categoriaFiltro === 'sobremesas' ? 'badge-dessert' : 
                                             (categoriaFiltro === 'bebidas' ? 'badge-drink' : 'badge-food');

                            produtosContainer.insertAdjacentHTML('beforeend', `
                                <div class="col animated-card" data-categoria="${categoriaFiltro}" style="animation-delay:0.4s">
                                    <div class="card ${cardClass}">
                                        <span class="category-badge ${badgeClass}" data-id="${produto.categoria_id}">
                                            ${produto.categoria_nome || produto.categoria_id}
                                        </span>
                                        <img src="${produto.imagem || 'default.png'}" class="card-img-top" alt="${produto.nome}">
                                        <div class="card-body">
                                            <h5 class="card-title mb-0">${produto.nome}</h5>
                                        </div>
                                        <div class="card-footer d-flex justify-content-end align-items-center">
                                            <span class="price-tag">R$${Number(produto.valor).toFixed(2).replace('.', ',')}</span>
                                        </div>
                                    </div>
                                </div>`);
                        }
                    });

                    // Reaplicar o filtro atual após a busca
                    const activeFilter = document.querySelector('#filter-group .btn.active')?.dataset.filter || 'todos';
                    document.querySelectorAll('#produtos-lista .col').forEach(card => {
                        const categoria = card.dataset.categoria;
                        card.style.display = activeFilter === 'todos' || categoria === activeFilter ? '' : 'none';
                    });

                    // Atualizar filtros dinamicamente após a busca
                    const categoriasBusca = new Set();
                    document.querySelectorAll('#produtos-lista .col').forEach(card => {
                        categoriasBusca.add(card.dataset.categoria);
                    });
                    document.querySelectorAll('#filter-group .btn:not([data-filter="todos"])').forEach(btn => {
                        btn.style.display = categoriasBusca.has(btn.dataset.filter) ? '' : 'none';
                    });
                })
                .catch(() => produtosContainer.innerHTML = '<p class="text-muted text-center mt-4">Erro ao buscar produtos.</p>');
        });
    </script>
</body>
</html>