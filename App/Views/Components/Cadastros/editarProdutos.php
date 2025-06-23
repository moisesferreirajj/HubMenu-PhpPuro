<!-- Modal de Edição -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <form method="POST" action="/api/produtos/editar" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Editar Produto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body">
          <input type="hidden" id="edit_id" name="id">
          <input type="hidden" id="edit_estabelecimento_id" name="estabelecimento_id">

          <div class="mb-3">
            <label for="edit_nome" class="form-label">Nome do Produto</label>
            <input type="text" class="form-control" id="edit_nome" name="nome" required>
          </div>

          <div class="mb-3">
            <label for="edit_descricao" class="form-label">Descrição</label>
            <textarea class="form-control" id="edit_descricao" name="descricao" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label for="edit_valor" class="form-label">Valor</label>
            <input type="number" class="form-control" id="edit_valor" name="valor" step="0.01" required>
          </div>

          <div class="mb-3">
            <label for="edit_imagem" class="form-label">Imagem</label>
            <input class="form-control" type="file" id="edit_imagem" name="imagem">
            <div class="form-text text-muted" id="imagemAtualInfo"></div>
          </div>

          <div class="mb-3">
            <label for="edit_categoria_id" class="form-label">Categoria</label>
            <select class="form-select" id="edit_categoria_id" name="categoria_id" required>
              <!-- Preenchido via JS -->
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" name="acao" value="salvar" class="btn btn-primary">Salvar alterações</button>
          <button type="button" name="acao" value="excluir" class="btn btn-danger" id="btnExcluir">Excluir</button>
          <button type="button" name="acao" value="desativar" class="btn btn-secondary" id="btnDesativar">Desativar</button>
        </div>
      </form>
    </div>
  </div>
  </div>

<!-- Script para preencher o modal -->
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
        if (parseInt(c.id) === parseInt(categoriaAtual)) opt.selected = true;
        catSelect.appendChild(opt);
      });
    }
  } catch (error) {
    console.error('Erro ao carregar categorias:', error);
  }
}

document.querySelectorAll('.edit-button').forEach(button => {
  button.addEventListener('click', async () => {
    const card = button.closest('.card');

    const nome = card.querySelector('.card-title')?.textContent.trim();
    const valorTexto = card.querySelector('.price-tag')?.textContent.replace('R$', '').trim();
    const valor = parseFloat(valorTexto.replace('.', '').replace(',', '.'));
    const categoriaId = card.querySelector('.category-badge')?.getAttribute('data-id');
    const descricao = card.getAttribute('data-descricao') || '';
    const produtoId = card.getAttribute('data-id');
    const estabelecimentoId = card.getAttribute('data-estabelecimento-id');
    const imagemNome = card.getAttribute('data-imagem');

    await carregarSelectsEdit(categoriaId);

    document.getElementById('edit_id').value = produtoId;
    document.getElementById('edit_estabelecimento_id').value = estabelecimentoId;
    document.getElementById('edit_nome').value = nome;
    document.getElementById('edit_valor').value = valor.toFixed(2);
    document.getElementById('edit_descricao').value = descricao;

    const imagemInfo = document.getElementById('imagemAtualInfo');
    imagemInfo.textContent = imagemNome ? 'Imagem atual: ' + imagemNome : '';

    const modal = new bootstrap.Modal(document.getElementById('editModal'));
    modal.show();
  });
});

// Limpeza do backdrop
document.getElementById('editModal').addEventListener('hidden.bs.modal', function () {
  document.body.classList.remove('modal-open');
  const backdrop = document.querySelector('.modal-backdrop');
  if (backdrop) backdrop.remove();
});

document.getElementById('btnExcluir').addEventListener('click', async () => {
    const id = document.getElementById('edit_id').value;

    if (!id) {
        alert('ID do produto não encontrado.');
        return;
    }

    if (confirm('Tem certeza que deseja excluir este produto?')) {
        try {
            // Envia como form-urlencoded (igual ao submit tradicional)
            const formData = new FormData();
            formData.append('id', id);

            const response = await fetch('/api/produtos/excluir', {
                method: 'POST',
                body: formData
            });

            const data = await response.json();

            if (data.status === 'success') {
                alert(data.message);
                location.reload();
            } else {
                alert('Erro: ' + data.message);
            }
        } catch (error) {
            alert('Erro ao comunicar com o servidor: ' + error.message);
            console.error(error);
        }
    }
});

document.getElementById('btnDesativar').addEventListener('click', async () => {
  const id = document.getElementById('edit_id').value;
  await fetch('/api/produtos/desativar', {
    method: 'POST',
    headers: {'Content-Type': 'application/json'},
    body: JSON.stringify({id})
  });
  location.reload(); // Ou atualize a UI
});


</script>
