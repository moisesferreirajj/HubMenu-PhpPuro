<?php
    $actual_page = basename($_SERVER['PHP_SELF']);
    $estabelecimentoId = $_SESSION['estabelecimento_id'] ?? null;
?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

<div class="sidebar" id="sidebar">
    <div class="wrap-btn">
        <span class="empresa">
            <?php require_once 'svg-logo.php'; ?>
        </span>
        <button onclick="closeNav()" class="close-btn">
            <i class="fa-solid fa-times" style="font-size: 24px; color: #0e7a56;"></i>
        </button>
    </div>
    <a class="side-item <?= $actual_page == 'dashboard.php' ? 'active' : '' ?>" href="/empresarial/dashboard/<?= $estabelecimentoId ?>">
        <i class="fa-solid fa-house"></i>
        <span class="link-name">Inicio</span>
    </a>
    <a class="side-item <?= $actual_page == 'pedidos.php' ? 'active' : '' ?>" href="/empresarial/dashboard/<?= $estabelecimentoId ?>">
        <i class="fa-solid fa-bag-shopping"></i>
        <span class="link-name">Pedidos</span>
    </a>
    <a class="side-item <?= $actual_page == 'cardapio.php' ? 'active' : '' ?>" href="/gerenciar/cardapio/<?= $estabelecimentoId ?>">
        <i class="fa-solid fa-utensils"></i>
        <span class="link-name">Cardápio</span>
    </a>
    <a class="side-item <?= $actual_page == 'relatorios.php' ? 'active' : '' ?>" href="/empresarial/dashboard/<?= $estabelecimentoId ?>">
        <i class="fa-solid fa-chart-column"></i>
        <span class="link-name">Relatórios</span>
    </a>
    <a class="side-item <?= $actual_page == 'lixeira.php' ? 'active' : '' ?>" href="/gerenciar/lixeira/<?= $estabelecimentoId ?>">
        <i class="fa-solid fa-trash"></i>
        <span class="link-name">Lixeira</span>
    </a>
    <a class="side-item <?= $actual_page == 'estabelecimento.php' ? 'active' : '' ?>" href="/gerenciar/estabelecimento/<?= $estabelecimentoId ?>">
        <i class="fa-solid fa-gear"></i>
        <span class="link-name">Configurações</span>
    </a>
</div>