<?php @require_once __DIR__ . '/../../global.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/admin-dashboard.css">
    <title><?= $Title ?> Administração</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
</head>

<body>
    <!-- Mobile Navbar (visível apenas em mobile) -->
    <nav class="mobile-navbar d-md-none">
        <div class="mobile-navbar-header">
            <h5 class="mb-0"><i class="fas fa-chart-line me-2"></i>HubMenu</h5>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <!-- Menu dropdown mobile -->
        <div class="mobile-menu" id="mobileMenu">
            <a href="#" class="mobile-nav-link active">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="/admin/estabelecimentos" class="mobile-nav-link">
                <i class="fas fa-store"></i>
                <span>Estabelecimentos</span>
            </a>
            <a href="/admin/pedidos" class="mobile-nav-link">
                <i class="fas fa-shopping-cart"></i>
                <span>Pedidos</span>
            </a>
            <a href="/admin/vendas" class="mobile-nav-link">
                <i class="fas fa-chart-bar"></i>
                <span>Vendas</span>
            </a>
            <a href="/admin/usuarios" class="mobile-nav-link">
                <i class="fas fa-users"></i>
                <span>Usuários</span>
            </a>
            <div class="mobile-user-section">
                <span class="mobile-user-name">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</span>
                <button class="btn btn-outline-danger btn-sm mt-2">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </button>
            </div>
        </div>
    </nav>

    <!-- Desktop Sidebar (oculto em mobile) -->
    <div class="sidebar d-none d-md-block" id="sidebar">
        <div class="sidebar-header">
            <h4><i class="fas fa-chart-line me-2"></i>HubMenu</h4>
        </div>
        <nav class="sidebar-nav">
            <a href="#" class="nav-link active" data-tooltip="Dashboard">
                <i class="fas fa-tachometer-alt"></i>
                <span>Dashboard</span>
            </a>
            <a href="/admin/estabelecimentos" class="nav-link" data-tooltip="Estabelecimentos">
                <i class="fas fa-store"></i>
                <span>Estabelecimentos</span>
            </a>
            <a href="/admin/pedidos" class="nav-link" data-tooltip="Pedidos">
                <i class="fas fa-shopping-cart"></i>
                <span>Pedidos</span>
            </a>
            <a href="/admin/vendas" class="nav-link" data-tooltip="Vendas">
                <i class="fas fa-chart-bar"></i>
                <span>Vendas</span>
            </a>
            <a href="/admin/usuarios" class="nav-link" data-tooltip="Usuários">
                <i class="fas fa-users"></i>
                <span>Usuários</span>
            </a>
        </nav>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Desktop Topbar (oculto em mobile) -->
        <div class="topbar d-none d-md-flex">
            <button class="btn-toggle" id="btnToggle">
                <i class="fas fa-bars"></i>
            </button>
            <div class="topbar-right">
                <span class="me-3">Bem-vindo, <?= htmlspecialchars($_SESSION['usuario_nome']) ?>!</span>
                <button class="btn btn-outline-danger btn-sm">
                    <i class="fas fa-sign-out-alt"></i> Sair
                </button>
            </div>
        </div>

        <!-- Dashboard Content -->
        <div class="container-fluid p-4">
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card stat-card stat-primary">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total de Vendas</h6>
                                    <h3 class="mb-0">R$<?= $totalVendas ?? '0,00' ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card stat-card stat-success">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Estabelecimentos</h6>
                                    <h3 class="mb-0"><?= $totalEstabelecimentos ?? 0 ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-store"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card stat-card stat-warning">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Total de Pedidos</h6>
                                    <h3 class="mb-0"><?= $totalPedidos ?? 0 ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-3">
                    <div class="card stat-card stat-info">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h6 class="card-title">Pedidos Hoje</h6>
                                    <h3 class="mb-0"><?= $pedidosHoje ?? 0 ?></h3>
                                </div>
                                <div class="stat-icon">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Charts Row -->
            <div class="row mb-4">
                <div class="col-lg-8 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-area me-2"></i>Vendas dos Últimos 7 Dias
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="salesChart" height="325"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Orders Chart -->
                <div class="col-lg-4 mb-3">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-chart-pie me-2"></i>Status dos Pedidos
                            </h5>
                        </div>
                        <div class="card-body">
                            <canvas id="ordersChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Recent Orders Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-list me-2"></i> Pedidos Recentes
                            </h5>
                            <button class="btn btn-primary btn-sm">Ver Todos</button>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover mb-0">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Estabelecimento</th>
                                            <th class="d-none d-md-table-cell">Endereço</th>
                                            <th>Avaliação</th>
                                            <th class="d-none d-lg-table-cell">Tipo</th>
                                            <th class="d-none d-lg-table-cell">Imagem</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php if (!empty($estabelecimentosNovos) && is_array($estabelecimentosNovos->results)): ?>
                                        <?php foreach ($estabelecimentosNovos->results as $estab): ?>
                                            <?php if (!is_object($estab)) continue; ?>
                                            <tr>
                                                <td>#<?= htmlspecialchars($estab->id) ?></td>
                                                <td><?= htmlspecialchars($estab->nome) ?></td>
                                                <td class="d-none d-md-table-cell"><?= htmlspecialchars($estab->endereco ?? '—') ?></td>
                                                <td><?= number_format($estab->media_avaliacao ?? 0, 2, ',', '.') ?> ★</td>
                                                <td class="d-none d-lg-table-cell"><?= htmlspecialchars($estab->tipo ?? '—') ?></td>
                                                <td class="d-none d-lg-table-cell">
                                                    <?php if (!empty($estab->imagem)): ?>
                                                        <img src="<?= htmlspecialchars($estab->imagem) ?>" alt="Imagem de <?= htmlspecialchars($estab->nome) ?>" style="width: 50px; height: auto; border-radius: 4px;">
                                                    <?php else: ?>
                                                        <span class="text-muted">Sem imagem</span>
                                                    <?php endif; ?>
                                                </td>
                                                <td>
                                                    <a href="/admin/estabelecimentos/<?= htmlspecialchars($estab->id) ?>" class="btn btn-sm btn-outline-primary" title="Ver detalhes">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr><td colspan="7" class="text-center text-muted">Nenhum estabelecimento encontrado.</td></tr>
                                    <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="/Views/Assets/Js/Admin/Chart.js"></script>
    <script>
        // Script para controle da sidebar desktop
        document.addEventListener('DOMContentLoaded', function() {
            const btnToggle = document.getElementById('btnToggle');
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.querySelector('.main-content');

            if (btnToggle && sidebar) {
                btnToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');
                });
            }

            // Script para controle do menu mobile
            const mobileMenuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');

            if (mobileMenuToggle && mobileMenu) {
                mobileMenuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('show');
                    mobileMenuToggle.querySelector('i').classList.toggle('fa-bars');
                    mobileMenuToggle.querySelector('i').classList.toggle('fa-times');
                });

                // Fechar menu ao clicar em um link
                const mobileNavLinks = document.querySelectorAll('.mobile-nav-link');
                mobileNavLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('show');
                        mobileMenuToggle.querySelector('i').classList.add('fa-bars');
                        mobileMenuToggle.querySelector('i').classList.remove('fa-times');
                    });
                });

                // Fechar menu ao clicar fora
                document.addEventListener('click', function(e) {
                    if (!mobileMenuToggle.contains(e.target) && !mobileMenu.contains(e.target)) {
                        mobileMenu.classList.remove('show');
                        mobileMenuToggle.querySelector('i').classList.add('fa-bars');
                        mobileMenuToggle.querySelector('i').classList.remove('fa-times');
                    }
                });
            }
        });
    </script>
</body>
</html>