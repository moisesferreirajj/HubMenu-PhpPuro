<?php @require_once __DIR__ . '/../global.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/login.css">

    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <title><?= $Title ?> Login</title>

</head>
<body>
    <?php require_once 'Components/form-login.php';?>
</body>
</html>