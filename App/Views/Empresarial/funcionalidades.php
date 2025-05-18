<?php
// Arquivo: funcionalidades.php
// Página de Funcionalidades para sistema de cardápios online e digitais
@require_once __DIR__ . '/../../global.php';

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?> Funcionalidades</title>
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <!-- Font Awesome para ícones -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- CSS Personalizado -->
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/funcionalidades.css">
</head>
<body>
    <!-- O componente Nav será incluído aqui -->
    <?php include_once __DIR__ . '/../Components/navigation.php'; ?>

    <!-- Hero Section -->
    <section class="hero">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h1 class="display-4 fw-bold mb-4">Funcionalidades do MenuDigital</h1>
                    <p class="lead mb-4">Descubra como nosso sistema de cardápios online e digitais transforma a experiência gastronômica para restaurantes e clientes.</p>
                    <a href="#features" class="btn btn-primary btn-lg">Conheça nossas funcionalidades</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-5">
        <div class="container">
            <div class="section-title text-center">
                <h2>Funcionalidades Principais</h2>
                <p class="text-muted">Oferecemos um sistema completo para revolucionar o atendimento do seu restaurante</p>
            </div>
            <div class="row g-4">
                <!-- Feature 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card text-center p-4">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-tablet-alt"></i>
                            </div>
                            <h3 class="card-title fw-bold">Cardápio em Tablets</h3>
                            <p class="card-text">Tablets interativos nas mesas para seus clientes consultarem o cardápio e fazerem pedidos diretamente, sem precisar chamar o garçom.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card text-center p-4">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-mobile-alt"></i>
                            </div>
                            <h3 class="card-title fw-bold">Pedidos Online</h3>
                            <p class="card-text">Sistema de pedidos online para que seus clientes possam fazer pedidos de qualquer lugar, via aplicativo ou pelo seu site.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card text-center p-4">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-qrcode"></i>
                            </div>
                            <h3 class="card-title fw-bold">QR Code nas Mesas</h3>
                            <p class="card-text">QR Codes personalizados para cada mesa, permitindo que seus clientes acessem o cardápio e façam pedidos pelo próprio smartphone.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 4 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card text-center p-4">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <h3 class="card-title fw-bold">Análise de Dados</h3>
                            <p class="card-text">Relatórios detalhados sobre vendas, pratos mais populares e horários de pico para otimizar seu negócio.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 5 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card text-center p-4">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-credit-card"></i>
                            </div>
                            <h3 class="card-title fw-bold">Pagamento Integrado</h3>
                            <p class="card-text">Os clientes podem pagar diretamente pelo tablet ou smartphone, agilizando o atendimento e reduzindo filas.</p>
                        </div>
                    </div>
                </div>
                <!-- Feature 6 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card feature-card text-center p-4">
                        <div class="card-body">
                            <div class="feature-icon">
                                <i class="fas fa-concierge-bell"></i>
                            </div>
                            <h3 class="card-title fw-bold">Gestão de Pedidos</h3>
                            <p class="card-text">Sistema completo para gerenciar todos os pedidos, tanto do salão quanto delivery, com notificações em tempo real.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Advantages Section -->
    <section class="advantages py-5">
        <div class="container">
            <div class="section-title text-center">
                <h2 class="text-white">Vantagens do Sistema</h2>
                <p class="text-white-50">Por que escolher nosso sistema de cardápios digitais?</p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h4>Aumento nas Vendas</h4>
                            <p>Clientes tendem a pedir mais quando podem visualizar imagens atrativas dos pratos e não precisam esperar pelo garçom.</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h4>Redução de Erros</h4>
                            <p>Elimina falhas na comunicação entre clientes, garçons e cozinha, garantindo pedidos corretos.</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h4>Otimização de Equipe</h4>
                            <p>Garçons focam no atendimento personalizado, enquanto o sistema cuida dos pedidos básicos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h4>Agilidade no Atendimento</h4>
                            <p>Pedidos vão diretamente para a cozinha, reduzindo o tempo de espera e aumentando a rotatividade das mesas.</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h4>Fidelização de Clientes</h4>
                            <p>Experiência moderna e eficiente que encanta os clientes e os faz voltar mais vezes.</p>
                        </div>
                    </div>
                    <div class="advantage-item">
                        <div class="advantage-icon">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div>
                            <h4>Atualização Instantânea</h4>
                            <p>Altere preços, adicione ou remova itens do cardápio em tempo real, sem custos de reimpressão.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works py-5">
        <div class="container">
            <div class="section-title text-center">
                <h2>Como Funciona</h2>
                <p class="text-muted">Conheça o processo de implementação e uso do nosso sistema</p>
            </div>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card step-card text-center p-4">
                        <div class="step-number">1</div>
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Cadastro de Cardápio</h3>
                            <p class="card-text">Cadastre seu cardápio com fotos, descrições e preços em nossa plataforma intuitiva.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card step-card text-center p-4">
                        <div class="step-number">2</div>
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Configuração Tablets/QR Codes</h3>
                            <p class="card-text">Instalamos os tablets nas mesas ou configuramos os QR Codes personalizados para cada mesa.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card step-card text-center p-4">
                        <div class="step-number">3</div>
                        <div class="card-body">
                            <h3 class="card-title fw-bold">Pronto para Uso</h3>
                            <p class="card-text">O sistema está pronto para receber pedidos, tanto no salão quanto online, gerando mais vendas e eficiência.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Ordering Process Section -->
    <section class="py-5">
        <div class="container">
            <div class="section-title text-center">
                <h2>Processo de Pedido</h2>
                <p class="text-muted">Veja como funciona o processo de pedido para seus clientes</p>
            </div>
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <img src="/Views/Assets/Images/Fundo.jpg" class="section-img img-fluid" alt="Missão do HubMenu">
                </div>
                <div class="col-lg-6">
                    <div class="card border-0 bg-light p-4">
                        <h3 class="fw-bold mb-4">Pedidos dentro do Restaurante</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                            <span class="bg-primary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: autopx; line-height: 30px;">1</span>
                                Cliente acessa o cardápio digital pelo tablet na mesa ou via QR Code
                            </li>
                            <li class="mb-3">
                            <span class="bg-primary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: autopx; line-height: 30px;">2</span>
                                Seleciona os itens desejados e personaliza conforme opções disponíveis
                            </li>
                            <li class="mb-3">
                            <span class="bg-primary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: autopx; line-height: 30px;">3</span>
                                Envia o pedido diretamente para a cozinha, sem intermediários
                            </li>
                            <li class="mb-3">
                            <span class="bg-primary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: autopx; line-height: 30px;">4</span>
                                Acompanha o status do pedido em tempo real
                            </li>
                            <li>
                            <span class="bg-primary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: autopx; line-height: 30px;">5</span>
                                Efetua o pagamento pelo próprio tablet ou solicita a conta ao garçom
                            </li>
                        </ul>
                    </div>
                    <div class="card border-0 bg-light p-4 mt-4">
                        <h3 class="fw-bold mb-4">Pedidos fora do Restaurante</h3>
                        <ul class="list-unstyled">
                            <li class="mb-3">
                                <span class="bg-secondary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: autopx; line-height: 30px;">1</span>
                                Cliente acessa o site ou aplicativo do restaurante
                            </li>
                            <li class="mb-3">
                                <span class="bg-secondary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: 30px; line-height: 30px;">2</span>
                                Navega pelo cardápio digital e seleciona os itens desejados
                            </li>
                            <li class="mb-3">
                                <span class="bg-secondary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: 30px; line-height: 30px;">3</span>
                                Informa endereço ou se deseja retirar no local
                            </li>
                            <li class="mb-3">
                                <span class="bg-secondary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: 30px; line-height: 30px;">4</span>
                                Realiza o pagamento online ou escolhe pagar na entrega
                            </li>
                            <li>
                                <span class="bg-secondary text-white rounded-circle d-inline-block text-center me-3" style="width: 30px; height: 30px; line-height: 30px;">5</span>
                                Acompanha o status do pedido em tempo real até a entrega
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta py-5">
        <div class="container text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <h2 class="fw-bold mb-4">Pronto para transformar seu restaurante?</h2>
                    <p class="mb-4">Agende uma demonstração gratuita ou entre em contato para saber mais sobre como o MenuDigital pode aumentar suas vendas e melhorar a experiência dos seus clientes.</p>
                    <div class="d-grid gap-3 d-sm-flex justify-content-sm-center">
                        <a href="demonstracao.php" class="btn btn-light">Agendar Demonstração</a>
                        <a href="contato.php" class="btn btn-outline-light">Falar com Consultor</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include_once __DIR__ . '/../Components/footer.php'; ?>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script para Animações ao Scroll (opcional) -->

</body>
</html>