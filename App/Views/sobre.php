<?php require '../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../Assets/CSS/sobre.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link type="text/css" rel="stylesheet" href="../Assets/Css/bootstrap.min.css">
    <script href="../Assets/Css/bootstrap.min.js"></script>
    <title><?= $Title ?> Sobre Nós</title>
</head>

<body>
    <?php include 'Components/navigation.php'; ?>
    <main>
        <div class="Visao">

            <div id="infoVisao">
                <h2>Visão</h2>

                <h3>Nosso objetivo é auxiliar na produtividade e agilidade de comercios e redes de restaurantes nosso produto conta com cardápios online personalizados, tanto para entrega quanto para local
                </h3>
            </div>

            <div id="imgVisao">
                <img src="https://www.imagelato.com/images/article-image-restaurant-manager-directing-service-799eb0d9.jpg">
            </div>

        </div>

        <div class="NossaEquipe">

            <div id="infoEquipe">
                <h2>Nossa equipe</h2>

                <h3>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                </h3>
            </div>

            <div id="imgEquipe">
                <img src="https://doubleconsult.com/images/2021/10/27/felicidade-no-trabalho.jpg">
            </div>

        </div>
    </main>
    <?php include_once 'Components/footer.php'; ?>
</body>

</html>