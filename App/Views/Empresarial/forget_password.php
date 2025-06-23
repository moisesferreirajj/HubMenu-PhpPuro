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
    function validarCodigo()
    {
        if (isset($_SESSION['codigo_inserido']) && $_SESSION['codigo_inserido'] == ($_SESSION['codigo'] ?? null)) {
            require_once __DIR__ . '/../Components/form-forgetPasswordChange.php';
            return true;
        }

        if (isset($_SESSION['codigo'], $_SESSION['codigo_expira']) && time() < $_SESSION['codigo_expira']) {
            require_once __DIR__ . '/../Components/form-forgetPasswordCode.php';
            return true;
        }

        return false;
    }

    // Verifica método e valida
    if (!isset($_SESSION['metodo_envio'])) {
        require_once __DIR__ . '/../Components/SendTypeForgetPassword.php';
        exit;
    }

    if ($_SESSION['metodo_envio'] == 'email'/* || $_SESSION['metodo_envio'] == 'sms'*/) {
        if (!validarCodigo()) {
            $form = $_SESSION['metodo_envio'] == 'email'
                ? '/../Components/form-forgetPasswordEmail.php'
                : '/../Components/form-forgetPasswordSms.php';
            require_once __DIR__ . $form;
        }
        exit;
    }
    ?>

</body>

</html>