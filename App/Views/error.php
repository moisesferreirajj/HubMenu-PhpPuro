<?php @require_once __DIR__ . '/../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Views/Assets/Css/index.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> ERROR 404</title>
</head>

<body>
<?php include 'Components/navigation.php'; ?>
<main>
    <div class="slogan">
        <h1 style="text-align: center;">Página não encontrada!<br>Nossa equipe está resolvendo seu problema</h1>
        <img src="/Views/Assets/Images/motoboy.png" alt="Motoboy">
        <!--
            <?php //foreach ($users as $item): ?>
                <h2>Olá ?= ($item['nome']) ?>, sabia que gerenciar seu estabelecimento é muito fácil?</h2>
            <?php //endforeach; ?>
            -->
        <h2>ERRO 404 - Esta página não existe</h2>
        <button onclick="window.location.href='/'" class="btn btn-success">Voltar para a página inicial</button>
        <br>
    </div>

</main>
<?php include 'Components/footer.php'; ?>
</body>
</html>