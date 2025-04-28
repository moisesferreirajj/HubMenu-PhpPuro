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
    <title><?= $Title ?> Início</title>
    </head>

<body>
    <?php include 'Components/navigation.php'; ?>
    <main>
        <div class="slogan">
<<<<<<< HEAD
            <div id="div-chamativa">
                <img class="entregador" src="/Views/Assets/Images/entregador.png" alt="Entregador">
                <img class="motoboy2" src="/Views/Assets/Images/motoboy.png" alt="Motoboy">
                <img class="motoboy1" src="/Views/Assets/Images/motoboy2.png" alt="Motoboy 2">
            </div>
            
=======
            <img src="/Views/Assets/Images/motoboy.png" alt="Motoboy">
>>>>>>> 7ee9314e10cef458a90e37326d60b970e9ec962c
            <!--
            ?php //foreach ($users as $item): ?>
                <h2>Olá ?= ($item['nome']) ?>, sabia que gerenciar seu estabelecimento é muito fácil?</h2>
            ?php //endforeach; ?>
            -->
            <h2>Sabia que gerenciar seu estabelecimento é muito fácil?</h2>
        </div>
        <div class="funcs">
            <div class="element eleone">
                <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="#006747" stroke="#006747">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <style type="text/css">
                            .st0 {
                                fill: none;
                                stroke: #006747;
                                stroke-width: 2;
                                stroke-linecap: round;
                                stroke-linejoin: round;
                                stroke-miterlimit: 10;
                            }
                        </style>
                        <path d="M29,9h-7c-1.7,0-3,1.3-3,3v15c0,1.7,1.3,3,3,3h7c1.7,0,3-1.3,3-3V12C32,10.3,30.7,9,29,9z M27,27h-3c-0.6,0-1-0.4-1-1 s0.4-1,1-1h3c0.6,0,1,0.4,1,1S27.6,27,27,27z M30,22h-9V12c0-0.6,0.4-1,1-1h7c0.6,0,1,0.4,1,1V22z"></path>
                        <path d="M17,27v-5H2V5c0-0.6,0.4-1,1-1h18c0.6,0,1,0.4,1,1v2h2V5c0-1.7-1.3-3-3-3H3C1.3,2,0,3.3,0,5v22c0,1.7,1.3,3,3,3h15 C17.4,29.2,17,28.1,17,27z M13,27h-2c-0.6,0-1-0.4-1-1s0.4-1,1-1h2c0.6,0,1,0.4,1,1S13.6,27,13,27z"></path>
                    </g>
                </svg>
                <h4>Gestão Digital</h4>
                <p>
                    Controle seu estabelecimento de qualquer lugar através do nosso aplicativo móvel e plataforma desktop. Gerencie pedidos, estoque e funcionários em tempo real com uma interface intuitiva que facilita o dia a dia da sua operação.
                </p>
            </div>

            <div class="element">
            <svg viewBox="0 0 1024 1024" xmlns="http://www.w3.org/2000/svg" fill="#006747" stroke="#006747" preserveAspectRatio="xMidYMid meet">
                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                <g id="SVGRepo_iconCarrier">
                    <path d="M749.7 585.3l-164.6 91.4v182.9L749.7 951l164.6-91.4V676.7l-164.6-91.4z m91.4 231.2l-91.4 50.8-91.4-50.8v-96.8l91.4-50.8 91.4 50.8v96.8z" fill="#006747"></path>
                    <path d="M735.667582 801.904773a36.6 36.6 0 1 0 28.012427-67.627982 36.6 36.6 0 1 0-28.012427 67.627982Z" fill="#006747"></path>
                    <path d="M219.4 731.4H256v-73.1h-36.6V365.7H256v-73.1h-36.6V146.3h585v402.4h73.2V73.1H146.3v219.5h-36.6v73.1h36.6v292.6h-36.6v73.1h36.6v219.5h399.8v-73.2H219.4z" fill="#006747"></path>
                    <path d="M329.2 256h402.3v73.1H329.2zM329.2 438.9h402.3V512H329.2zM329.2 621.7h182.9v73.1H329.2z" fill="#006747"></path>
                </g>
            </svg>

                <h4>Controle de Pedidos</h4>
                <p>
                    Organize todas as comandas com eficiência e precisão. Nosso sistema permite visualizar pedidos pendentes, em preparo e finalizados, reduzindo erros e agilizando o atendimento para maior satisfação dos seus clientes.
                </p>
            </div>

            <div class="element">
                <svg viewBox="-0.5 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                    <g id="SVGRepo_iconCarrier">
                        <path d="M0.75 14.254V23.254" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M0.75 15.754H6C6.79565 15.754 7.55871 16.0701 8.12132 16.6327C8.68393 17.1953 9 17.9584 9 18.754H12.75C13.5456 18.754 14.3087 19.0701 14.8713 19.6327C15.4339 20.1953 15.75 20.9584 15.75 21.754H0.75" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M6 18.754H9" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M2.25 11.254H23.25" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M12.75 0.754028V2.25403" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M21.75 11.254C21.75 8.86708 20.8018 6.57789 19.114 4.89007C17.4261 3.20224 15.1369 2.25403 12.75 2.25403C10.3631 2.25403 8.07387 3.20224 6.38604 4.89007C4.69821 6.57789 3.75 8.86708 3.75 11.254" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        <path d="M11.25 14.254H18.4C18.956 14.2536 19.5009 14.0988 19.9739 13.8067C20.447 13.5147 20.8296 13.0969 21.079 12.6L21.7115 11.3314" stroke="#006747" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    </g>
                </svg>
                <h4>Experiência do Cliente</h4>
                <p>
                    Proporcione um atendimento impecável com nossa solução de gerenciamento de comandas. Acompanhe o status dos pratos, tempo de espera e preferências dos clientes para criar experiências memoráveis que os farão voltar.
                </p>
            </div>

        </div>

        <section class="hero-section text-center">
            <div class="container">
                <h1>Veja abaixo alguns estabelecimentos perto de você que contam com nosso sistema:</h1>
            </div>
        </section>

    </main>
    <?php include 'Components/footer.php'; ?>
</body>
</html>