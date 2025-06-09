<?php @require_once __DIR__ . '/../../global.php'; ?>

<?php
// Realizando a consulta do Cardápio específico para aquela empresa, exemplo:
// /cardapio/{id} | cardapio/1 - Aparece Pizza Margherita e Yohan;
// By Moises João Ferreira

$produtos = $Produtos ?? [];
if ($Erro) {
    echo '<div class="alert alert-danger">Erro ao carregar produtos: ' . htmlspecialchars($Erro) . '</div>';
}

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $Title ?> Menu de Alimentos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
  


<!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
  <!-- Favicon -->
  <link rel="icon" href="/Views/Assets/Images/favicon.png">
  <!-- Scripts -->
  <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
  <script src="/Views/Assets/Js/cad_products.js" defer></script>
</head>

<body>

  <?php include_once __DIR__ . '/../Components/navigation-clientes.php'; ?>

  <!-- Conteúdo principal -->
  <div class="container py-4">

    <!-- Filtros -->
    <div class="d-flex justify-content-center mb-4">
      <div class="btn-group" role="group">
        <button type="button" class="btn btn-outline-success active">Todos</button>
        <button type="button" class="btn btn-outline-success">Comidas</button>
        <button type="button" class="btn btn-outline-success">Bebidas</button>
        <button type="button" class="btn btn-outline-success">Sobremesas</button>
      </div>
    </div>

          <div class="search-container-wrapper d-flex align-items-center flex-grow-1">
        <div class="search-container">
          <input type="text" class="form-control search-input" placeholder="Digite o produto">
          <button class="btn btn-light search-btn">
            <i class="bi bi-search"></i>
          </button>
        </div>
      </div>

<!-- Principais -->
<h1 class="rowCategory">Principais</h1>
<div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4">
  <?php foreach ($produtos as $produto): ?>
    <div class="col animated-card" style="animation-delay: 0.4s">
      <div class="card category-drink">
        <span class="category-badge badge-drink">
          <?php echo htmlspecialchars($produto->categoria_id); ?>
        </span>
        <img src="<?php echo htmlspecialchars($produto->imagem); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($produto->nome); ?>">
        <div class="card-body">
          <h5 class="card-title mb-0"><?php echo htmlspecialchars($produto->nome); ?></h5>
        </div>
        <div class="card-footer d-flex justify-content-end align-items-center">
          <span class="price-tag">R$<?php echo number_format($produto->valor, 2, ',', '.'); ?></span>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<footer class="footer mt-auto py-3 text-white">
  <div class="container">
    <div id="central" class="row g-4">
      <div id="divcentral" class="col-lg-4 col-md-6">
        <h5 class="fw-bold mb-3">HubMenu</h5>
        <p class="small">
        O <strong>HubMenu</strong> não é apenas um sistema de pedidos, é uma revolução na forma como você e seus clientes
        interagem com a comida! Em um mundo cada vez mais dinâmico, onde o tempo é um recurso precioso, o <strong>HubMenu</strong>
        foi pensado para otimizar sua operação e proporcionar uma experiência única com agilidade!
        </p>
      </div>
      
      <div class="col-lg-4 col-md-6">
        <h5 class="fw-bold mb-3">Links Úteis</h5>
        <ul class="list-unstyled">
          <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-opacity">Termos de Ações Empresariais</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-opacity">Termos de Privacidade</a></li>
          <li class="mb-2"><a href="#" class="text-white text-decoration-none hover-opacity">Termos de Serviço</a></li>
        </ul>
      </div>
      
      <div class="col-lg-4 col-md-12">
        <h5 class="fw-bold mb-3">Nossa Equipe</h5>
        <ul class="list-unstyled">
          <li class="mb-2">
            <a href="https://www.linkedin.com/in/igor-dias-b3162b219/" class="text-white text-decoration-none hover-opacity">
              <i class="bi bi-linkedin"></i>Igor Dias
            </a>
          </li>

          <li class="mb-2">
            <a href="https://www.linkedin.com/in/mark-stolfi-b84760337/" class="text-white text-decoration-none hover-opacity">
              <i class="bi bi-linkedin"></i>Mark Stolfi
            </a>
          </li>

          <li class="mb-2">
            <a href="https://www.linkedin.com/in/moisesferreirajj/" class="text-white text-decoration-none hover-opacity">
              <i class="bi bi-linkedin"></i>Moises Ferreira
            </a>
          </li>

          <li class="mb-2">
            <a href="https://www.linkedin.com/in/yohansie/" class="text-white text-decoration-none hover-opacity">
              <i class="bi bi-linkedin"></i>Yohan Siedschlag
            </a>
          </li>
        </ul>
      </div>
    </div>

    <div class="row border-top border-secondary mt-4 pt-3">
      <div class="col-12 text-center">
        <p class="small mb-0">&copy; 2025 HubMenu. Todos os direitos reservados.</p>
      </div>
    </div>
  </div>
</footer>

<!-- Bootstrap Bundle -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>
