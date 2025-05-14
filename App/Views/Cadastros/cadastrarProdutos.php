<form method="POST" action="/api/produtos/cadastrar" enctype="multipart/form-data">
    <label for="nome">Nome do Produto:</label><br>
    <input type="text" id="nome" name="nome" required><br><br>

    <label for="descricao">Descrição:</label><br>
    <textarea id="descricao" name="descricao" required></textarea><br><br>

    <label for="valor">Valor:</label><br>
    <input type="number" id="valor" name="valor" required step="0.01"><br><br>

    <label for="imagem">Imagem:</label><br>
    <input type="file" id="imagem" name="imagem" accept=".png" required><br><br>

    <label for="estabelecimento_id">Estabelecimento:</label><br>
    <select id="estabelecimento_id" name="estabelecimento_id" required>
        <!-- As opções serão preenchidas via AJAX -->
    </select><br><br>

    <label for="categoria_id">Categoria:</label><br>
    <select id="categoria_id" name="categoria_id" required>
        <!-- As opções serão preenchidas via AJAX -->
    </select><br><br>

    <button type="submit">Cadastrar</button>
</form>

<script>
// Função para carregar as opções de categorias e estabelecimentos via AJAX
document.addEventListener('DOMContentLoaded', function() {
    // Carregar Estabelecimentos
    fetch('/api/visualizar/estabelecimentos')
        .then(response => response.json())
        .then(data => {
            const estabelecimentoSelect = document.getElementById('estabelecimento_id');
            if (data.status === 'success') {
                data.estabelecimentos.forEach(estabelecimento => {
                    const option = document.createElement('option');
                    option.value = estabelecimento.id;
                    option.textContent = estabelecimento.nome;
                    estabelecimentoSelect.appendChild(option);
                });
            }
        })
        .catch(error => console.error('Erro ao carregar estabelecimentos:', error));

    // Carregar Categorias
    fetch('/api/visualizar/categorias')
        .then(response => response.json())
        .then(data => {
            const categoriaSelect = document.getElementById('categoria_id');
            if (data.status === 'success') {
                data.categorias.forEach(categoria => {
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