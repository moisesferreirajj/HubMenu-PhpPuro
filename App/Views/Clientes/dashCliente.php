<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $Title ?> Delivery de Comida</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- CSS Customizado -->
    <link rel="stylesheet" href="/Views/Assets/CSS/Clientes/dash.css">

</head>

<body>
    <!-- Navbar -->
    <?php include_once __DIR__ . '/../Components/navigation-clientes.php'; ?>

    <!-- Hero Section -->
    <section class="hero py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-8 mx-auto text-center">
                    <h1 class="display-5 fw-bold mb-4">Tudo pra facilitar seu dia a dia</h1>
                    <p class="lead mb-4">Descubra os melhores restaurantes, pizzarias, hamburguerias e muito mais perto
                        de você!</p>

                    <div class="search-box">
                        <form class="d-flex">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-map-marker-alt text-primary"></i>
                                </span>
                                <input type="text" class="form-control border-start-0"
                                    placeholder="Endereço de entrega e número">
                                <button class="btn btn-success px-4" type="submit">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Categories Section -->
    <section class="categories py-5 mt-3">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="category-card bg-danger text-white">
                        <div class="row">
                            <div class="col-7 p-4 ms-2">
                                <h2>Restaurantes</h2>
                                <a href="/restaurantes" class="btn btn-outline-light mt-1 ms-2 btn-opcoes">
                                    Ver opções <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-end">
                                <img src="../Views/Assets/Images/Estabelecimentos/DashRestaurante.png" alt="Restaurante"
                                    class="img-fluid pizzaiolo">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="category-card bg-success text-white">
                        <div class="row">
                            <div class="col-7 p-4 ms-2">
                                <h2>Pizzarias</h2>
                                <a href="#" class="btn btn-outline-light mt-1 ms-2">
                                    Ver opções <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                            <div class="col-4 d-flex align-items-center justify-content-end">
                                <img src="/Views/Assets/Images/Estabelecimentos/DashPizzaiolo.png" alt="Pizzaria"
                                    class="img-fluid pizzaiolo">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Additional Categories -->
            <div class="row mt-4">
                <div class="col-12">
                    <div class="mini-categories-row">
                        <div class="mini-category-cards">
                            <div class="mini-category-card">
                                <div class="icon-container">
                                    <i class="fas fa-hamburger fa-2x"></i>
                                </div>
                                <h5>Hamburguerias</h5>
                            </div>
                        </div>

                        <div class="mini-category-cards">
                            <div class="mini-category-card">
                                <div class="icon-container">
                                    <i class="fas fa-utensils fa-2x"></i>
                                </div>
                                <h5>Lanchonetes</h5>
                            </div>
                        </div>

                        <div class="mini-category-cards">
                            <div class="mini-category-card">
                                <div class="icon-container">
                                    <i class="fas fa-fish fa-2x"></i>
                                </div>
                                <h5>Sushi Bar</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </section>

    <!-- Top Restaurants Section -->
    <section class="top-restaurants py-5 bg-light">
        <div class="container">
            <h2 class="section-title mb-4">Melhores Restaurantes</h2>

            <div class="row g-4" id="estabelecimentos-container">
                <!-- Os estabelecimentos serão carregados aqui via AJAX -->
                <div class="col-12 text-center py-5">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Carregando...</span>
                    </div>
                    <p class="mt-2">Carregando estabelecimentos...</p>
                </div>
            </div>
        </div>
    </section>

    <!-- App Download Section -->
    <section class="app-download py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Use Nosso Sistema</h2>
                    <p class="mb-4">Cardápio descomplicado para organizar seu estabelecimento e facilitar o pedido de
                        seus clientes!</p>
                    <div class="d-flex flex-wrap">
                        <a href="/empresarial" class="btn btn-dark me-3 mb-3">
                            <i class="fa-solid fa-house"></i> Para Empresas
                        </a>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <img src="./Views/Assets/Images/marksapecao.png" alt="App HubMenu" class="img-fluid app-image">
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-dark text-white py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">HubMenu</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Sobre nós</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Carreiras</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Blog</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Contato</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Para Restaurantes</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Cadastre seu
                                Restaurante</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Entregadores</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Planos para
                                Parceiros</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Para Você</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Restaurantes
                                próximos</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Pizzarias</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">Hamburguerias</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-white-50">HubMenu Card</a></li>
                    </ul>
                </div>

                <div class="col-md-3 mb-4">
                    <h5 class="mb-3">Redes Sociais</h5>
                    <div class="d-flex gap-3 fs-4">
                        <a href="#" class="text-white-50"><i class="fab fa-facebook"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="text-white-50"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="row">
                <div class="col-12 text-center">
                    <p class="text-white-50">&copy; <?= date('Y') ?> HubMenu | Todos os direitos reservados</p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script customizado para carregar os estabelecimentos via AJAX -->
    <script src="/Views/Assets/JS/Clientes/dash.js"></script>
</body>

</html>