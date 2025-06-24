<?php
// Mapa de categorias para valores normalizados
$categoriaMap = [
    9 => 'sobremesas',
    10 => 'bebidas',
    // Adicione outros mapeamentos conforme necessário, ex.: 1 => 'comidas', 2 => 'salgados'
];

$produtos = $Produtos ?? [];
$estabelecimento = $Estabelecimento ?? null;
$erroProdutos = $Erro ?? null;

// Extrair categorias únicas dos produtos
$categoriasExistentes = [];
foreach ($produtos as $produto) {
    $catId = (int) $produto->categoria_id;
    $categoriaFiltro = $categoriaMap[$catId] ?? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $produto->categoria_nome ?? 'comidas'));
    $categoriaNome = htmlspecialchars($produto->categoria_nome ?? $catId);
    $categoriasExistentes[$categoriaFiltro] = $categoriaNome;
}
ksort($categoriasExistentes); // Ordenar categorias alfabeticamente
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?? 'Menu de Alimentos' ?> Menu de Alimentos</title>

    <!-- Styles -->
    <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">

    <!-- Scripts -->
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
    <script src="/Views/Assets/Js/cad_products.js" defer></script>
    <script src="/Views/Assets/Js/sidebar.js" defer></script>
</head>
<body>
<?php require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>

<div class="content">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-navbar">
        <div class="container">
            <!-- Nome do estabelecimento (centro) -->
            <?php if (!empty($estabelecimento[0]->nome)): ?>
                <div class="banner-estabelecimento mb-4 d-flex align-items-center justify-content-center"
                     style="width:100%;height:100px;overflow:hidden;">
                    <?php if (!empty($estabelecimento[0]->imagem)): ?>
                        <img class="imagemempresa" src="<?= htmlspecialchars($estabelecimento[0]->imagem) ?>" alt="Imagem do Estabelecimento Redonda"
                             style="width:100%;height:100px;object-fit:cover;">
                    <?php endif; ?>
                    <h2 class="mb-0"><?= htmlspecialchars($estabelecimento[0]->nome) ?></h2>
                    <h4><?= htmlspecialchars($estabelecimento[0]->endereco) ?></h4>
                </div>
            <?php else: ?>
                <div class="banner-estabelecimento mb-4 text-center p-4 bg-light border"
                     style="height:220px;display:flex;align-items:center;justify-content:center;">
                    <p class="text-muted mb-0">Este estabelecimento ainda não possui um banner.</p>
                </div>
            <?php endif; ?>

            <!-- Botão para abrir a sidebar -->
            <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                     viewBox="0 0 24 24" fill="none">
                    <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
                </svg>
            </button>

            <!-- Ações (criar / lixeira / logout) -->
            <div class="d-flex gap-2 ms-auto">
                <!-- Criar -->
                <button id="open_cad"
                        data-bs-toggle="modal"
                        data-bs-target="#cadastrarModal"
                        onclick="closeNav()"
                        class="btn btn-light btn-circle">
                    <i class="bi bi-plus-lg"></i>
                </button>

                <!-- Lixeira -->
                <a href="/gerenciar/lixeira/<?= htmlspecialchars($estabelecimento[0]->id ?? '1'); ?>"
                   class="btn btn-light btn-circle"
                   title="Lixeira">
                    <i class="bi bi-trash-fill text-danger"></i>
                </a>

                <!-- Logout -->
                <form action="/empresarial/logout" method="POST" style="display:inline;">
                    <button type="submit" class="btn btn-light btn-circle" title="Sair">
                        <i class="bi bi-box-arrow-right"></i>
                    </button>
                </form>
            </div><!-- /.ações -->
        </div><!-- /.container -->
    </nav>

    <!-- Verifica se há erros -->
    <?php if ($erroProdutos): ?>
        <div class="alert alert-danger">
            Erro ao carregar produtos: <?= htmlspecialchars($erroProdutos) ?>
        </div>
    <?php endif; ?>

    <!-- Banner do estabelecimento -->
    <?php if (!empty($estabelecimento[0]->banner)): ?>
        <div class="banner-estabelecimento mb-4" style="width:100%;height:220px;overflow:hidden;">
            <img src="<?= htmlspecialchars($estabelecimento[0]->banner) ?>" alt="Banner do Estabelecimento"
                 style="width:100%;height:220px;object-fit:cover;">
        </div>
    <?php else: ?>
        <div class="banner-estabelecimento mb-4 text-center p-4 bg-light border"
             style="height:220px;display:flex;align-items:center;justify-content:center;">
            <p class="text-muted mb-0">Este estabelecimento ainda não possui um banner.</p>
        </div>
    <?php endif; ?>

    <!-- Conteúdo principal -->
    <div class="container py-4">
        <!-- Filtros dinâmicos -->
        <div id="filter-group" class="btn-group" role="group">
            <button type="button" class="btn btn-outline-success active" data-filter="todos" aria-label="Filtrar por todos os produtos">Todos</button>
            <?php foreach ($categoriasExistentes as $filtro => $nome): ?>
                <button type="button" class="btn btn-outline-success" data-filter="<?= htmlspecialchars($filtro); ?>" aria-label="Filtrar por <?= htmlspecialchars($nome); ?>">
                    <?= htmlspecialchars(ucfirst($nome)); ?>
                </button>
            <?php endforeach; ?>
        </div>

        <!-- Pesquisa -->
        <div class="search-container-wrapper d-flex align-items-center flex-grow-1">
            <div class="search-container">
                <input type="text" class="form-control search-input" placeholder="Digite o produto" aria-label="Pesquisar produtos">
                <button class="btn btn-light search-btn" aria-label="Pesquisar"><i class="bi bi-search"></i></button>
            </div>
        </div>

        <h1 class="rowCategory">Principais</h1>

        <!-- Lista de produtos -->
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" id="produtos-lista">
            <?php foreach ($produtos as $produto):
                $catId = (int) $produto->categoria_id;
                $categoriaFiltro = $categoriaMap[$catId] ?? strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $produto->categoria_nome ?? 'comidas'));
                $cardClass = $categoriaFiltro === 'sobremesas' ? 'category-dessert' : ($categoriaFiltro === 'bebidas' ? 'category-drink' : 'category-food');
                $badgeClass = $categoriaFiltro === 'sobremesas' ? 'badge-dessert' : ($categoriaFiltro === 'bebidas' ? 'badge-drink' : 'badge-food');
            ?>
            <div class="col animated-card"
                 data-categoria="<?= htmlspecialchars($categoriaFiltro); ?>"
                 style="animation-delay:0.4s">
                <div class="card <?= $cardClass; ?>"
                     data-id="<?= $produto->id; ?>"
                     data-descricao="<?= htmlspecialchars($produto->descricao); ?>"
                     data-estabelecimento-id="<?= $produto->estabelecimento_id; ?>"
                     data-imagem="<?= htmlspecialchars($produto->imagem); ?>">
                    <span class="category-badge <?= $badgeClass; ?>" data-id="<?= $catId; ?>">
                        <?= htmlspecialchars($produto->categoria_nome ?? $catId); ?>
                    </span>
                    <button class="btn btn-circle edit-button" data-bs-toggle="modal" data-bs-target="#editModal">
                        <i class="bi bi-pencil"></i>
                    </button>
                    <img src="<?= $produto->imagem ?: 'default.png'; ?>" class="card-img-top"
                         alt="<?= htmlspecialchars($produto->nome); ?>">
                    <div class="card-body">
                        <h5 class="card-title mb-0"><?= htmlspecialchars($produto->nome); ?></h5>
                    </div>
                    <div class="card-footer d-flex justify-content-end align-items-center">
                        <span class="price-tag">R$<?= number_format($produto->valor, 2, ',', '.'); ?></span>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div><!-- /.row -->
    </div><!-- /.container -->

    <!-- Modais -->
    <?php require_once __DIR__ . '/../../Views/Components/Cadastros/cadastrarProdutos.php'; ?>
    <?php require_once __DIR__ . '/../../Views/Components/Cadastros/editarProdutos.php'; ?>
</div><!-- /.content -->

<!-- Bootstrap Bundle (fallback) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

<script>
// Mapa de categorias para consistência
const categoriaMap = {
    9: 'sobremesas',
    10: 'bebidas',
    // Adicione outros mapeamentos conforme necessário, ex.: 1: 'comidas'
};

/* Filtros */
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

/* Busca */
const searchBtn = document.querySelector('.search-btn');
const searchInput = document.querySelector('.search-input');
const produtosContainer = document.querySelector('#produtos-lista');

searchBtn.addEventListener('click', () => {
    const query = searchInput.value.trim();
    const estId = <?= json_encode($estabelecimento[0]->id ?? null); ?>;
    if (!estId) return;

    fetch(`/api/produtos/procurar/${estId}?query=${encodeURIComponent(query)}`)
        .then(r => r.json())
        .then(data => {
            produtosContainer.innerHTML = '';
            if (data.status !== 'success' || !data.produtos.length) {
                produtosContainer.innerHTML = '<p class="text-muted text-center mt-4">Nenhum produto encontrado.</p>';
                return;
            }

            data.produtos.forEach(produto => {
                const categoriaFiltro = categoriaMap[produto.categoria_id] || 
                    (produto.categoria_nome ? produto.categoria_nome.toLowerCase().replace(/[^a-z0-9]/g, '') : 'comidas');
                const cardClass = categoriaFiltro === 'sobremesas' ? 'category-dessert' : 
                                (categoriaFiltro === 'bebidas' ? 'category-drink' : 'category-food');
                const badgeClass = categoriaFiltro === 'sobremesas' ? 'badge-dessert' : 
                                 (categoriaFiltro === 'bebidas' ? 'badge-drink' : 'badge-food');

                produtosContainer.insertAdjacentHTML('beforeend', `
                    <div class="col animated-card" data-categoria="${categoriaFiltro}" style="animation-delay:.4s">
                        <div class="card ${cardClass}"
                             data-id="${produto.id}"
                             data-descricao="${produto.descricao || ''}"
                             data-estabelecimento-id="${produto.estabelecimento_id}"
                             data-imagem="${produto.imagem || 'default.png'}">
                            <span class="category-badge ${badgeClass}" data-id="${produto.categoria_id}">
                                ${produto.categoria_nome || produto.categoria_id}
                            </span>
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
                    </div>`);
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