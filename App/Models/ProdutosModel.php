<?php

@require_once __DIR__ . '/Database.php';

class ProdutosModel
{
    /**
     * Busca um produto pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

     /**
     * Busca os produtos pelo ID do Estabelecimento.
     */
    public function findByEstabelecimentoId($estabelecimento_id)
    {
        $db = new Database();
        $sql = "SELECT * FROM produtos WHERE estabelecimento_id = :estabelecimento_id";
        $params = [':estabelecimento_id' => $estabelecimento_id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Retorna todos os produtos da tabela.
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
    public function insert($nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id)
    {
        $db = new Database();
        $sql = "INSERT INTO produtos (nome, descricao, valor, imagem, estabelecimento_id, categoria_id)
                VALUES (:nome, :descricao, :valor, :imagem, :estabelecimento_id, :categoria_id)";
        $params = [
            ':nome' => $nome,
            ':descricao' => $descricao,
            ':valor' => $valor,
            ':imagem' => $imagem,
            ':estabelecimento_id' => $estabelecimento_id,
            ':categoria_id' => $categoria_id
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um produto existente.
     */
    public function update($id, $nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id)
    {
        $db = new Database();

        // Atualizar somente se imagem não for null
        if ($imagem !== null) {
            $sql = "UPDATE produtos SET 
                        nome = :nome, 
                        descricao = :descricao, 
                        valor = :valor, 
                        imagem = :imagem,
                        estabelecimento_id = :estabelecimento_id,
                        categoria_id = :categoria_id
                    WHERE id = :id";
            $params = [
                ':id' => $id,
                ':nome' => $nome,
                ':descricao' => $descricao,
                ':valor' => $valor,
                ':imagem' => $imagem,
                ':estabelecimento_id' => $estabelecimento_id,
                ':categoria_id' => $categoria_id
            ];
        } else {
            $sql = "UPDATE produtos SET 
                        nome = :nome, 
                        descricao = :descricao, 
                        valor = :valor, 
                        estabelecimento_id = :estabelecimento_id,
                        categoria_id = :categoria_id
                    WHERE id = :id";
            $params = [
                ':id' => $id,
                ':nome' => $nome,
                ':descricao' => $descricao,
                ':valor' => $valor,
                ':estabelecimento_id' => $estabelecimento_id,
                ':categoria_id' => $categoria_id
            ];
        }

        return $db->execute_non_query($sql, $params);
    }

    /**
     * Deleta um produto com base no ID.
     */
    public function delete($id)
    {
        $db = new Database();
        $sql = "DELETE FROM produtos WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }
}