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
            background: linear-gradient(45deg, var(--primary-color), var(--accent-color));
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
            background: linear-gradient(45deg, var(--primary-color), #8b5cf6);
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
            <a href="#" class="menu-item" data-page="produtos">
                <i class="fas fa-box"></i> Produtos
            </a>
            <a href="#" class="menu-item" data-page="pedidos">
                <i class="fas fa-shopping-cart"></i> Pedidos
            </a>
            <a href="#" class="menu-item" data-page="categorias">
                <i class="fas fa-tags"></i> Categorias
            </a>
            <a href="#" class="menu-item" data-page="usuarios">
                <i class="fas fa-users"></i> Usuários
            </a>
            <a href="#" class="menu-item" data-page="vendas">
                <i class="fas fa-chart-line"></i> Vendas
            </a>
            <a href="#" class="menu-item" data-page="avaliacoes">
                <i class="fas fa-star"></i> Avaliações
            </a>
            <a href="#" class="menu-item" data-page="relatorios">
                <i class="fas fa-file-alt"></i> Relatórios
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
                <h2 class="page-title">Dashboard Geral</h2>
                <!-- Stats Cards -->
                <div class="row mb-4">
                    <div class="col-md-3 mb-3">
                        <div class="stats-card primary animate__animated animate__fadeInUp">
                            <div class="icon"><i class="fas fa-store"></i></div>
                            <h3>R$ <?= number_format(array_sum(array_map(fn($v) => $v->valor_total, $Vendas)), 2, ',', '.') ?? '0' ?></h3>
                            <p>Total Vendas</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card success animate__animated animate__fadeInUp" style="animation-delay: 0.1s;">
                            <div class="icon"><i class="fas fa-box"></i></div>
                            <h3><?= count($Produtos) ?? '0' ?></h3>
                            <p>Produtos</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card warning animate__animated animate__fadeInUp" style="animation-delay: 0.2s;">
                            <div class="icon"><i class="fas fa-shopping-cart"></i></div>
                            <h3><?= count($Pedidos) ?? '0' ?></h3>
                            <p>Pedidos</p>
                        </div>
                    </div>
                    <div class="col-md-3 mb-3">
                        <div class="stats-card danger animate__animated animate__fadeInUp" style="animation-delay: 0.3s;">
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
                                        <th>Estabelecimento</th>
                                        <th>Valor</th>
                                        <th>Data</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($PedidosRecentes as $pedidorecente): ?>
                                        <tr>
                                            <td><?= htmlspecialchars($pedidorecente->id) ?></td>
                                            <td><?= htmlspecialchars($pedidorecente->cliente_nome) ?></td>
                                            <td><?= htmlspecialchars($pedidorecente->estabelecimento_nome) ?></td>
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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#produtoModal">
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
                                    <td><?= htmlspecialchars($produto->valor) ?></td>
                                    <td>
                                        <?php if ($produto->status_produtos == 1): ?>
                                            <span class="status-badge status-approved">Ativo</span>
                                        <?php else: ?>
                                            <span class="status-badge status-cancelled">Inativo</span>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <button class="btn-action btn-view" data-id="<?= $produto->id ?>"><i class="fas fa-eye"></i></button>
                                        <button class="btn-action btn-edit" data-id="<?= $produto->id ?>"><i class="fas fa-edit"></i></button>
                                        <button class="btn-action btn-delete" data-id="<?= $produto->id ?>"><i class="fas fa-trash"></i></button>
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
                                <th>Avaliação</th>
                                <th>Data</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($Pedidos as $pedido): ?>
                                <tr>
                                    <td><?= htmlspecialchars($pedido->id) ?></td>
                                    <td><?= ucwords(htmlspecialchars($pedido->nome)) ?></td>
                                    <td><?= htmlspecialchars($pedido->valor_total) ?></td>
                                    <td><?= htmlspecialchars($pedido->observacao) ?></td>
                                    <td><?= number_format($pedido->avaliacao, 1, '.', ',') ?></td>
                                    <td><?= date('d/m/Y', strtotime($pedido->data_pedido)) ?></td>
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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#categoriaModal">
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
                                        <button class="btn-action btn-edit-categoria" data-id="<?= $categoria->id ?>" data-nome="<?= htmlspecialchars($categoria->nome) ?>"><i class="fas fa-edit"></i></button>

                                        <button class="btn-action btn-delete-categoria" data-id="<?= $categoria->id ?>"><i class="fas fa-trash"></i></button>
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
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#usuarioModal">
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
                                    <td><?= ucwords(htmlspecialchars($usuario->nome)) ?></td>
                                    <td><?= htmlspecialchars($usuario->email) ?></td>
                                    <td><?= htmlspecialchars($usuario->cargo_nome) ?></td>
                                    <td><?= htmlspecialchars($usuario->telefone) ?></td>
                                    <td>
                                        <button class="btn-action btn-view" data-id="<?= $produto->id ?>"><i class="fas fa-eye"></i></button>
                                        <button class="btn-action btn-edit" data-id="<?= $produto->id ?>"><i class="fas fa-edit"></i></button>
                                        <button class="btn-action btn-delete" data-id="<?= $produto->id ?>"><i class="fas fa-trash"></i></button>
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
                                    <td><?= number_format(htmlspecialchars($venda->valor_total), 2, '.', ',') ?></td>
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
                                        <button class="btn-action btn-edit"><i class="fas fa-edit"></i> Status</button>
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
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-box"></i> Novo Produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Nome do Produto</label>
                                    <input type="text" class="form-control" placeholder="Digite o nome do produto">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Categoria</label>
                                    <select class="form-select">
                                        <option>Selecione a categoria</option>
                                        <option>Pizzas</option>
                                        <option>Carnes</option>
                                        <option>Bebidas</option>
                                        <option>Sobremesas</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Estabelecimento</label>
                                    <select class="form-select">
                                        <option>Selecione o estabelecimento</option>
                                        <option>Pizzaria Saborosa</option>
                                        <option>Churrascaria Boi na Brasa</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Valor</label>
                                    <input type="number" class="form-control" placeholder="0,00" step="0.01">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Descrição</label>
                            <textarea class="form-control" rows="3" placeholder="Descreva o produto"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Imagem do Produto</label>
                            <input type="file" class="form-control" accept="image/*">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar Produto</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Usuário -->
    <div class="modal fade" id="usuarioModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-user"></i> Novo Usuário</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" placeholder="Digite o nome completo">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" placeholder="email@exemplo.com">
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Cargo</label>
                                    <select class="form-select">
                                        <option>Selecione o cargo</option>
                                        <option>Administrador</option>
                                        <option>Gerente</option>
                                        <option>Funcionário</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" placeholder="(47) 99999-9999">
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Senha</label>
                            <input type="password" class="form-control" placeholder="Digite a senha">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Confirmar Senha</label>
                            <input type="password" class="form-control" placeholder="Confirme a senha">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary">Salvar Usuário</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Categoria -->
    <div class="modal fade" id="categoriaModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="formCategoria">
                    <div class="modal-header">
                        <h5 class="modal-title"><i class="fas fa-tags"></i> Categoria</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="categoriaId" name="id">
                        <div class="mb-3">
                            <label class="form-label">Nome da Categoria</label>
                            <input type="text" class="form-control" id="categoriaNome" name="nome" required>
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

        menuItems.forEach(item => {
            item.addEventListener('click', (e) => {
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

        // Visualizar produto
        document.querySelectorAll('.btn-view').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/api/visualizar/produtos/${id}`)
                    .then(res => res.json())
                    .then(produto => {
                        alert('Produto: ' + produto.nome + '\nValor: R$ ' + produto.valor);
                        // Aqui você pode abrir um modal e preencher os campos
                    });
            });
        });

        // Editar produto (exemplo: abrir modal para edição)
        document.querySelectorAll('.btn-edit').forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                fetch(`/api/visualizar/produtos/${id}`)
                    .then(res => res.json())
                    .then(produto => {
                        // Preencha o modal de edição com os dados do produto
                        // Exemplo: document.getElementById('edit-nome').value = produto.nome;
                        alert('Abrir modal de edição para: ' + produto.nome);
                    });
            });
        });

        // Excluir produto
        document.querySelectorAll('.btn-delete').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Deseja realmente excluir este produto?')) {
                    const id = this.getAttribute('data-id');
                    fetch('/api/produtos/excluir', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/x-www-form-urlencoded'
                            },
                            body: 'id=' + encodeURIComponent(id)
                        })
                        .then(res => res.json())
                        .then(resp => {
                            if (resp.success) {
                                alert('Produto excluído com sucesso!');
                                location.reload();
                            } else {
                                alert('Erro ao excluir produto: ' + (resp.error || ''));
                            }
                        });
                }
            });
        });
    </script>
</body>

</html>