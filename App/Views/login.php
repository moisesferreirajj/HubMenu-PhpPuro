<?php require '../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../Assets/CSS/login.css">
    <link type="text/css" rel="stylesheet" href="../Assets/CSS/Components/forms.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="../Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="../Assets/Vendor/bootstrap.min.css">
    <script href="../Assets/Vendor/bootstrap.min.js"></script>
    <script src="../Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> Acesso ao Painel</title>
</head>

<body>
    <?php include_once 'Components/form-login.php'; ?>
</body>
</html>