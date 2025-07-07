<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/pedidosEmpresa.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <link rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <title>HubMenu | Pedidos</title>
</head>

<body>
    <?php require_once __DIR__ . '/../../Views/Components/Cadastros/cadastrarPedidos.php'; ?>
    <?php require_once __DIR__ . '/../../Views/Components/sidebar.php'; ?>

    <div class="header">
        <div class="container">
            <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56" />
                </svg>
            </button>
            <div class="search-container-wrapper d-flex align-items-center flex-grow-1">
                <div class="search-container">
                    <input type="text" class="form-control search-input" placeholder="Pesquisar Pedidos">
                    <button class="btn btn-light search-btn">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
            <div class="actions-right">
                <button id="open_cad" data-bs-toggle="modal" data-bs-target="#cadastrarModal" onclick="closeNav()" class="btn btn-light btn-circle">
                    <i class="bi bi-plus-lg"></i>     
                </button>
            </div>
        </div>
    </div>

    <div class="order-container">
        <?php foreach ($orders as $pedido): ?>
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <div class="datas d-flex flex-column">
                        <span class="order-id">Pedido #<?= htmlspecialchars($pedido->id) ?></span>
                        <span class="order-client"><?= htmlspecialchars($pedido->cliente) ?></span>
                        <span class="order-status badge bg-<?=
                                                            $pedido->status == 'entregue' ? 'success' : ($pedido->status == 'cancelado' ? 'danger' : ($pedido->status == 'preparando' ? 'warning' : 'info'))
                                                            ?>">
                            <?= ucfirst($pedido->status) ?>
                        </span>
                    </div>
                    <button
                        type="button"
                        class="btn btn-adicionar-produto"
                        data-bs-toggle="modal"
                        data-bs-target="#adicionarProdutoModal"
                        data-pedido-id="<?= $pedido->id ?>">
                        <i class="bi bi-plus-lg"></i> JAdd
                    </button>
                </div>
                <div class="card-body">
                    <?php if (!empty($pedido->produtos) && is_array($pedido->produtos)): ?>
                        <?php foreach ($pedido->produtos as $item): ?>
                            <div class="item">
                                <div class="item-info">
                                    <span class="quantity"><?= intval($item->quantidade) ?>x</span>
                                    <span class="item-name"><?= htmlspecialchars($item->nome) ?></span>
                                    <span class="item-price" style="margin-left: 8px;">| R$ <?= number_format($item->valor * $item->quantidade, 2, ',', '.') ?></span>
                                </div>
                                <span class="item-observations">Observação:<br> - <?= htmlspecialchars($item->observacao ?? '') ?> </span>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>Nenhum produto encontrado para este pedido.</p>
                    <?php endif; ?>
                </div>

                <div class="actions">
                    <form method="POST" action="/api/pedidos/atualizar-status" class="d-inline">
                        <input type="hidden" name="pedido_id" value="<?= $pedido->id ?>">
                        <input type="hidden" name="status" value="cancelado">
                        <button type="submit" class="btn btn-outline-danger">Cancelar</button>
                    </form>

                    <form method="POST" action="/api/pedidos/atualizar-status" class="d-inline">
                        <input type="hidden" name="pedido_id" value="<?= $pedido->id ?>">
                        <input type="hidden" name="status" value="entregue">
                        <button type="submit" class="btn btn-success">Concluir</button>
                    </form>


                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Modal para adicionar produto a pedido existente -->
    <div class="modal fade" id="adicionarProdutoModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="formAdicionarProduto" method="POST" action="/api/pedidos/adicionarProdutoAoPedidoExistente">
                    <div class="modal-header">
                        <h5 class="modal-title">Adicionar Produto ao Pedido</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="pedido_id" id="pedido_id" value="">

                        <div class="products-list">
                            <?php foreach ($menuProducts as $produto): ?>
                                <div class="products-item row border rounded p-2 mb-2" data-id="<?= $produto->id ?>">
                                    <div class="d-flex align-items-center gap-2 justify-content-between">
                                        <div class="d-flex align-items-center gap-2 card-pro">
                                            <img src="<?= htmlspecialchars($produto->imagem) ?>"
                                                alt="<?= htmlspecialchars($produto->nome) ?>" class="img-thumbnail"
                                                style="max-width:100px;">
                                            <input type="checkbox" name="products[]" value="<?= $produto->id ?>"
                                                class="produto" id="product_<?= $produto->id ?>">
                                            <label for="product_<?= $produto->id ?>" class="mb-0">
                                                <?= htmlspecialchars($produto->nome) ?> - R$
                                                <?= number_format($produto->valor, 2, ',', '.') ?>
                                            </label>
                                        </div>
                                        <div class="obs">
                                            <label class="form-label mb-0">Observação:</label>
                                            <textarea class="form-control" name="observacao[<?= $produto->id ?>]"
                                                rows="2"></textarea>
                                        </div>
                                    </div>
                                    <div class="row mt-2">
                                        <div class="col-md-6">
                                            <label class="form-label">Quantidade:</label>
                                            <input type="number" name="quantidade[<?= $produto->id ?>]" value="1"
                                                min="1" class="form-control" style="width:80px;">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <p>Total: R$ <span id="total-value-existente">0,00</span></p>
                        <input type="hidden" id="valor_total_existente" name="valor_total" value="0.00">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary">Adicionar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <script src="/Views/Assets/Js/sidebar.js"></script>
    <script src="/Views/Assets/Js/FooterLayout.js"></script>

    <script>
        // Variável para controlar se já foi inicializado
        let modalInitialized = false;

        document.addEventListener('DOMContentLoaded', function() {
            const modal = document.getElementById('adicionarProdutoModal');
            const pedidoIdInput = document.getElementById('pedido_id');
            const totalSpan = document.getElementById('total-value-existente');
            const totalInput = document.getElementById('valor_total_existente');
            const form = document.getElementById('formAdicionarProduto');

            // Função para extrair preço formatado do label
            function extractPrice(text) {
                const match = text.match(/R\$\s*([\d.,]+)/);
                return match ? parseFloat(match[1].replace(/\./g, '').replace(',', '.')) : 0;
            }

            // Calcula total de acordo com produtos selecionados e quantidades
            function calcTotal() {
                const checkboxes = modal.querySelectorAll('.produto:checked');
                let total = 0;

                checkboxes.forEach(checkbox => {
                    const id = checkbox.value;
                    const quantidadeInput = modal.querySelector(`input[name="quantidade[${id}]"]`);
                    const quantidade = parseInt(quantidadeInput?.value || '1');
                    const label = checkbox.closest('.card-pro').querySelector('label');
                    const preco = extractPrice(label.textContent);
                    total += preco * quantidade;
                });

                totalSpan.textContent = total.toLocaleString('pt-BR', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                });
                totalInput.value = total.toFixed(2);
            }

            // Configura os listeners apenas uma vez
            function setupListeners() {
                if (modalInitialized) return;

                modal.querySelectorAll('.produto').forEach(cb => {
                    cb.addEventListener('change', calcTotal);
                });

                modal.querySelectorAll('input[type="number"]').forEach(input => {
                    input.addEventListener('input', calcTotal);
                    input.addEventListener('change', calcTotal);
                });

                modalInitialized = true;
            }

            // Evento para quando o modal abrir
            modal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const pedidoId = button.getAttribute('data-pedido-id');

                if (pedidoId && pedidoIdInput) {
                    pedidoIdInput.value = pedidoId;
                }

                // Limpa seleções anteriores
                modal.querySelectorAll('.produto').forEach(cb => cb.checked = false);
                modal.querySelectorAll('input[type="number"]').forEach(input => input.value = '1');
                modal.querySelectorAll('textarea').forEach(textarea => textarea.value = '');

                setupListeners();
                calcTotal();
            });

            // Intercepta o submit para enviar via AJAX - apenas uma vez
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const submitButton = form.querySelector('button[type="submit"]');

                // Previne múltiplos submits
                if (submitButton.disabled) return;

                submitButton.disabled = true;
                submitButton.textContent = 'Adicionando...';

                const formData = new FormData(form);

                fetch(form.action, {
                        method: 'POST',
                        body: new URLSearchParams(formData)
                    })
                    .then(res => res.json())
                    .then(response => {
                        alert(response.message || 'Produto(s) adicionado(s) com sucesso!');
                        if (response.status === 'success') {
                            // Fecha o modal
                            bootstrap.Modal.getInstance(modal).hide();
                            // Recarrega a página
                            location.reload();
                        }
                    })
                    .catch(error => {
                        alert('Erro ao adicionar produto: ' + error.message);
                        console.error(error);
                    })
                    .finally(() => {
                        submitButton.disabled = false;
                        submitButton.textContent = 'Adicionar';
                    });
            });
        });
    </script>

    <footer-layout></footer-layout>
</body>

</html>