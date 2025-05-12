<?php

@require_once __DIR__ . '/Database.php';

class ProdutosModel
{
    /**
     * Busca um produto pelo ID.
     */
    public function findById($id_produto)
    {
        $db = new Database();
        $sql = "SELECT * FROM produtos WHERE id_produto = :id_produto";
        $params = [':id_produto' => $id_produto];
        return $db->execute_query($sql, $params);
    }

    /**
     * Retorna todos os usuários da tabela.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM produtos";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo produto no banco de dados.
     */
    public function insert($nome, $descricao, $valor, $id_estabelecimento)
    {
        $db = new Database();
        $sql = "INSERT INTO produtos (nome, descricao, valor, id_estabelecimento)
                VALUES (:nome, :descricao, :valor, :id_estabelecimento)";
        $params = [
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':id_estabelecimento' => $id_estabelecimento,
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um produto existente.
     */
    public function update($id, $nome, $descricao, $valor, $id_estabelecimento)
    {
        $db = new Database();
        $sql = "UPDATE produtos SET 
                    nome = :nome, 
                    descricao = :descricao, 
                    valor = :valor, 
                    id_estabelecimento = :id_estabelecimento
                WHERE id_produto = :id";
        $params = [
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':id_estabelecimento' => $id_estabelecimento,
            ':id' => $id
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Deleta um produto com base no ID.
     */
    public function delete($id)
    {
        $db = new Database();
        $sql = "DELETE FROM produtos WHERE id_produto = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }

}
