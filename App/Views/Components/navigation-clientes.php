<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container">

        <div id="logonav">
            <a class="navbar-brand" href="#">
                <?php @require_once __DIR__ . '/svg-logo.php'; ?>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Para Empresas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Restaurantes</a>
                </li>
            </ul>
            <div class="d-flex">
                <button class="btn btn-outline-primary me-2">Criar conta</button>
                <button class="btn btn-primary">Entrar</button>
            </div>
        </div>
    </div>
</nav>