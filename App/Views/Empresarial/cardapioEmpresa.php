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
  <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
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

  <?php @require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>
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

      <!-- Navbar com pesquisa -->
 <div class="search-container-wrapper d-flex align-items-center flex-grow-1">
        <div class="search-container">
          <input type="text" class="form-control search-input" placeholder="Digite o produto">
          <button class="btn btn-light search-btn">
            <i class="bi bi-search"></i>
          </button>
        </div>
        <div class="d-flex gap-2 ms-auto">
          <button id="open_cad" data-bs-toggle="modal" data-bs-target="#cadastrarModal"  onclick="closeNav()" class="btn btn-light btn-circle">
            <i class="bi bi-plus-lg"></i>
          </button>
        </div>
      </div>

<!-- Principais -->
<h1 class="rowCategory">Principais</h1>
<div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4">
  <?php foreach ($produtos as $produto): ?>
    <div class="col animated-card" style="animation-delay: 0.4s">
      <div class="card category-drink"
           data-id="<?php echo $produto->id; ?>"
           data-descricao="<?php echo htmlspecialchars($produto->descricao); ?>"
           data-estabelecimento-id="<?php echo $produto->estabelecimento_id; ?>"
           data-imagem="<?php echo htmlspecialchars($produto->imagem); ?>">

        <span class="category-badge badge-drink" data-id="<?php echo $produto->categoria_id; ?>">
          <?php echo htmlspecialchars($produto->categoria_id); ?>
        </span>

        <button class="btn btn-circle edit-button" data-bs-toggle="modal" data-bs-target="#editModal">
          <i class="bi bi-pencil"></i>
        </button>

        <img src="<?php echo ($produto->imagem ?: 'default.png'); ?>"
             class="card-img-top"
             alt="<?php echo htmlspecialchars($produto->nome); ?>">

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

  <!-- Modal de cadastro de produtos -->
  <?php @require_once __DIR__ . '/../../Views/Components/Cadastros/cadastrarProdutos.php'; ?>

  <!-- Modal para editar produtos -->
  <?php @require_once __DIR__ . '/../../Views/Components/Cadastros/editarProdutos.php'; ?>

  <!-- Bootstrap Bundle -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
