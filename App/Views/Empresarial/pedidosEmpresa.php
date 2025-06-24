<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/pedidosEmpresa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <title>HubMenu | Pedidos</title>
</head>
<body>
    
    <?php require_once __DIR__ . '/../../Views/Components/Cadastros/cadastrarPedidos.php'; ?>
    <?php require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>

    <div class="header">
        <div class="container">
            <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
                </svg>
            </button>
            <div class="search-container-wrapper d-flex align-items-center flex-grow-1">
                <div class="search-container">
                    <input type="text" class="form-control search-input" placeholder="Digite o produto">
                    <button class="btn btn-light search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="actions-right">
                <button id="open_cad" data-bs-toggle="modal" data-bs-target="#cadastrarModal" onclick="closeNav()" class="btn btn-light btn-circle">
                    <i class="bi bi-plus-lg"></i>
                </button>
            </div>
        </div>
    </div>

    <div class="order-container">
    <?php foreach ($orders as $pedido): ?>
        <div class="card">
            <div class="card-header">
                <span class="order-id">Pedido #<?= htmlspecialchars($pedido->id) ?></span>
                <span class="order-client"><?= htmlspecialchars($pedido->cliente ?? $pedido->nome) ?></span>
                <span class="order-status badge bg-<?= 
                    $pedido->status == 'entregue' ? 'success' : 
                    ($pedido->status == 'cancelado' ? 'danger' : 
                    ($pedido->status == 'preparando' ? 'warning' : 'info'))
                ?>">
                    <?= ucfirst($pedido->status) ?>
                </span>
            </div>
            <div class="card-body">
            <?php if (!empty($pedido->produtos) && is_array($pedido->produtos)): ?>
                <?php foreach ($pedido->produtos as $item): ?>
                    <div class="item">
                        <div class="item-info">
                            <span class="quantity"><?= intval($item->quantidade) ?>x</span>
                            <span class="item-name"><?= htmlspecialchars($item->nome) ?></span>
                            <span class="item-price" style="margin-left: 8px;">| R$ <?= number_format($item->valor, 2, ',', '.') ?></span>
                        </div>
                        <span class="item-observations">- <?= htmlspecialchars($item->descricao) ?></span>
                        <span class="item-observations">[ <?= htmlspecialchars($item->observacao) ?> ]</span>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Nenhum produto encontrado para este pedido.</p>
            <?php endif; ?>
            </div>

            <div class="actions">
                <form method="POST" action="/api/pedidos/atualizar-status" class="d-inline">
                    <input type="hidden" name="pedido_id" value="<?= $pedido->id ?>">
                    <input type="hidden" name="status" value="cancelado">
                    <button type="submit" class="btn btn-outline-danger">Cancelar</button>
                </form>

                <form method="POST" action="/api/pedidos/atualizar-status" class="d-inline">
                    <input type="hidden" name="pedido_id" value="<?= $pedido->id ?>">
                    <input type="hidden" name="status" value="entregue">
                    <button type="submit" class="btn btn-success">Concluir</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
    </div>

    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <script src="/Views/Assets/Js/sidebar.js"></script>
    <script src="/Views/Assets/Js/FooterLayout.js"></script>
    <footer-layout></footer-layout>
</body>
</html>