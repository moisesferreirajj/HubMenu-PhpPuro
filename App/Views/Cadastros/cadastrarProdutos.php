<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Produto</title>
</head>
<body>
    <h1>Cadastrar Produto</h1>
    <form method="POST" action="/api/produtos/cadastrar">
        <label for="nome">Nome do Produto:</label><br>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="descricao">Descrição:</label><br>
        <textarea id="descricao" name="descricao" required></textarea><br><br>

        <label for="valor">Valor:</label><br>
        <input type="number" id="valor" name="valor" required><br><br>

        <label for="id_estabelecimento">ID do Estabelecimento:</label><br>
        <input type="text" id="id_estabelecimento" name="id_estabelecimento" required><br><br>

        <button type="submit">Cadastrar</button>
    </form>
</body>
</html>
