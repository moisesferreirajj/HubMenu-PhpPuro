<?php require '../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../Assets/Css/pedidosCliente.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="../Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="../Assets/Vendor/bootstrap.min.css">
    <script href="../Assets/Vendor/bootstrap.min.js"></script>
    <script src="../Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> Pedidos</title>
<body>
    
    <div class="order-container">
        <div class="pending">Tem q fazer</div>
        <div class="in-progress">ta fazendo</div>
        <div class="done">só levar</div>
    </div>
    
    <script src="../Assets/Js/FooterLayout.js"></script>
    <footer-layout></footer-layout>
</body>
</html>