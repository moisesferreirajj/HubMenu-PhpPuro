<!-- Modal para editar produto -->
<form method="POST" action="/api/produtos/editar" enctype="multipart/form-data">
  <div class="modal-body">
    <input type="hidden" id="edit_id" name="id">
    <input type="hidden" id="edit_estabelecimento_id" name="estabelecimento_id">

    <label for="edit_nome">Nome do Produto:</label><br>
    <input type="text" id="edit_nome" name="nome" required><br><br>

    <label for="edit_descricao">Descrição:</label><br>
    <textarea id="edit_descricao" name="descricao"></textarea><br><br>

    <label for="edit_valor">Valor:</label><br>
    <input type="number" id="edit_valor" name="valor" step="0.01"><br><br>

    <label for="edit_imagem">Imagem (.png):</label><br>
    <input type="file" id="edit_imagem" name="imagem" accept=".png"><br>
    <small id="imagemAtualInfo" style="color: gray;"></small><br><br>

    <label for="edit_categoria_id">Categoria:</label><br>
    <select id="edit_categoria_id" name="categoria_id"></select><br><br>
  </div>
  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
    <button type="submit" class="btn btn-primary">Salvar alterações</button>
  </div>
</form>

<script>
async function carregarSelectsEdit(categoriaAtual) {
  try {
    const catResp = await fetch('/api/visualizar/categorias').then(r => r.json());
    const catSelect = document.getElementById('edit_categoria_id');
    catSelect.innerHTML = '';

    if (catResp.status === 'success' && Array.isArray(catResp.categorias.results)) {
      catResp.categorias.results.forEach(c => {
        const opt = document.createElement('option');
        opt.value = c.id;
        opt.textContent = c.nome;
        if (c.id == categoriaAtual) opt.selected = true;
        catSelect.appendChild(opt);
      });
    }
  } catch (error) {
    console.error('Erro ao carregar categorias:', error);
  }
}

document.querySelectorAll('.edit-button').forEach((button) => {
  button.addEventListener('click', async () => {
    const card = button.closest('.card');

    const nome = card.querySelector('.card-title').textContent.trim();
    const valorTexto = card.querySelector('.price-tag').textContent.replace('R$', '').trim();
    const valor = parseFloat(valorTexto.replace('.', '').replace(',', '.'));
    const categoriaId = card.querySelector('.category-badge').getAttribute('data-id');
    const descricao = card.getAttribute('data-descricao');
    const produtoId = card.getAttribute('data-id');
    const estabelecimentoId = card.getAttribute('data-estabelecimento-id');
    const imagemNome = card.getAttribute('data-imagem');

    await carregarSelectsEdit(categoriaId);

    document.getElementById('edit_id').value = produtoId;
    document.getElementById('edit_estabelecimento_id').value = estabelecimentoId;
    document.getElementById('edit_nome').value = nome;
    document.getElementById('edit_valor').value = valor.toFixed(2);
    document.getElementById('edit_descricao').value = descricao || '';

    const imagemInfo = document.getElementById('imagemAtualInfo');
    if (imagemNome) {
      imagemInfo.textContent = 'Imagem atual: ' + imagemNome;
    } else {
      imagemInfo.textContent = '';
    }

    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
  });
});
</script>
