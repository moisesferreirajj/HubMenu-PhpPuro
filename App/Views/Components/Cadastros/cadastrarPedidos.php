<?php
$produtosModel = new ProdutosModel();
$usuariosModel = new UsuariosModel();
$userCompany = $usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
$menuProductsObj = $produtosModel->findByEstabelecimentoId($userCompany ?? []);
$menuProducts = $menuProductsObj->results ?? [];
?>
<div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form method="POST" action="/api/pedidos/register">
                <div class="modal-header">
                    <h5 class="modal-title" id="cadastrarModalLabel">Novo Pedido</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <input type="hidden" name="estabelecimento_id" value="<?= $userCompany?? '' ?>">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label class="form-label">Produtos:</label>
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
                                                <label for="observacao" class="form-label mb-0">Observação:</label>
                                                <textarea class="form-control" name="observacao[<?= $produto->id ?>]"
                                                    rows="2"></textarea>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-md-6">
                                                <label for="quantidade_<?= $produto->id ?>"
                                                    class="form-label">Quantidade:</label>
                                                <input type="number" name="quantidade[<?= $produto->id ?>]" value="1"
                                                    min="1" class="form-control" style="width:80px;">
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <p>Total: R$ <span id="total-value">0,00</span></p>
                    <input type="hidden" id="valor_total" name="valor_total" value="0.00">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Cadastrar</button>
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
    
    // Função para extrair o preço de forma mais robusta
    function extractPrice(priceText) {
        const match = priceText.match(/R\$\s*([\d.,]+)/);
        if (!match) return 0;
        
        return parseFloat(match[1]
            .replace(/\./g, '')
            .replace(',', '.'));
    }

    function calcTotal() {
        const checkboxes = document.querySelectorAll('.produto:checked');
        let total = 0;

        checkboxes.forEach(checkbox => {
            try {
                const productId = checkbox.value;
                const quantidadeInput = document.querySelector(`input[name="quantidade[${productId}]"]`);
                const quantidade = parseInt(quantidadeInput.value) || 0;
                
                const label = checkbox.closest('.card-pro').querySelector('label');
                const preco = extractPrice(label.textContent);

                total += preco * quantidade;
            } catch (e) {
                console.error('Erro ao calcular item:', e);
            }
        });

        const totalFormatted = total.toLocaleString('pt-BR', { 
            minimumFractionDigits: 2,
            maximumFractionDigits: 2
        });
        
        totalSpan.textContent = totalFormatted;
        totalInput.value = total.toFixed(2);
    }

    // Adiciona listeners permanentemente
    function setupEventListeners() {
        document.querySelectorAll('.produto').forEach(checkbox => {
            checkbox.addEventListener('change', calcTotal);
        });

        document.querySelectorAll('input[type="number"]').forEach(input => {
            input.addEventListener('input', calcTotal);
            input.addEventListener('change', calcTotal);
        });
    }

    // Configura os listeners quando o modal é aberto
    modal.addEventListener('show.bs.modal', setupEventListeners);
    
    // Também configura imediatamente caso o modal já esteja aberto
    if (modal.classList.contains('show')) {
        setupEventListeners();
        calcTotal();
    }
});
</script>