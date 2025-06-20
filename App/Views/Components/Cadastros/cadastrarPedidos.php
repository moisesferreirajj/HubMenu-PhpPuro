<?php
$produtosModel = new ProdutosModel();
$usuariosModel = new UsuariosModel();
$userCompany = $usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
?>
<div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form class="pro_frm" method="POST" action="/pedidos/registerOrder" enctype="multipart/form-data">
                
            
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastrarModalLabel">Novo Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="nome_cliente" class="form-label">Identificação do Cliente *</label>
                            <input type="text" class="form-control" id="nome_cliente" name="nome_cliente" placeholder="Ex: Mesa 5, João, Balcão 3..." required>
                            <input type="hidden" name="estabelecimento_id" value="<?php echo htmlspecialchars($userCompany); ?>">
                        </div>
                    </div>
                    <div class="row mb-3 sla">
                        <div class="col-md-6 mb-3 products-list">
                            <label for="order" class="form-label">Produto(s):</label>
                            <?php if (!empty($menuProducts)): ?>
                                <?php foreach ($menuProducts as $produtos): ?>
                                    <div class="products-item row border rounded p-2 mb-2" data-id="<?php echo $produtos->id; ?>">
                                        <div class="d-flex align-items-center gap-2 justify-content-between">
                                            <div class="d-flex align-items-center gap-2 card-pro">
                                                <img src="<?php echo htmlspecialchars($produtos->imagem); ?>" alt="<?php echo htmlspecialchars($produtos->nome); ?>" class="img-thumbnail" style="max-width:100px;">
                                                <input type="checkbox" name="products[]" id="product_<?php echo $produtos->id; ?>" value="<?php echo $produtos->id; ?>" data-valor="<?php echo $produtos->valor; ?>" class="produto">
                                                <label for="product_<?php echo $produtos->id; ?>" class="mb-0">
                                                    <?php echo htmlspecialchars($produtos->nome); ?> - R$ <?php echo number_format($produtos->valor, 2, ',', '.'); ?>
                                                </label>
                                            </div>
                                            <div class="obs">
                                                <label for="observacao" class="form-label mb-0">Observação:</label>
                                                <textarea class="form-control" id="observacao" name="observacao[<?php echo $produtos->id; ?>]" rows="3" placeholder=""></textarea>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <p>Nenhum produto disponível.</p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p>Total: R$ <span id="total-value">0,00</span></p>
                    <input type="hidden" id="valor_total" name="valor_total" value="0.00">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" id="regis_pro" class="btn btn-primary">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const modal = document.getElementById('cadastrarModal');
    const totalSpan = document.getElementById('total-value');
    const totalInput = document.getElementById('valor_total');

    function calcTotal() {
        const checkboxes = document.querySelectorAll('.produto');
        let total = 0;
        checkboxes.forEach(product => {
            if (product.checked) {
                total += parseFloat(product.getAttribute('data-valor'));
            }
        });
        const totalFormatted = total.toFixed(2).replace('.', ',');
        totalSpan.textContent = totalFormatted;
        totalInput.value = totalFormatted;
    }

    modal.addEventListener('shown.bs.modal', () => {
        const checkboxes = document.querySelectorAll('.produto');
        checkboxes.forEach(product => {
            product.addEventListener('change', calcTotal);
        });
        calcTotal();
    });
});
</script>