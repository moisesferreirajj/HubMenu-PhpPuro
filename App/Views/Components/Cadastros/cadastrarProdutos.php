<?php @require_once __DIR__ . '/../../global.php'; ?>

<form class="pro_frm" method="POST" action="/api/produtos/cadastrar" enctype="multipart/form-data">
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="form-group">
                <label for="nome" class="form-label">Nome do Produto:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group" id="side">
                <label for="valor" class="form-label">Valor:</label>
                <div class="input-group">
                    <span class="input-group-text">R$</span>
                    <input type="number" class="form-control" id="valor" name="valor" placeholder="0,00" required step="0.01">
                </div>
            </div>
        </div>
    </div>

    <div class="mb-3">
        <div class="form-group">
            <label for="imagem" class="form-label">Imagem:</label>
            <input type="file" class="form-control" id="imagem" name="imagem" accept=".png" required>
        </div>
    </div>

    <input type="hidden" id="estabelecimento_id" name="estabelecimento_id" value="<?= $EstabelecimentoID ?>">

    <div class="mb-3">
        <div class="form-group">
            <label for="categoria_id" class="form-label">Categoria:</label>
            <select class="form-select" id="categoria_id" name="categoria_id" required>
            </select>
        </div>
    </div>

    <div class="mb-3">
        <div class="form-group">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" required rows="3"></textarea>
        </div>
    </div>

    <button type="submit" class="btn btn-primary">Cadastrar</button>
</form>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Carregar Categorias
    fetch('/api/visualizar/categorias')
        .then(response => response.json())
        .then(data => {
            const categoriaSelect = document.getElementById('categoria_id');
            if (data.status === 'success' && Array.isArray(data.categorias.results)) {
                data.categorias.results.forEach(categoria => {
                    const option = document.createElement('option');
                    option.value = categoria.id;
                    option.textContent = categoria.nome;
                    categoriaSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Erro ao carregar categorias:', error));
});
</script>
