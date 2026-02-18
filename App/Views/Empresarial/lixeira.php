<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?= $Title ?> Produtos Inativos</title>
  <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.2/font/bootstrap-icons.min.css" rel="stylesheet">
  <link rel="stylesheet" href="/Views/Assets/Css/cardapio.css">
  <link rel="icon" href="/Views/Assets/Images/favicon.png">
  <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js" defer></script>
  <script src="/Views/Assets/Js/sidebar.js" defer></script>
</head>
<body>

<?php require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>

<div class="content">

  <!-- Navbar (nome dentro / cor preta / mesma fonte) -->
  <nav class="navbar navbar-expand-lg fixed-navbar">
    <div class="container align-items-center">

      <!-- Botão para abrir a sidebar -->
      <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
          <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56"/>
        </svg>
      </button>

      <!-- Nome do estabelecimento centralizado -->
      <div class="flex-grow-1 d-flex justify-content-center">
        <?php if (!empty($Estabelecimento[0]->nome)): ?>
          <h2 class="mb-0 text-center" style="color:#000; font-family:inherit;">
            <?= htmlspecialchars($Estabelecimento[0]->nome)  ?>
            | Lixeira
          </h2>
        <?php else: ?>
          <span class="navbar-text text-muted">Estabelecimento sem nome</span>
        <?php endif; ?>
      </div>

      <!-- Botão voltar -->
      <div class="d-flex gap-2">
        <a href="/gerenciar/cardapio/<?= htmlspecialchars($EstabelecimentoID ?? '1'); ?>" class="btn btn-light btn-circle" title="Voltar ao Cardápio">
          <i class="bi bi-arrow-left"></i>
        </a>
      </div>

    </div>
  </nav>

  <!-- Verifica se há erros -->
  <?php if (!empty($erro)): ?>
    <div class="alert alert-danger">Erro ao carregar produtos inativos: <?= htmlspecialchars($erro); ?></div>
  <?php endif; ?>

  <!-- Conteúdo principal -->
  <div class="container py-4">
    <h1 class="rowCategory">Produtos Inativos</h1>

    <?php if (empty($ProdutosInativos)): ?>
      <div class="alert alert-info">Nenhum produto inativo encontrado.</div>
    <?php else: ?>
      <div class="row row-cols-2 row-cols-md-2 row-cols-lg-4 g-4" id="produtos-lista">
        <?php foreach ($ProdutosInativos as $produto):
          $catId      = (int) $produto->categoria_id;
          $cardClass  = $catId === 9 ? 'category-dessert' : ($catId === 10 ? 'category-drink' : 'category-food');
          $badgeClass = $catId === 9 ? 'badge-dessert'  : ($catId === 10 ? 'badge-drink'  : 'badge-food');
        ?>
          <div class="col animated-card"
               data-categoria="<?= strtolower(htmlspecialchars($produto->categoria_nome ?? '')); ?>"
               style="animation-delay:0.2s">
            <div class="card <?= $cardClass; ?> position-relative"
                 data-id="<?= $produto->id; ?>"
                 data-descricao="<?= htmlspecialchars($produto->descricao); ?>"
                 data-estabelecimento-id="<?= $produto->estabelecimento_id; ?>"
                 data-imagem="<?= htmlspecialchars($produto->imagem); ?>">

              <!-- Botão REATIVAR -->
              <button class="btn btn-circle btn-warning reativar-button"
                      data-id="<?= $produto->id; ?>"
                      style="position:absolute;top:8px;right:8px;z-index:10;background:rgba(255,193,7,0.85);border:none;">
                <i class="bi bi-arrow-clockwise"></i>
              </button>

              <!-- Badge da categoria -->
              <span class="category-badge <?= $badgeClass; ?>"
                    data-id="<?= $catId; ?>"
                    style="position:absolute;top:8px;left:8px;z-index:10;color:#fff;padding:.25em .5em;border-radius:.25rem;font-size:.85rem;">
                <?= htmlspecialchars($produto->categoria_nome ?? $catId); ?>
              </span>

              <!-- Imagem -->
              <img src="<?= $produto->imagem ?: '/images/default.png'; ?>"
                   class="card-img-top"
                   alt="<?= htmlspecialchars($produto->nome); ?>"
                   style="object-fit:contain;height:220px;width:100%;display:block;">

              <!-- Nome -->
              <div class="card-body">
                <h5 class="card-title mb-0"><?= htmlspecialchars($produto->nome); ?></h5>
              </div>

              <!-- Preço -->
              <div class="card-footer d-flex justify-content-end">
                <span class="price-tag">R$<?= number_format($produto->valor, 2, ',', '.'); ?></span>
              </div>

            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>

</div><!-- /.content -->

<!-- Bootstrap fallback JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>

<script>
  document.querySelectorAll('.reativar-button').forEach(button => {
    button.addEventListener('click', async () => {
      const id = button.dataset.id;
      if (!id) {
        alert('ID do produto não encontrado.');
        return;
      }
      if (confirm('Tem certeza que deseja reativar este produto?')) {
        try {
          const formData = new FormData();
          formData.append('id', id);

          const response = await fetch('/api/produtos/ativar', { method: 'POST', body: formData });
          const data = await response.json();

          if (data.status === 'success') {
            alert(data.message);
            location.reload();
          } else {
            alert('Erro: ' + data.message);
          }
        } catch (e) {
          alert('Erro ao comunicar com o servidor: ' + e.message);
          console.error(e);
        }
      }
    });
  });
</script>

</body>
</html>
