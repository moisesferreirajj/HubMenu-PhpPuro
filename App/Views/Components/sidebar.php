<?php
    $actual_page = basename($_SERVER['PHP_SELF']);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">


    <div class="sidebar" id="sidebar">
            <div class="wrap-btn">
                <span class="empresa">            
                    <?php require_once 'svg-logo.php'; ?>
                </span>
                    <button onclick="closeNav()" class="close-btn">
                    <i class="bi bi-x" style="font-size: 24px; color: #0e7a56;"></i>
                    </button>

            </div>
                <a class="side-item" href="dashboard.php" <?php if ($actual_page == '/dashboard') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-house"></i>
                    <span class="link-name">Dashboard</span>
                </a>
                <a class="side-item" href="pedidos.php" <?php if ($actual_page == '/pedidos') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span class="link-name">Pedidos</span>
                </a>
                <a class="side-item" href="cardapioCliente.php" <?php if ($actual_page == '/gerenciar/cardapio') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-utensils"></i>
                    <span class="link-name">Cardápio</span>
                </a>
                <a class="side-item" href="clientes.php" <?php if ($actual_page == '/clientes') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-user"></i>
                    <span class="link-name">Clientes</span>
                </a>
                <a class="side-item" href="relatorios.php" <?php if ($actual_page == '/relatorios') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-chart-column"></i>
                    <span class="link-name">Relatórios</span>
                </a>
                <a id="some" class="side-item" href="configuracoes.php" <?php if ($actual_page == 'configuracoes') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-gear"></i>
                    <span class="link-name">Configurações</span>
                </a>
            <div class="opt">
                <a class="side-item end-opt" href="configuracoes.php" <?php if ($actual_page == 'configuracoes') echo 'id="active"'; ?>>
                    <i class="fa-solid fa-gear"></i>
                    <span class="link-name">Configurações</span>
                </a>
            </div>
    </div>

