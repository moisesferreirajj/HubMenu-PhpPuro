<?php
    $actual_page = basename($_SERVER['PHP_SELF']);
?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <div class="sidebar" id="sidebar">
            <div class="wrap-btn">
                <span class="empresa">            
                    <?php require_once 'svg-logo.php'; ?>
                </span>
                <button onclick="closeNav()" class="close-btn" >
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"  fill="#0e7a56">
                        <path id="arrow-path" d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z" fill="currentColor"/>
                    </svg>
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

