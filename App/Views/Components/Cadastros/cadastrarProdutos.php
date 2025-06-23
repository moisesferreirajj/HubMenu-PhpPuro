<div class="modal fade" id="cadastrarModal" tabindex="-1" aria-labelledby="cadastrarModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <form class="pro_frm" method="POST" action="/api/produtos/cadastrar" enctype="multipart/form-data">
        <div class="modal-header">
          <h5 class="modal-title" id="cadastrarModalLabel">Cadastrar Produto</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>

        <div class="modal-body">
          <div class="row mb-3 sla">
            <div class="col-md-6 mb-3">
              <label for="nome" class="form-label">Nome do Produto:</label>
              <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-6 mb-3">
              <label for="valor" class="form-label">Valor:</label>
              <div class="input-group" id="valor-group">
                <span class="input-group-text">R$</span>
                <input type="number" class="form-control" id="valor" name="valor" placeholder="0,00" required step="0.01">
              </div>
            </div>
          </div>

          <div class="mb-3">
            <label for="imagem" class="form-label">Imagem:</label>
            <input type="file" class="form-control" id="imagem" name="imagem" required>
          </div>

          <input type="hidden" id="estabelecimento_id" name="estabelecimento_id" value="<?= $EstabelecimentoID ?>">

          <div class="mb-3">
            <label for="categoria_id" class="form-label">Categoria:</label>
            <select class="form-select" id="categoria_id" name="categoria_id" required>
              <!-- Preenchido via JS -->
            </select>
          </div>

          <div class="mb-3">
            <label for="descricao" class="form-label">Descrição:</label>
            <textarea class="form-control" id="descricao" name="descricao" required rows="3"></textarea>
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

<script>
  document.addEventListener('DOMContentLoaded', function () {
    fetch('/api/visualizar/categorias')
      .then(response => {
        if (!response.ok) {
          throw new Error(`Erro na API: ${response.status}`);
        }
        return response.json();
      })
      .then(data => {
        const select = document.getElementById('categoria_id');
        select.innerHTML = ''; // Limpa o select antes de preencher
        if (data.status === 'success' && Array.isArray(data.categorias.results)) {
          data.categorias.results.forEach(c => {
            const opt = document.createElement('option');
            opt.value = c.id;
            opt.textContent = c.nome;
            select.appendChild(opt);
          });
        } else {
          console.error('Erro ao carregar categorias:', data.message || 'Resposta inválida');
        }
      })
      .catch(error => console.error('Erro ao carregar categorias:', error));
  });

  document.getElementById('cadastrarModal').addEventListener('hidden.bs.modal', function () {
    document.body.classList.remove('modal-open');
    const backdrop = document.querySelector('.modal-backdrop');
    if (backdrop) backdrop.remove();
  });
</script>
