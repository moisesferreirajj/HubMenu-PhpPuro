<nav class="navbar navbar-expand-lg navbar-light bg-white py-3">
    <div class="container">

        <div id="logonav">
            <a class="navbar-brand" href="/">
                <?php @require_once __DIR__ . '/svg-logo.php'; ?>
            </a>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="/">Início</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/empresarial">Para Empresas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/empresarial/suporte">Fale Conosco</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/restaurantes">Restaurantes</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/empresarial/sobre">Sobre Nós</a>
                </li>
            </ul>
        </div>
    </div>
</nav>