<?php @require_once __DIR__ . '/../../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Views/Assets/Css/sobre.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <title><?= $Title ?> Sobre</title>
</head>

<body>
    <?php include '../Components/navigation.php'; ?>
    <!-- SECTION DE BOAS VINDAS -->
    <section class="hero-section text-center">
        <div class="container">
            <h1 class="display-4 fw-bold">Bem-vindo ao HubMenu!</h1>
            <p class="lead">Transformando a experiência gastronômica com tecnologia inteligente</p>
        </div>
    </section>

    <!-- Visão Section -->
    <section class="section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1">
                    <h2 class="section-title">Nossa Visão</h2>
                    <p class="section-text">Nosso objetivo é auxiliar na produtividade e agilidade de comércios e redes de restaurantes. Nosso produto conta com cardápios online personalizados, tanto para entrega quanto para consumo local, proporcionando uma experiência única para seus clientes e otimizando seu negócio.</p>
                </div>
                <div class="col-md-6 order-md-2 text-end image-sobre">
                    <img src="/Views/Assets/Images/Sobre/Visao.png" class="section-img img-fluid" alt="Visão do HubMenu">
                </div>
            </div>
        </div>
    </section>

    <!-- Missão Section -->
    <section class="section bg-light-green">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 image-sobre">

                    <img src="/Views/Assets/Images/Fundo.jpg" class="section-img img-fluid" alt="Missão do HubMenu">

                </div>
                <div class="col-md-6">
                    <h2 class="section-title">Nossa Missão</h2>
                    <p class="section-text">Queremos revolucionar a maneira como restaurantes gerenciam seus cardápios e pedidos, tornando todo o processo mais eficiente e intuitivo. Buscamos ser a principal ferramenta para estabelecimentos que desejam inovar e melhorar sua gestão.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Nossa Equipe Section -->
    <section class="section">
        <div class="container">
            <h2 class="section-title text-center mb-5">Nossa Equipe</h2>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                <div class="col team-card-div">
                    <div class="card team-card">

                        <img src="/Views/Assets/Images/Sobre/MoisesCaptura.jpg" class="card-img-top team-member-img" alt="Moises Ferreira">

                        <div class="card-body text-center">
                            <h5 class="team-member-name">Moises Ferreira</h5>
                            <p class="team-member-role">CEO & Back-End Engineer</p>
                        </div>
                    </div>
                </div>
                <div class="col team-card-div">
                    <div class="card team-card">

                        <img src="/Views/Assets/Images/Sobre/Yohan.jpg" class="card-img-top team-member-img" alt="Yohan Siedschlag">

                        <div class="card-body text-center">
                            <h5 class="team-member-name">Yohan Siedschlag</h5>
                            <p class="team-member-role">COO & Front-End Engineer</p>
                        </div>
                    </div>
                </div>
                <div class="col team-card-div">
                    <div class="card team-card">
                        <img src="/Views/Assets/Images/Sobre/Igor.png" class="card-img-top team-member-img" alt="Igor Dias">
                        <div class="card-body text-center">
                            <h5 class="team-member-name">Igor Dias</h5>
                            <p class="team-member-role">CTO & Front-End Engineer</p>
                        </div>
                    </div>
                </div>
                <div class="col team-card-div">
                    <div class="card team-card">
                        <img src="/Views/Assets/Images/Sobre/Mark.jpg" class="card-img-top team-member-img" alt="Mark Stolfi">
                        <div class="card-body text-center">
                            <h5 class="team-member-name">Mark Stolfi</h5>
                            <p class="team-member-role">Full-Stack Engineer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Valores Section -->
    <section class="section bg-light-green section-valores">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-md-1">
                    <h2 class="section-title">Nossos Valores</h2>
                    <ul class="section-text">
                        <li><strong>Inovação:</strong> Buscamos constantemente novas soluções para o setor gastronômico.</li>
                        <li><strong>Qualidade:</strong> Comprometimento com a excelência em nossos produtos e serviços.</li>
                        <li><strong>Cliente em primeiro lugar:</strong> O sucesso dos nossos clientes é nossa prioridade.</li>
                        <li><strong>Sustentabilidade:</strong> Promovemos práticas responsáveis que beneficiam o planeta.</li>
                    </ul>
                </div>
                <div id="image-valores" class="col-md-6 order-md-2 mt-4 mt-md-0 text-end">

                    <img src="https://doubleconsult.com/images/2021/10/27/felicidade-no-trabalho.jpg" class="section-img img-fluid" alt="Valores do HubMenu">
                </div>
            </div>
        </div>
    </section>

    <!-- Fale Conosco -->
    <section class="section text-center fale-conosco">
        <div class="container">
            <h2 class="text-center mb-4" style="color: var(--primary);">Pronto para transformar seu restaurante?</h2>
            <p class="mb-5 p-fale-conosco">Entre em contato conosco e descubra como o HubMenu pode alavancar seu negócio</p>
            <a href="./suporte.php">
                <button class="btn btn-success btn-lg">Fale Conosco</button>
            </a>
        </div>
    </section>
    <?php include '../Components/footer.php'; ?>
</body>

</html>