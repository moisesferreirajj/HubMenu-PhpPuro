<?php 


@require_once __DIR__ . '/../../global.php'; 
@require_once __DIR__ . '/../../Models/PedidosModel.php';


$pedidosModel = new PedidosModel();
$pedidos = $pedidosModel->getOrdersProducts();
if (!$pedidos) {
    echo '<div class="alert alert-danger">Erro ao carregar pedidos.</div>';
}

$pedidos = ($response->status === 'success') ? $response->results : [];

if ($response->status === 'error') {
    echo '<div class="alert alert-danger">Erro ao carregar pedidos: ' . htmlspecialchars($response->message) . '</div>';
}

// Agrupando os produtos por pedido
$pedidosAgrupados = [];
foreach ($pedidos as $row) {
    $id = $row->pedido_id;
    if (!isset($pedidosAgrupados[$id])) {
        $pedidosAgrupados[$id] = [
            'id' => $id,
            'cliente' => $row->cliente_nome,
            'observacao' => $row->pedido_observacao,
            'produtos' => []
        ];
    }
    $pedidosAgrupados[$id]['produtos'][] = [
        'nome' => $row->produto_nome,
        'quantidade' => $row->quantidade,
        'preco_unitario' => $row->preco_unitario
    ];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/pedidosEmpresa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <script src="/Views/Assets/Js/sidebar.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
            tooltipTriggerList.forEach(el => new bootstrap.Tooltip(el));
        });
    </script>

    <title><?= $Title ?> Pedidos</title>
<body>
    
    <?php require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>

    <div class="order-container">
        <?php foreach ($pedidosAgrupados as $pedido): ?>
            <div class="card">
                <div class="card-header">
                    <span class="order-id">Pedido <?=htmlspecialchars($pedido['id']); ?></span>
                    <span class="order-client"><?=htmlspecialchars($pedido['cliente']); ?></span>
                </div>
                <?php foreach ($pedido['produtos'] as $produto): ?>
                    <div class="item">
                        <div class="item-info">
                            <span class="quantity"><?=htmlspecialchars($produto['quantidade']); ?>x</span>
                            <span class="item-name"><?=htmlspecialchars($produto['nome']); ?></span>
                        </div>
                    </div>
                <?php endforeach ?>
                <div class="actions">
                    <button class="btn btn-outline-danger status_pedido">Cancelar</button>
                    <button class="btn btn-success status_pedido">PRONTO</button>
                </div>
            </div>
        <?php endforeach ?>

    </div>

    
    <script src="/Views/Assets/Js/FooterLayout.js"></script>
    <footer-layout></footer-layout>
</body>
</html>