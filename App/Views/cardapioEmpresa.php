<?php 
    namespace sys4soft\models;
    use sys4soft\Database;

    
?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menu de Alimentos</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
  
  <!-- Estilos personalizados -->
  <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
  <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">

  <!-- Scripts -->
  <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
  <script src="/Views/Assets/Js/sidebar.js" defer></script>
  <script src= "/Views/Assets/Js/cad_products.js" defer></script>
</head>

<body>

  <?php require '../Views/Components/sidebar.php'; ?>
  <!-- Navbar com pesquisa -->
  <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
      <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
        </svg>
      </button>

      <div class="search-container col-lg-8 mx-auto d-flex">
        <input type="text" class="form-control search-input" placeholder="Digite o produto">
        <button class="btn btn-light search-btn">
          <i class="bi bi-search"></i>
        </button>
      </div>

      <div class="d-flex gap-2 ms-auto">
        <button class="btn btn-light btn-circle">
          <i class="bi bi-funnel"></i>
        </button>
        <button id="open_cad" data-bs-toggle="modal" data-bs-target="#modal_page" class="btn btn-light btn-circle">
          <i class="bi bi-plus-lg"></i>
        </button>
      </div>
    </div>
  </nav>

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

    <!-- Principais -->
    <h1 class="rowCategory">Principais</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      
      <!-- Item: Pizza -->
      <div class="col animated-card" style="animation-delay: 0.1s">
        <div class="card h-100 category-food">
          <span class="category-badge badge-food">Comida</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/pizza-goat-cheese-tomato-sauce-260nw-2542135769.jpg" class="card-img-top" alt="Pizza">
          <div class="card-body">
            <h5 class="card-title mb-0">Pizza</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$20,00</span>
          </div>
        </div>
      </div>

      <!-- Item: Açaí -->
      <div class="col animated-card" style="animation-delay: 0.2s">
        <div class="card h-100 category-dessert">
          <span class="category-badge badge-dessert">Sobremesa</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/healthy-summer-acai-smoothie-bowl-260nw-2262525705.jpg" class="card-img-top" alt="Açaí">
          <div class="card-body">
            <h5 class="card-title mb-0">Açaí</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$17,00</span>
          </div>
        </div>
      </div>

      <!-- Item: Pudim -->
      <div class="col animated-card" style="animation-delay: 0.3s">
        <div class="card h-100 category-dessert">
          <span class="category-badge badge-dessert">Sobremesa</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/cream-caramel-pudding-sauce-plate-260nw-2153657061.jpg" class="card-img-top" alt="Pudim">
          <div class="card-body">
            <h5 class="card-title mb-0">Pudim</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$7,00</span>
          </div>
        </div>
      </div>

      <!-- Item: Coca-Cola -->
      <div class="col animated-card" style="animation-delay: 0.4s">
        <div class="card h-100 category-drink">
          <span class="category-badge badge-drink">Bebida</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/usa-california-01-october-2019-260nw-1553467073.jpg" class="card-img-top" alt="Coca-Cola">
          <div class="card-body">
            <h5 class="card-title mb-0">Coca-Cola</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$10,00</span>
          </div>
        </div>
      </div>

    </div>

    <!-- Destaques -->
    <h1 class="rowCategory mt-5">Destaques</h1>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
      <!-- Aqui você pode adicionar novos produtos diferentes ou remover a repetição -->
      <!-- Item: Pizza -->
      <div class="col animated-card" style="animation-delay: 0.1s">
        <div class="card h-100 category-food">
          <span class="category-badge badge-food">Comida</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/pizza-goat-cheese-tomato-sauce-260nw-2542135769.jpg" class="card-img-top" alt="Pizza">
          <div class="card-body">
            <h5 class="card-title mb-0">Pizza</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$20,00</span>
          </div>
        </div>
      </div>

      <!-- Item: Açaí -->
      <div class="col animated-card" style="animation-delay: 0.2s">
        <div class="card h-100 category-dessert">
          <span class="category-badge badge-dessert">Sobremesa</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/healthy-summer-acai-smoothie-bowl-260nw-2262525705.jpg" class="card-img-top" alt="Açaí">
          <div class="card-body">
            <h5 class="card-title mb-0">Açaí</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$17,00</span>
          </div>
        </div>
      </div>

      <!-- Item: Pudim -->
      <div class="col animated-card" style="animation-delay: 0.3s">
        <div class="card h-100 category-dessert">
          <span class="category-badge badge-dessert">Sobremesa</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/cream-caramel-pudding-sauce-plate-260nw-2153657061.jpg" class="card-img-top" alt="Pudim">
          <div class="card-body">
            <h5 class="card-title mb-0">Pudim</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$7,00</span>
          </div>
        </div>
      </div>

      <!-- Item: Coca-Cola -->
      <div class="col animated-card" style="animation-delay: 0.4s">
        <div class="card h-100 category-drink">
          <span class="category-badge badge-drink">Bebida</span>
          <button class="btn btn-circle edit-button"><i class="bi bi-pencil"></i></button>
          <img src="https://www.shutterstock.com/image-photo/usa-california-01-october-2019-260nw-1553467073.jpg" class="card-img-top" alt="Coca-Cola">
          <div class="card-body">
            <h5 class="card-title mb-0">Coca-Cola</h5>
           
          </div>
          <div class="card-footer d-flex justify-content-end align-items-center">
            <span class="price-tag">R$10,00</span>
          </div>
        </div>
      </div>

  </div>

<!-- Modal de cadastro de produtos -->
<div class="modal fade" id="modal_page" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalLabel">Cadastrar Produto</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
      </div>
      <div class="modal-body">
        <form action="ProdutosModel.php" method="POST">
          <label for="product-name">Nome do Produto:</label>
          <input type="text" id="product-name" class="form-control" required>
          <label for="product-price">Preço:</label>
          <input type="number" id="product-price" class="form-control" required>
          <label for="product-desc">Descrição:</label>
          <input type="text" id="product-desc" class="form-control" required>
          <label for="product-cat">Categoria:</label>
          <select class="form-select" aria-label="Default select example">
            <option selected>Escolha Categoria</option>
            <option value="SAL">Salgados</option>
            <option value="SLD">Saladas</option>
            <option value="DOC">Sobremesas</option>
            <option value="BEB">Bebidas</option>
          </select>
          <label class="pro_file" for="img_pro">
            <div class="icon">
              <svg xmlns="http://www.w3.org/2000/svg" fill="" viewBox="0 0 24 24"><g stroke-width="0" id="SVGRepo_bgCarrier"></g><g stroke-linejoin="round" stroke-linecap="round" id="SVGRepo_tracerCarrier"></g><g id="SVGRepo_iconCarrier"> <path fill="" d="M10 1C9.73478 1 9.48043 1.10536 9.29289 1.29289L3.29289 7.29289C3.10536 7.48043 3 7.73478 3 8V20C3 21.6569 4.34315 23 6 23H7C7.55228 23 8 22.5523 8 22C8 21.4477 7.55228 21 7 21H6C5.44772 21 5 20.5523 5 20V9H10C10.5523 9 11 8.55228 11 8V3H18C18.5523 3 19 3.44772 19 4V9C19 9.55228 19.4477 10 20 10C20.5523 10 21 9.55228 21 9V4C21 2.34315 19.6569 1 18 1H10ZM9 7H6.41421L9 4.41421V7ZM14 15.5C14 14.1193 15.1193 13 16.5 13C17.8807 13 19 14.1193 19 15.5V16V17H20C21.1046 17 22 17.8954 22 19C22 20.1046 21.1046 21 20 21H13C11.8954 21 11 20.1046 11 19C11 17.8954 11.8954 17 13 17H14V16V15.5ZM16.5 11C14.142 11 12.2076 12.8136 12.0156 15.122C10.2825 15.5606 9 17.1305 9 19C9 21.2091 10.7909 23 13 23H20C22.2091 23 24 21.2091 24 19C24 17.1305 22.7175 15.5606 20.9844 15.122C20.7924 12.8136 18.858 11 16.5 11Z" clip-rule="evenodd" fill-rule="evenodd"></path> </g></svg>
            </div>
            <div class="text">
              <span>Insira uma imagem</span>
            </div>
            <input type="file" id="img_product" >
          </label>
        </form>
      </div>
    </div>
  </div>
</div>

  
  <!-- Bootstrap Bundle -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

</body>
</html>
