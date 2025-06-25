<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Cadastro de Produto

    $dashboard = new DashboardController();

    // cadastro, edit e delete de categoria
    $dashboard->Categoria();

    // cadastro, edit e delete de usuario
    $dashboard->Usuario();

    // cadastro, edit e delete de produto
    $dashboard->Produto();

    // cadastro, edit e delete de pedido
    $dashboard->Pedido();

    // edit vendas
    $dashboard->Venda();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HubMenu - Dashboard</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #f1f5f9;
            --accent-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --dark-color: #1e293b;
            --light-color: #f8fafc;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            /* background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); */
            background: #f8fafc;
            /* cor sólida clara */
            min-height: 100vh;
        }

        .sidebar {
            background: linear-gradient(180deg, var(--dark-color) 0%, #2d3748 100%);
            min-height: 100vh;
            width: 280px;
            position: fixed;
            left: 0;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
            box-shadow: 4px 0 20px rgba(0, 0, 0, 0.1);
        }

        .sidebar.collapsed {
            width: 80px;
        }

        .sidebar-header {
            padding: 20px;
            text-align: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar-header h3 {
            color: white;
            margin: 0;
            font-weight: bold;
            font-size: 1.5rem;
        }

        .sidebar-header .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.9rem;
            margin-top: 5px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .sidebar-menu .menu-item {
            display: block;
            padding: 15px 25px;
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: all 0.3s ease;
            border-left: 3px solid transparent;
        }

        .sidebar-menu .menu-item:hover,
        .sidebar-menu .menu-item.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            border-left-color: var(--primary-color);
            transform: translateX(5px);
        }

        .sidebar-menu .menu-item i {
            width: 20px;
            margin-right: 15px;
        }

        .main-content {
            margin-left: 280px;
            padding: 0;
            transition: all 0.3s ease;
        }

        .main-content.expanded {
            margin-left: 80px;
        }

        .topbar {
            background: white;
            padding: 15px 30px;
            box-shadow: 0 2px 20px rgba(0, 0, 0, 0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .toggle-btn {
            background: none;
            border: none;
            font-size: 1.2rem;
            color: var(--dark-color);
            cursor: pointer;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
        }

        .content-area {
            padding: 30px;
            background: var(--light-color);
            min-height: calc(100vh - 80px);
        }

        .page-title {
            color: var(--dark-color);
            margin-bottom: 30px;
            font-weight: bold;
            font-size: 2rem;
        }

        .stats-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: none;
            position: relative;
            overflow: hidden;
        }

        .stats-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
        }

        .stats-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.15);
        }

        .stats-card .icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 15px;
        }

        .stats-card.primary .icon {
            background: linear-gradient(45deg, var(--primary-color), #8b5cf6);
        }

        .stats-card.success .icon {
            background: linear-gradient(45deg, var(--accent-color), #34d399);
        }

        .stats-card.warning .icon {
            background: linear-gradient(45deg, var(--warning-color), #fbbf24);
        }

        .stats-card.danger .icon {
            background: linear-gradient(45deg, var(--danger-color), #f87171);
        }

        .stats-card h3 {
            font-size: 2rem;
            font-weight: bold;
            color: var(--dark-color);
            margin: 0;
        }

        .stats-card p {
            color: #6b7280;
            margin: 0;
            font-size: 0.95rem;
        }

        .chart-container {
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
            margin-top: 0;
            /* Deixe zero para alinhar */
            height: 100%;
            /* Garante que o container acompanhe o canvas */
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .data-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 25px rgba(0, 0, 0, 0.08);
        }

        .table {
            margin: 0;
        }

        .table th {
            background: var(--secondary-color);
            border: none;
            font-weight: 600;
            color: var(--dark-color);
            padding: 15px;
        }

        .table td {
            border: none;
            padding: 15px;
            vertical-align: middle;
        }

        .table tbody tr {
            border-bottom: 1px solid #e5e7eb;
            transition: all 0.2s ease;
        }

        .table tbody tr:hover {
            background-color: #f9fafb;
        }

        .btn-action {
            padding: 5px 10px;
            border: none;
            border-radius: 8px;
            font-size: 0.8rem;
            margin: 0 2px;
            transition: all 0.2s ease;
        }

        .btn-edit {
            background: #3b82f6;
            color: white;
        }

        .btn-delete {
            background: #ef4444;
            color: white;
        }

        .btn-view {
            background: #10b981;
            color: white;
        }

        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #d1fae5;
            color: #065f46;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #991b1b;
        }

        .modal-header {
            background: var(--dark-color);
            color: white;
            border: none;
        }

        .modal-header .btn-close {
            filter: invert(1);
        }

        .form-control,
        .form-select {
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            padding: 12px 15px;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(99, 102, 241, 0.25);
        }

        .btn-primary {
            background: var(--accent-color);
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(99, 102, 241, 0.4);
        }

        .page-content {
            display: none;
        }

        .page-content.active {
            display: block;
        }

        @media (max-width: 768px) {
            .sidebar {
                width: 100vw;
                height: 0;
                min-height: 0;
                max-height: 0;
                position: fixed;
                left: 0;
                top: 0;
                z-index: 2000;
                overflow: hidden;
                transition: max-height 0.3s ease, height 0.3s ease;
            }

            .sidebar.show {
                height: auto;
                max-height: 100vh;
                min-height: 100vh;
                overflow-y: auto;
            }

            .main-content {
                margin-left: 0;
            }

            .main-content.expanded {
                margin-left: 0;
            }
        }

        .loading {
            display: none;
            text-align: center;
            padding: 50px;
        }

        .spinner-border {
            color: var(--primary-color);
        }

        .alert {
            border: none;
            border-radius: 10px;
            padding: 15px 20px;
        }

        .card-body canvas {
            max-height: 400px;
        }

        .chart,
        .chart-container canvas {
            min-height: 400px !important;
            max-height: 400px !important;
            height: 400px !important;
        }

        #relatorios .chart-container canvas {
            min-height: 400px !important;
            max-height: 400px !important;
            height: 400px !important;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <h3><i class="fas fa-utensils"></i> HubMenu</h3>
            <div class="subtitle">Painel Administrativo</div>
        </div>
        <nav class="sidebar-menu">
            <a href="#" class="menu-item active" data-page="dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
            </a>
            <a href="#" class="menu-item" data-page="produtos" id="products_page">
                <i class="fas fa-box"></i> Produtos
            </a>
            <a href="#" class="menu-item" data-page="pedidos" id="orders_page">
                <i class="fas fa-shopping-cart"></i> Pedidos
            </a>
            <a href="#" class="menu-item" data-page="categorias" id="category_page">
                <i class="fas fa-tags"></i> Categorias
            </a>
            <a href="#" class="menu-item" data-page="usuarios" id="user_page">
                <i class="fas fa-users"></i> Usuários
            </a>
            <a href="#" class="menu-item" data-page="vendas" id="sell_page">
                <i class="fas fa-chart-line"></i> Vendas
            </a>
            <a href="#" class="menu-item" data-page="avaliacoes">
                <i class="fas fa-star"></i> Avaliações
            </a>
            <a href="#" class="menu-item" data-page="relatorios">
                <i class="fas fa-file-alt"></i> Relatórios
            </a>
            <a href="/gerenciar/cardapio/<?= $EstabelecimentoID ?>" class="menu-item">
                <i class="fas fa-sign-out"></i> Cardápio
            </a>
            <a href="/empresarial/logout" class="menu-item">
                <i class="fas fa-sign-out"></i> Logout
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Top Bar -->
        <div class="topbar">
            <button class="toggle-btn" id="toggleBtn">
                <i class="fas fa-bars"></i>
            </button>
            <div class="user-info">
                <div>
                    <div style="font-weight: 500;"><?= $_SESSION['usuario_nome'] ?? '' ?></div>
                    <small style="color: #6b7280;"><?= $_SESSION['usuario_cargo'] ?? '' ?></small>
                </div>
            </div>
        </div>

        <!-- Content Area -->
        <div class="content-area">
            <!-- Dashboard Page -->
            <div class="page-content active" id="dashboard">
                <h2 class="page-title">Dashboard Goeral</h2>
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="stats-card primary animate__animated animate__fadeInUp">
                            <div class="icon"><i class="fas fa-store"></i></div>
                            <h3>R$
                                <?= number_format(array_sum(array_map(fn($v) => $v->valor_total, $Vendas)), 2, ',', '.') ?? '0' ?>
                            </h3>
                            <p>Total Vendas</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card success animate__animated animate__fadeInUp"
                            style="animation-delay: 0.1s;">
                            <div class="icon"><i class="fas fa-box"></i></div>
                            <h3><?= count($Produtos) ?? '0' ?></h3>
                            <p>Produtos</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card warning animate__animated animate__fadeInUp"
                            style="animation-delay: 0.2s;">
                            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                            <h3><?= count($Pedidos) ?? '0' ?></h3>
                            <p>Pedidos</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card danger animate__animated animate__fadeInUp"
                            style="animation-delay: 0.3s;">
                            <div class="icon"><i class="fas fa-users"></i></div>
                            <h3><?= count($Usuarios) ?? '0' ?></h3>
                            <p>Usuários</p>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8">
                        <div class="chart-container">
                            <h5><i class="fas fa-chart-line"></i> Vendas por Mês</h5>
                            <canvas id="salesChart" class="chart" height="320"></canvas>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="chart-container">
                            <h5><i class="fas fa-chart-pie"></i> Melhores Produtos</h5>
                            <canvas id="topEstablishmentsChart" class="chart"></canvas>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-12">
                        <div class="data-table">
                            <div class="p-3 border-bottom">
                                <h5><i class="fas fa-clock"></i> Últimos Pedidos</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Cliente</th>
                                        <th>Status</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($PedidosRecentes as $pedidorecente): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($pedidorecente->id) ?></td>
                                            <td><?= htmlspecialchars($pedidorecente->cliente_nome) ?></td>
                                            <td>
                                                <?php if ($pedidorecente->status == "entregue"): ?>
                                                    <span class="status-badge status-approved">Entregue</span>
                                                <?php elseif ($pedidorecente->status == "preparando"): ?>
                                                    <span class="status-badge status-pending">Preparando</span>
                                                <?php else: ?>
                                                    <span class="status-badge status-cancelled">Cancelado</span>
                                                <?php endif; ?>
                                            </td>
                                            <td>R$<?= number_format($pedidorecente->valor_total, 2, ',', '.') ?></td>
                                            <td><?= date('d/m/Y', strtotime($pedidorecente->data_pedido)) ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Produtos Page -->
            <div class="page-content" id="produtos">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="page-title">Produtos</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#produtoModal"
                        id="registerPro">
                        <i class="fas fa-plus"></i> Novo Produto
                    </button>
                </div>

                <div class="data-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Categoria</th>
                                <th>Estabelecimento</th>
                                <th>Valor</th>
                                <th>Status</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Produtos as $produto): ?>
                                <tr>
                                    <td><?= htmlspecialchars($produto->id) ?></td>
                                    <td><?= ucwords(htmlspecialchars($produto->nome)) ?></td>
                                    <td><?= htmlspecialchars($produto->categoria_nome) ?></td>
                                    <td><?= htmlspecialchars($produto->estabelecimento_nome) ?></td>
                                    <td><?= number_format(floatval($produto->valor), 2, ',', '.') ?></td>
                                    <td>
                                        <?php if ($produto->status_produtos == 1): ?>
                                            <span class="status-badge status-approved">Ativo</span>
                                        <?php else: ?>
                                            <span class="status-badge status-cancelled">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn-action btn-edit btn-edit-produto"
                                            data-id="<?= $produto->id ?>"
                                            data-nome="<?= htmlspecialchars($produto->nome) ?>"
                                            data-categoria="<?= $produto->categoria_id ?>"
                                            data-valor="<?= htmlspecialchars($produto->valor) ?>"
                                            data-descricao="<?= htmlspecialchars($produto->descricao) ?>"
                                            data-status="<?= $produto->status_produtos ?>">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button class="btn-action btn-delete btn-delete-produto" data-id="<?= $produto->id ?>">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Pedidos Page -->
            <div class="page-content" id="pedidos">
                <h2 class="page-title">Pedidos</h2>

                <div class="data-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Cliente</th>
                                <th>Valor Total</th>
                                <th>Observação</th>
                                <th>Status</th>
                                <th>Avaliação</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Pedidos as $pedido): ?>
                                <tr>
                                    <td><?= htmlspecialchars((string) ($pedido->id ?? '')) ?></td>
                                    <td><?= ucwords(htmlspecialchars((string) ($pedido->cliente ?? ''))) ?></td>
                                    <td><?= number_format((float) ($pedido->valor_total ?? 0), 2, ',', '.') ?></td>
                                    <td><?= htmlspecialchars((string) ($pedido->observacao ?? '')) ?></td>
                                    <td>
                                        <?php if (($pedido->status ?? '') === "entregue"): ?>
                                            <span class="status-badge status-approved">Entregue</span>
                                        <?php elseif (($pedido->status ?? '') === "preparando"): ?>
                                            <span class="status-badge status-pending">Preparando</span>
                                        <?php else: ?>
                                            <span class="status-badge status-cancelled">Cancelado</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= number_format((float) ($pedido->avaliacao ?? 0), 1, ',', '.') ?></td>
                                    <td><?= $pedido->data_pedido ? date('d/m/Y', strtotime($pedido->data_pedido)) : '' ?>
                                    </td>
                                    <td><button class="btn-action btn-edit btn-edit-pedido" data-id="<?= $pedido->id ?>">
                                            <i class="fas fa-edit"></i></button></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Categorias Page -->
            <div class="page-content" id="categorias">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="page-title">Categorias</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoriaModal"
                        id="registerCat">
                        <i class="fas fa-plus"></i> Nova Categoria
                    </button>
                </div>
                <div class="data-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Categorias as $categoria): ?>
                                <tr>
                                    <td><?= htmlspecialchars($categoria->id) ?></td>
                                    <td><?= htmlspecialchars($categoria->nome) ?></td>
                                    <td>
                                        <button class="btn-action btn-edit btn-edit-categoria" data-id="<?= $categoria->id ?>"
                                            data-nome="<?= htmlspecialchars($categoria->nome) ?>"><i
                                                class="fas fa-edit"></i></button>

                                        <button class="btn-action btn-delete btn-delete-categoria" data-id="<?= $categoria->id ?>"><i
                                                class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Usuários Page -->
            <div class="page-content" id="usuarios">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="page-title">Usuários</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usuarioModal" id="btnNovoUsuario">
                        <i class="fas fa-plus"></i> Novo Usuário
                    </button>
                </div>

                <div class="data-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Email</th>
                                <th>Cargo</th>
                                <th>Telefone</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Usuarios as $usuario): ?>
                                <tr>
                                    <td><?= htmlspecialchars($usuario->id) ?></td>
                                    <td><?= htmlspecialchars($usuario->nome) ?></td>
                                    <td><?= htmlspecialchars($usuario->email) ?></td>
                                    <td data-cargo-id="<?= $usuario->cargo_id ?>"><?= htmlspecialchars($usuario->cargo_nome) ?></td>
                                    <td><?= htmlspecialchars($usuario->telefone) ?></td>
                                    <td>
                                        <button type="button" class="btn-action btn-edit btn-edit-usuario"
                                            data-id="<?= $usuario->id ?>"
                                            data-nome="<?= htmlspecialchars($usuario->nome) ?>"
                                            data-email="<?= htmlspecialchars($usuario->email) ?>"
                                            data-cargo="<?= $usuario->cargo_id ?>"
                                            data-telefone="<?= htmlspecialchars($usuario->telefone) ?>"
                                            data-cep="<?= htmlspecialchars($usuario->cep) ?>"
                                            data-endereco="<?= htmlspecialchars($usuario->endereco) ?>"
                                            title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn-action btn-delete btn-delete-usuario"
                                            data-id="<?= $usuario->id ?>"
                                            title="Excluir">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Vendas Page -->
            <div class="page-content" id="vendas">
                <h2 class="page-title">Vendas</h2>

                <div class="data-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Referência</th>
                                <th>Transação ID</th>
                                <th>Valor Total</th>
                                <th>Status</th>
                                <th>Data</th>
                                <th>Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Vendas as $venda): ?>
                                <tr>
                                    <td><?= htmlspecialchars($venda->id) ?></td>
                                    <td><?= htmlspecialchars($venda->referencia) ?></td>
                                    <td><?= htmlspecialchars($venda->transacao_id) ?></td>
                                    <td><?= number_format(htmlspecialchars($venda->valor_total), 2, ',', '.') ?></td>
                                    <td>
                                        <?php if ($venda->status_pagamento == 'Aprovado'): ?>
                                            <span class="status-badge status-approved">Aprovado</span>
                                        <?php elseif ($venda->status_pagamento == 'Cancelado'): ?>
                                            <span class="status-badge status-cancelled">Cancelado</span>
                                        <?php else: ?>
                                            <span class="status-badge status-pending">Pendente</span>
                                        <?php endif; ?>
                                    </td>
                                    <td><?= date('d/m/Y', strtotime($venda->data_venda)) ?></td>
                                    <td>
                                        <button class="btn-action btn-edit btn-edit-venda" data-id="<?= $venda->id ?>">
                                            <i class="fas fa-edit"></i> Status</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Avaliações Page -->
            <?php

            $mediaGeral = 0;
            $qtdeAvaliacoes = count($Avaliacoes);

            if ($qtdeAvaliacoes > 0) {
                $soma = 0;
                foreach ($Avaliacoes as $a) {
                    $soma += floatval($a->avaliacao);
                }
                $mediaGeral = $soma / $qtdeAvaliacoes;
            }

            ?>
            <div class="page-content" id="avaliacoes">
                <h2 class="page-title">Avaliações</h2>

                <div class="row mb-4">
                    <div class="col-md-6">
                        <div class="stats-card primary">
                            <div class="icon"><i class="fas fa-star"></i></div>
                            <h3><?= number_format($mediaGeral, 1, ',', '.') ?></h3>
                            <p>Média Geral</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stats-card success">
                            <div class="icon"><i class="fas fa-mobile-alt"></i></div>
                            <h3><?= $qtdeAvaliacoes ?></h3>
                            <p>Qtde. de Avaliações</p>
                        </div>
                    </div>
                </div>

                <div class="data-table">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Usuário</th>
                                <th>Avaliação</th>
                                <th>Comentário</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Avaliacoes as $avaliacao): ?>
                                <tr>
                                    <td><?= htmlspecialchars($avaliacao->id) ?></td>
                                    <td><?= htmlspecialchars($avaliacao->usuario_nome) ?></td>
                                    <td><?= number_format($avaliacao->avaliacao, 1, ',', '.') ?></td>
                                    <td><?= htmlspecialchars($avaliacao->comentario) ?></td>
                                    <td><?= date('d/m/Y', strtotime($avaliacao->data_avaliacao)) ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Relatórios Page -->
            <div class="page-content" id="relatorios">
                <h2 class="page-title">Relatórios</h2>
                <div class="row">
                    <!-- Horários de Pico (maior) -->
                    <div class="col-md-8">
                        <div class="chart-container">
                            <h5><i class="fas fa-clock"></i> Horários de Pico</h5>
                            <canvas id="peakHoursChart" class="chart" height="400"></canvas>
                        </div>
                    </div>
                    <!-- Vendas por Categoria (menor) -->
                    <div class="col-md-4">
                        <div class="chart-container">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h5><i class="fas fa-chart-bar"></i> Vendas por Categoria</h5>
                                <div>
                                    <select class="form-select form-select-sm" style="width: auto;">
                                        <option>Último mês</option>
                                        <option>Últimos 3 meses</option>
                                        <option>Último ano</option>
                                    </select>
                                </div>
                            </div>
                            <canvas id="categoryChart" class="chart" height="400"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Produto -->
    <div class="modal fade" id="produtoModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="formProduto" autocomplete="off" enctype="multipart/form-data">
                    <input type="hidden" name="estabelecimento_id" value="<?= $EstabelecimentoID ?>">
                    <input type="hidden" name="acao" id="produtoAcao" value="cadastrar_produto">
                    <input type="hidden" name="id" id="produtoId">
                    <div class="modal-header">
                        <h5 class="modal-title" id="produtoModalTitle"><i class="fas fa-box"></i> Novo Produto</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" id="produtoNome" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Categoria</label>
                            <select class="form-select" name="categoria_id" id="produtoCategoria" required>
                                <option value="">Selecione a categoria</option>
                                <?php foreach ($Categorias as $categoria): ?>
                                    <option value="<?= $categoria->id ?>"><?= htmlspecialchars($categoria->nome) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Valor</label>
                            <input type="number" step="0.01" class="form-control" name="valor" id="produtoValor" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" name="descricao" id="produtoDescricao"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagem</label>
                            <input type="file" class="form-control" name="imagem" id="produtoImagem" accept="image/*">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <select class="form-select" name="status_produtos" id="produtoStatus" required>
                                <option value="1">Ativo</option>
                                <option value="0">Inativo</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Usuario -->
    <div class="modal fade" id="usuarioModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="formUsuario" autocomplete="off">
                    <input type="hidden" name="estabelecimento_id" value="<?= $EstabelecimentoID ?>">
                    <input type="hidden" name="acao" id="usuarioAcao" value="cadastrar_usuario">
                    <input type="hidden" name="id" id="usuarioId">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-user"></i> <span id="usuarioModalTitulo">Novo Usuário</span></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nome</label>
                            <input type="text" class="form-control" name="nome" id="usuarioNome" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">E-mail</label>
                            <input type="email" class="form-control" name="email" id="usuarioEmail" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cargo</label>
                            <select class="form-select" name="cargo" id="usuarioCargo" required>
                                <option value="">Selecione o cargo</option>
                                <?php foreach ($Cargos as $cargo): ?>
                                    <option value="<?= $cargo->id ?>"><?= htmlspecialchars($cargo->nome) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="usuarioTelefone">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">CEP</label>
                            <input type="text" class="form-control" name="cep" id="usuarioCep">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="usuarioEndereco">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" name="senha" id="usuarioSenha" placeholder="Preencha para alterar">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" name="senha2" id="usuarioSenha2" placeholder="Confirme a senha">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Categoria -->
    <div class="modal fade" id="categoriaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form method="POST" id="formCategoria">
                    <input type="hidden" name="acao" id="categoriaAcao" value="cadastrar_categoria">
                    <input type="hidden" name="id" id="categoriaId">
                    <div class="modal-header">
                        <h5 class="modal-title" id="categoriaModalTitle">Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nome da Categoria</label>
                            <input type="text" class="form-control" name="nome" id="categoriaNome" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Editar Status do Pedido -->
    <div class="modal fade" id="editarStatusPedidoModal" tabindex="-1" aria-labelledby="editarStatusPedidoLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarStatusPedido" method="POST">
                <input type="hidden" name="acao" value="editar_status_pedido">
                <input type="hidden" name="pedido_id" id="editPedidoId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarStatusPedidoLabel">Editar Status do Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editPedidoStatus" class="form-label">Status</label>
                            <select class="form-select" name="status" id="editPedidoStatus" required>
                                <option value="preparando">Preparando</option>
                                <option value="entregue">Entregue</option>
                                <option value="cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Editar Status da Venda -->
    <div class="modal fade" id="editarStatusVendaModal" tabindex="-1" aria-labelledby="editarStatusVendaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form id="formEditarStatusVenda" method="POST">
                <input type="hidden" name="acao" value="editar_status_venda">
                <input type="hidden" name="venda_id" id="editVendaId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editarStatusVendaLabel">Editar Status da Venda</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="editPedidoStatus" class="form-label">Status</label>
                            <select class="form-select" name="status" id="editVendaStatus" required>
                                <option value="Aprovado">Aprovado</option>
                                <option value="Pendente">Pendente</option>
                                <option value="Cancelado">Cancelado</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>

    <script>
        // Toggle sidebar
        const toggleBtn = document.getElementById('toggleBtn');
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');

        toggleBtn.addEventListener('click', () => {
            if (window.innerWidth <= 768) {
                sidebar.classList.toggle('show');
            } else {
                sidebar.classList.toggle('collapsed');
                mainContent.classList.toggle('expanded');
            }
        });

        // Page navigation
        const menuItems = document.querySelectorAll('.menu-item');
        const pageContents = document.querySelectorAll('.page-content');
        var estabelecimentoId = <?= json_encode($EstabelecimentoID) ?>;

        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
                // Se for o botão de logout, deixa o link funcionar normalmente
                if (
                    item.getAttribute('href') === '/empresarial/logout' ||
                    item.getAttribute('href') === ('/gerenciar/cardapio/' + estabelecimentoId)
                ) {
                    return;
                }
                e.preventDefault();

                // Remove active class from all menu items
                menuItems.forEach(mi => mi.classList.remove('active'));
                // Add active class to clicked item
                item.classList.add('active');

                // Hide all page contents
                pageContents.forEach(pc => pc.classList.remove('active'));

                // Show selected page content
                const targetPage = item.getAttribute('data-page');
                const targetContent = document.getElementById(targetPage);
                if (targetContent) {
                    targetContent.classList.add('active');
                }
            });
        });


        // Transforma o array PHP em JS
        const vendasPorMes = <?= json_encode($VendasPorMes) ?>;
        const vendasLabels = vendasPorMes.map(v => v.mes);
        const vendasData = vendasPorMes.map(v => parseFloat(v.total));

        // Initialize charts
        window.addEventListener('load', () => {
            // Sales Chart
            const salesCtx = document.getElementById('salesChart').getContext('2d');
            new Chart(salesCtx, {
                type: 'line',
                data: {
                    labels: vendasLabels,
                    datasets: [{
                        label: 'Vendas (R$)',
                        data: vendasData,
                        borderColor: '#6366f1',
                        backgroundColor: 'rgba(99, 102, 241, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            // Top Establishments Chart
            const topProdutos = <?= json_encode($TopProdutos) ?>;
            const topProdutosLabels = topProdutos.map(p => p.nome);
            const topProdutosData = topProdutos.map(p => parseInt(p.total_vendido));

            const topProdCtx = document.getElementById('topEstablishmentsChart').getContext('2d');
            new Chart(topProdCtx, {
                type: 'doughnut',
                data: {
                    labels: topProdutosLabels,
                    datasets: [{
                        data: topProdutosData,
                        backgroundColor: [
                            '#6366f1',
                            '#10b981',
                            '#f59e0b',
                            '#ef4444',
                            '#8b5cf6'
                        ],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                }
            });

            // Category Chart
            const vendasPorCategoria = <?= json_encode($VendasPorCategoria) ?>;
            const categoriaLabels = vendasPorCategoria.map(v => v.categoria);
            const categoriaData = vendasPorCategoria.map(v => parseInt(v.total));

            const categoryCtx = document.getElementById('categoryChart').getContext('2d');
            new Chart(categoryCtx, {
                type: 'bar',
                data: {
                    labels: categoriaLabels,
                    datasets: [{
                        label: 'Vendas por Categoria',
                        data: categoriaData,
                        backgroundColor: [
                            '#6366f1',
                            '#10b981',
                            '#f59e0b',
                            '#ef4444',
                            '#8b5cf6'
                        ],
                        borderRadius: 8,
                        borderSkipped: false,
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });

            const vendasPorHora = <?= json_encode($VendasPorHora) ?>;
            // Gera labels de 0h até 23h
            const horasLabels = Array.from({
                length: 24
            }, (_, i) => (i < 10 ? '0' : '') + i + 'h');
            // Preenche os dados, colocando 0 onde não houver venda
            const horasData = horasLabels.map((label, i) => {
                const found = vendasPorHora.find(v => parseInt(v.hora) === i);
                return found ? parseInt(found.total) : 0;
            });

            // Peak Hours Chart
            const peakHoursCtx = document.getElementById('peakHoursChart').getContext('2d');
            new Chart(peakHoursCtx, {
                type: 'line',
                data: {
                    labels: horasLabels,
                    datasets: [{
                        label: 'Pedidos por Hora',
                        data: horasData,
                        borderColor: '#10b981',
                        backgroundColor: 'rgba(16, 185, 129, 0.1)',
                        borderWidth: 3,
                        fill: true,
                        tension: 0.4
                    }]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: 'rgba(0,0,0,0.1)'
                            }
                        },
                        x: {
                            grid: {
                                display: false
                            }
                        }
                    }
                }
            });
        });

        // Mobile responsive
        if (window.innerWidth <= 768) {
            sidebar.classList.add('collapsed');
            mainContent.classList.add('expanded');
        }

        // Add smooth animations to cards
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('animate__animated', 'animate__fadeInUp');
                }
            });
        }, observerOptions);

        document.querySelectorAll('.stats-card, .chart-container, .data-table').forEach(el => {
            observer.observe(el);
        });

        // Editar status do pedido
        document.querySelectorAll('.btn-edit-pedido').forEach(btn => {
            btn.addEventListener('click', function() {
                const pedidoId = this.getAttribute('data-id');
                const row = this.closest('tr');
                const statusText = row.querySelector('td:nth-child(5) .status-badge').textContent.trim().toLowerCase();
                let statusValue = 'preparando';
                if (statusText === 'entregue') statusValue = 'entregue';
                else if (statusText === 'cancelado') statusValue = 'cancelado';
                document.getElementById('editPedidoId').value = pedidoId;
                document.getElementById('editPedidoStatus').value = statusValue;
                const modal = new bootstrap.Modal(document.getElementById('editarStatusPedidoModal'));
                modal.show();
            });
        });

        // Editar status da venda
        document.querySelectorAll('.btn-edit-venda').forEach(btn => {
            btn.addEventListener('click', function() {
                const vendaId = this.getAttribute('data-id');
                const row = this.closest('tr');
                // Pega o texto do status e normaliza para minúsculo
                const statusText = row.querySelector('td:nth-child(5) .status-badge').textContent.trim().toLowerCase();

                // Define o valor do select conforme o status atual
                let statusValue = 'Aprovado';
                if (statusText === 'pendente') statusValue = 'Pendente';
                else if (statusText === 'cancelado') statusValue = 'Cancelado';

                document.getElementById('editVendaId').value = vendaId;
                document.getElementById('editVendaStatus').value = statusValue;
                const modal = new bootstrap.Modal(document.getElementById('editarStatusVendaModal'));
                modal.show();
            });
        });

        // Abrir modal para NOVO produto
        document.getElementById('registerPro').addEventListener('click', function() {
            document.getElementById('produtoModalTitle').textContent = 'Novo Produto';
            document.getElementById('produtoAcao').value = 'cadastrar_produto';
            document.getElementById('produtoId').value = '';
            document.getElementById('produtoNome').value = '';
            document.getElementById('produtoCategoria').value = '';
            document.getElementById('produtoValor').value = '';
            document.getElementById('produtoDescricao').value = '';
            document.getElementById('produtoImagem').value = '';
            document.getElementById('produtoStatus').value = '1';
        });

        // Abrir modal para EDITAR produto
        document.querySelectorAll('.btn-edit-produto').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nome = this.getAttribute('data-nome');
                const categoria = this.getAttribute('data-categoria');
                const valor = this.getAttribute('data-valor');
                const descricao = this.getAttribute('data-descricao');
                const status = this.getAttribute('data-status'); // Adicione se quiser editar status

                document.getElementById('produtoModalTitle').textContent = 'Editar Produto';
                document.getElementById('produtoAcao').value = 'editar_produto';
                document.getElementById('produtoId').value = id;
                document.getElementById('produtoNome').value = nome;
                document.getElementById('produtoCategoria').value = categoria;
                document.getElementById('produtoValor').value = valor;
                document.getElementById('produtoDescricao').value = descricao;
                if (status) document.getElementById('produtoStatus').value = status;
                document.getElementById('produtoImagem').value = '';
                const modal = new bootstrap.Modal(document.getElementById('produtoModal'));
                modal.show();
            });
        });

        // Excluir produto
        document.querySelectorAll('.btn-delete-produto').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (confirm('Deseja realmente excluir este produto?')) {
                    fetch('/api/produtos/excluir', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(id)
                        })
                        .then(res => res.json())
                        .then(resp => {
                            if (resp.status === 'success') {
                                alert('Produto excluído com sucesso!');
                                location.reload();
                            } else {
                                alert('Erro ao excluir produto: ' + (resp.message || ''));
                            }
                        });
                }
            });
        });

        // Abrir modal para NOVA categoria
        document.getElementById('registerCat').addEventListener('click', function() {
            document.getElementById('categoriaModalTitle').textContent = 'Nova Categoria';
            document.getElementById('categoriaAcao').value = 'cadastrar_categoria';
            document.getElementById('categoriaId').value = '';
            document.getElementById('categoriaNome').value = '';
        });

        // Abrir modal para EDITAR categoria
        document.querySelectorAll('.btn-edit-categoria').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const nome = this.getAttribute('data-nome');
                document.getElementById('categoriaModalTitle').textContent = 'Editar Categoria';
                document.getElementById('categoriaAcao').value = 'editar_categoria';
                document.getElementById('categoriaId').value = id;
                document.getElementById('categoriaNome').value = nome;
                const modal = new bootstrap.Modal(document.getElementById('categoriaModal'));
                modal.show();
            });
        });

        // Excluir categoria
        document.querySelectorAll('.btn-delete-categoria').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                if (confirm('Deseja realmente excluir esta categoria?')) {
                    fetch('/api/categorias/excluir', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(id)
                        })
                        .then(res => res.json())
                        .then(resp => {
                            if (resp.status === 'success') {
                                alert('Categoria excluída com sucesso!');
                                location.reload();
                            } else {
                                alert('Erro ao excluir categoria: ' + (resp.message || ''));
                            }
                        });
                }
            });
        });

        // Novo usuário
        document.getElementById('btnNovoUsuario').addEventListener('click', function() {
            document.getElementById('usuarioModalTitulo').textContent = 'Novo Usuário';
            document.getElementById('usuarioAcao').value = 'cadastrar_usuario';
            document.getElementById('usuarioId').value = '';
            document.getElementById('usuarioNome').value = '';
            document.getElementById('usuarioEmail').value = '';
            document.getElementById('usuarioCargo').value = '';
            document.getElementById('usuarioTelefone').value = '';
            document.getElementById('usuarioCep').value = '';
            document.getElementById('usuarioEndereco').value = '';
            document.getElementById('usuarioSenha').value = '';
            document.getElementById('usuarioSenha2').value = '';
        });

        // Editar usuário
        document.querySelectorAll('.btn-edit-usuario').forEach(function(btn) {
            btn.addEventListener('click', function() {
                document.getElementById('usuarioModalTitulo').textContent = 'Editar Usuário';
                document.getElementById('usuarioAcao').value = 'editar_usuario';
                document.getElementById('usuarioId').value = this.dataset.id;
                document.getElementById('usuarioNome').value = this.dataset.nome;
                document.getElementById('usuarioEmail').value = this.dataset.email;
                document.getElementById('usuarioCargo').value = this.dataset.cargo;
                document.getElementById('usuarioTelefone').value = this.dataset.telefone;
                document.getElementById('usuarioCep').value = this.dataset.cep;
                document.getElementById('usuarioEndereco').value = this.dataset.endereco;
                document.getElementById('usuarioSenha').value = '';
                document.getElementById('usuarioSenha2').value = '';
                var modal = new bootstrap.Modal(document.getElementById('usuarioModal'));
                modal.show();
            });
        });

        // Excluir usuário
        document.querySelectorAll('.btn-delete-usuario').forEach(function(btn) {
            btn.addEventListener('click', function() {
                if (confirm('Deseja realmente excluir este usuário?')) {
                    var formData = new FormData();
                    formData.append('acao', 'excluir_usuario');
                    formData.append('id', this.dataset.id);
                    formData.append('estabelecimento_id', <?= json_encode($EstabelecimentoID) ?>);

                    fetch('', {
                            method: 'POST',
                            body: formData
                        })
                        .then(res => res.json())
                        .then(resp => {
                            if (resp.status === 'success') {
                                alert('Usuário excluído com sucesso!');
                                location.reload();
                            } else {
                                alert('Erro ao excluir usuário!');
                            }
                        });
                }
            });
        });

        document.getElementById('usuarioTelefone').addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);

            if (value.length > 10) {
                // Celular: (99) 99999-9999
                value = value.replace(/^(\d{2})(\d{5})(\d{4}).*/, '($1) $2-$3');
            } else if (value.length > 6) {
                // Fixo: (99) 9999-9999
                value = value.replace(/^(\d{2})(\d{4})(\d{0,4}).*/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
            } else if (value.length > 0) {
                value = value.replace(/^(\d{0,2})/, '($1');
            }
            e.target.value = value.trim();
        });

        // Validação de senha igual
        document.getElementById('formUsuario').addEventListener('submit', function(e) {
            const senha = document.getElementById('usuarioSenha').value;
            const senha2 = document.getElementById('usuarioSenha2').value;
            if (senha !== senha2) {
                alert('As senhas não conferem!');
                e.preventDefault();
            }
        });
    </script>
</body>

</html>