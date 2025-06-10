<?php

@require_once __DIR__ . '/../../global.php';

session_start();

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/forgetpassword.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <title><?= $Title ?> Esqueceu Senha</title>

</head>

<body>

    <?php
    if (!isset($_SESSION['metodo_envio'])) {
        require_once __DIR__ . '/../Components/SendTypeForgetPassword.php';
        exit;
    }

    if ($_SESSION['metodo_envio'] == 'email') {

        // 1. Se já validou o código, mostra a tela de trocar senha, independente do tempo
        if (isset($_SESSION['codigo_inserido']) && $_SESSION['codigo_inserido'] == ($_SESSION['codigo'] ?? null)) {
            require_once __DIR__ . '/../Components/form-forgetPasswordChange.php';
            exit;
        }
        // 2. Se o código ainda está válido, mostra a tela de inserir código
        if (isset($_SESSION['codigo'], $_SESSION['codigo_expira']) && time() < $_SESSION['codigo_expira']) {
            require_once __DIR__ . '/../Components/form-forgetPasswordCode.php';
            exit;
        }
        // 3. Senão, volta para o email
        require_once __DIR__ . '/../Components/form-forgetPasswordEmail.php';
        exit;
    } else {
        require_once __DIR__ . '/../Components/form-forgetPasswordSMS.php';
        exit;
    }
    ?>

</body>

</html>