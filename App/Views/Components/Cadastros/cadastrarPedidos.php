<?php 
$pedidoId = time(); 
require_once __DIR__ . '/../../../Models/ProdutosModel.php';
$produtosModel = new ProdutosModel();
$menuProducts = $produtosModel->searchByEstabelecimentoAndCondition(1);
?>
<div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="pro_frm" method="POST" action="/api/produtos/cadastrar" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastrarModalLabel"><?php echo "Pedido " . $pedidoId; ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>

                <div class="modal-body">
                    <div class="row mb-3 sla">
                        <div class="col-md-6 mb-3 products-list">
                            <label for="nome" class="form-label">Produto(s):</label>
                            <?php if (!empty($menuProducts)): ?>
                                <?php foreach ($menuProducts as $produtos): ?>
                                    <div class="products-item border rounded p-2 mb-2" data-id="<?php echo $produtos->id; ?>" style="cursor: pointer;">
                                        <div class="d-flex align-items-center gap-2">
                                            <img src="<?php echo htmlspecialchars($produtos->imagem); ?>" alt="<?php echo htmlspecialchars($produtos->nome); ?>" class="img-thumbnail" style="width: 50px; height: 50px;">
                                            <input type="checkbox" name="products[]" id="product_<?php echo $produtos->id; ?>" value="<?php echo $produtos->id; ?>" data-valor="<?php echo $produtos->valor; ?>" style="margin-right: 5px;">
                                            <label for="product_<?php echo $produtos->id; ?>" class="mb-0">
                                                <?php echo htmlspecialchars($produtos->nome); ?> - R$ <?php echo number_format($produtos->valor, 2, ',', '.'); ?>
                                            </label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nenhum produto disponível.</p>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="observacao" class="form-label">Observação:</label>
                            <textarea class="form-control" id="observacao" name="observacao" rows="3" placeholder="Digite aqui qualquer observação sobre o pedido..."></textarea>
                            <p>Total: R$ <span id="total-value">0,00</span></p>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="regis_pro" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Script para ativar o clique nos cards -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const productItems = document.querySelectorAll('.products-item');
        const checkboxes = document.querySelectorAll('input[type="checkbox"][data-valor]');
        const totalValueElement = document.getElementById('total-value');

        // Função para calcular o total dos produtos selecionados
        function calculateTotal() {
            let total = 0;
            checkboxes.forEach(checkbox => {
                if (checkbox.checked) {
                    total += parseFloat(checkbox.getAttribute('data-valor'));
                }
            });
            totalValueElement.textContent = total.toFixed(2).replace('.', ',');
        }

        // Adiciona evento de clique nos itens para alternar o estado do checkbox
        productItems.forEach(item => {
            item.addEventListener('click', function (e) {
                // Evita que o clique no checkbox ou label interfira
                if (e.target.tagName === 'INPUT' || e.target.tagName === 'LABEL') return;

                const checkbox = this.querySelector('input[type="checkbox"]');
                checkbox.checked = !checkbox.checked;

                // Atualiza o estilo do item com base no estado do checkbox
                if (checkbox.checked) {
                    this.style.backgroundColor = '#e6f4ff';
                    this.style.border = '2px solid #007bff';
                    this.style.boxShadow = '0 0 8px rgba(0, 123, 255, 0.3)';
                } else {
                    this.style.backgroundColor = '';
                    this.style.border = '';
                    this.style.boxShadow = '';
                }

                // Recalcula o total após a alteração
                calculateTotal();
            });
        });

        // Adiciona evento de mudança diretamente nos checkboxes
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                const parentItem = checkbox.closest('.products-item');
                if (checkbox.checked) {
                    parentItem.style.backgroundColor = '#e6f4ff';
                    parentItem.style.border = '2px solid #007bff';
                    parentItem.style.boxShadow = '0 0 8px rgba(0, 123, 255, 0.3)';
                } else {
                    parentItem.style.backgroundColor = '';
                    parentItem.style.border = '';
                    parentItem.style.boxShadow = '';
                }

                // Recalcula o total após a alteração
                calculateTotal();
            });
        });

        // Calcula o total inicial (caso algum checkbox já esteja marcado)
        calculateTotal();
    });
</script>
