<?php @require_once __DIR__ . '/../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/pedidosCliente.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> Pedidos</title>
<body>
    
    <div class="order-container">
        <div class="pending">Tem q fazer</div>
        <div class="in-progress">ta fazendo</div>
        <div class="done">só levar</div>
    </div>
    
    <script src="/Views/Assets/Js/FooterLayout.js"></script>
    <footer-layout></footer-layout>
</body>
</html>