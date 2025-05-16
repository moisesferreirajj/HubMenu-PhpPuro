<?php @require_once __DIR__ . '/../../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" type="text/css" href="/views/assets/css/error.css">

    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> ERROR 404</title>

</head>

<body>
    <main>
        <div class="main-content">
            <div class="error-text">
                <h1 class="ltit texto">404</h1>
                <h2 class="sub texto">Página não encontrada</h2>
                <p class="desc texto">Desculpe, página perdida! Pegue um espresso e volte para o início.</p>
                <button class="btn-back" onclick="window.location.href='/'">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12h-15m0 0l6.75-6.75M4.5 12l6.75 6.75" />
                    </svg>
                    <span class="btn-txt">Voltar ao início</span>
                </button>
            </div>
            <div class="error_img">
                <img src="/Views/Assets/images/error.avif" alt="404" class="img-fluid">
            </div>
        </div>
    </main>
    <footer>
        <p>HubMenu &copy; 2024. Todos os direitos reservados.</p>
    </footer>

</body>

</html>