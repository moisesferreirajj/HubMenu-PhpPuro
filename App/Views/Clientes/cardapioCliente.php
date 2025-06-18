<?php
$produtos = $Produtos ?? [];
$estabelecimento = $Estabelecimento ?? null;
if ($Erro) {
    echo '<div class="alert alert-danger">Erro ao carregar produtos: ' . htmlspecialchars($Erro) . '</div>';
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
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
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
                    <div class="banner-estabelecimento mb-4 text-center p-4 bg-light border" style="height:100px;display:flex;align-items:center;justify-content:center;">
                        <p class="text-muted mb-0">Nome do estabelecimento não disponível</p>
                    </div>
                <?php endif; ?>

                <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
                    </svg>
                </button>
            </div>
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
                        <div class="card <?php echo $cardClass; ?>">
                            <span class="category-badge <?php echo $badgeClass; ?>" data-id="<?php echo $catId; ?>">
                                <?php echo htmlspecialchars($produto->categoria_nome ?? $catId); ?>
                            </span>
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
    </div>

    <footer class="footer mt-auto py-3 text-white">
        <div class="container">
            <div id="central" class="row g-4">
                <div id="divcentral" class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">HubMenu</h5>
                    <p class="small">
                        O <strong>HubMenu</strong> não é apenas um sistema de pedidos, é uma revolução na forma como você e seus clientes
                        interagem com a comida! Em um mundo cada vez mais dinâmico, onde o tempo é um recurso precioso, o <strong>HubMenu</strong>
                        foi pensado para otimizar sua operação e proporcionar uma experiência única com agilidade!
                    </p>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <h5 class="fw-bold mb-3">Links Úteis</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-opacity">Termos de Ações Empresariais</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-opacity">Termos de Privacidade</a></li>
                        <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-opacity">Termos de Serviço</a></li>
                    </ul>
                </div>
                
                <div class="col-lg-4 col-md-12">
                    <h5 class="fw-bold mb-3">Nossa Equipe</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <a href="https://www.linkedin.com/in/igor-dias-b3162b219/" class="text-white text-decoration-none hover-opacity">
                                <i class="bi bi-linkedin"></i> Igor Dias
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://www.linkedin.com/in/mark-stolfi-b84760337/" class="text-white text-decoration-none hover-opacity">
                                <i class="bi bi-linkedin"></i> Mark Stolfi
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://www.linkedin.com/in/moisesferreirajj/" class="text-white text-decoration-none hover-opacity">
                                <i class="bi bi-linkedin"></i> Moises Ferreira
                            </a>
                        </li>
                        <li class="mb-2">
                            <a href="https://www.linkedin.com/in/yohansie/" class="text-white text-decoration-none hover-opacity">
                                <i class="bi bi-linkedin"></i> Yohan Siedschlag
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="row border-top border-secondary mt-4 pt-3">
                <div class="col-12 text-center">
                    <p class="small mb-0">© 2025 HubMenu. Todos os direitos reservados.</p>
                </div>
            </div>
        </div>
    </footer>

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
                            const catId = parseInt(produto.categoria_id);
                            const cardClass = catId === 9 ? 'category-dessert' : catId === 10 ? 'category-drink' : 'category-food';
                            const badgeClass = catId === 9 ? 'badge-dessert' : catId === 10 ? 'badge-drink' : 'badge-food';
                            const cardHtml = `
                                <div class="col animated-card" data-categoria="${produto.categoria_nome ? produto.categoria_nome.toLowerCase() : ''}" style="animation-delay: 0.4s">
                                    <div class="card ${cardClass}">
                                        <span class="category-badge ${badgeClass}" data-id="${catId}">${produto.categoria_nome || catId}</span>
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
licher 6
                        produtosContainer.innerHTML = '<p>Erro ao buscar produtos.</p>';
                    }
                })
                .catch(err => {
                    produtosContainer.innerHTML = '<p>Erro ao buscar produtos.</p>';
                    console.error(err);
                });
        });
    </script>
</body>
</html>