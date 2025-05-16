


<!-- Modal para editar produto -->
<form method="POST" action="/api/produtos/editar" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" id="edit_id" name="id">

    <label for="edit_nome">Nome do Produto:</label><br>
    <input type="text" id="enome" name="nome" required><br><br>

    <label for="edit_descricao">Descrição:</label><br>
    <textarea id="descricao" name="descricao" required></textarea><br><br>

    <label for="edit_valor">Valor:</label><br>
    <input type="number" id="valor" name="valor" required step="0.01"><br><br>

    <label for="edit_imagem">Imagem:</label><br>
    <input type="file" id="imagem" name="imagem" accept=".png"><br><br>

    <label for="edit_estabelecimento_id">Estabelecimento:</label><br>
    <select id="eestabelecimento_id" name="estabelecimento_id" required></select><br><br>

    <label for="edit_categoria_id">Categoria:</label><br>
    <select id="categoria_id" name="categoria_id" required></select><br><br>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Salvar alterações</button>
  </div>
</form>


<script>
// Preencher categorias e estabelecimentos quando o modal for aberto
async function carregarSelectsEdit() {
    try {
        const [estabelecimentosResp, categoriasResp] = await Promise.all([
            fetch('/api/visualizar/estabelecimentos').then(r => r.json()),
            fetch('/api/visualizar/categorias').then(r => r.json())
        ]);

        const estSelect = document.getElementById('edit_estabelecimento_id');
        const catSelect = document.getElementById('edit_categoria_id');

        estSelect.innerHTML = '';
        catSelect.innerHTML = '';

        if (estabelecimentosResp.status === 'success') {
            estabelecimentosResp.estabelecimentos.forEach(e => {
                const opt = document.createElement('option');
                opt.value = e.id;
                opt.textContent = e.nome;
                estSelect.appendChild(opt);
            });
        }

        if (categoriasResp.status === 'success') {
            categoriasResp.categorias.forEach(c => {
                const opt = document.createElement('option');
                opt.value = c.id;
                opt.textContent = c.nome;
                catSelect.appendChild(opt);
            });
        }
    } catch (error) {
        console.error('Erro ao carregar selects:', error);
    }
}

// Quando clicar no botão de editar
document.querySelectorAll('.edit-button').forEach((button, index) => {
    button.addEventListener('click', async () => {
        await carregarSelectsEdit();

        const card = button.closest('.card');

        const nome = card.querySelector('.card-title').textContent.trim();
        const valorTexto = card.querySelector('.price-tag').textContent.replace('R$', '').trim();
        const valor = parseFloat(valorTexto.replace('.', '').replace(',', '.'));
        const categoriaId = card.querySelector('.category-badge').textContent.trim();
        const imagem = card.querySelector('img').getAttribute('src');
        const produtoId = <?php echo json_encode(array_column($produtos, 'id')); ?>[index];

        // Dados fictícios para simulação – você pode carregar dados completos via AJAX se quiser
        document.getElementById('edit_id').value = produtoId;
        document.getElementById('edit_nome').value = nome;
        document.getElementById('edit_valor').value = valor.toFixed(2);
        document.getElementById('edit_descricao').value = card.getAttribute('data-descricao') || ''; // ou busque via AJAX
        document.getElementById('edit_categoria_id').value = categoriaId;
        // Estabelecimento pode ser carregado via data attribute ou backend
        document.getElementById('edit_estabelecimento_id').value = card.getAttribute('data-estabelecimento-id') || '';

        const modal = new bootstrap.Modal(document.getElementById('editModal'));
        modal.show();
    });
});
</script>

<div class="card h-100 category-drink"
     data-descricao="<?php echo htmlspecialchars($produto->descricao); ?>"
     data-estabelecimento-id="<?php echo htmlspecialchars($produto->estabelecimento_id); ?>">