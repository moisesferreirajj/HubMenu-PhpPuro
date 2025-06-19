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
     * Busca um produto pelo ID.
     */
    public function findOrderProdById($id)
    {
        $db = new Database();
        // Consulta para obter produtos associados ao pedido
        $sql = "SELECT 
                pp.pedido_id,
                pp.quantidade,
                pp.preco_unitario,
                pr.id AS produto_id,
                pr.nome,
                pr.descricao,
                pr.imagem,
                c.nome AS categoria_nome
            FROM 
                pedidos_produtos pp
            JOIN 
                produtos pr ON pp.produto_id = pr.id
            LEFT JOIN 
                categorias c ON pr.categoria_id = c.id
            WHERE 
                pp.pedido_id = :id";
        $params = [':id' => $id];
        
        // Executa a consulta
        $result = $db->execute_query($sql, $params);
        
        // Retorna os resultados ou um array vazio se não houver resultados
        return $result->results ?? []; // Usando o operador null coalescing para simplificar
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

    //Ativar & Desativar - QUERY BASICA
    public function desativarProduto($id)
    {
        $db = new Database();
        $sql = "UPDATE produtos SET status_produtos = 0 WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }

    public function ativarProduto($id)
    {
        $db = new Database();
        $sql = "UPDATE produtos SET status_produtos = 1 WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }

public function searchByEstabelecimentoAndQuery($estabelecimento_id, $query)
{
    $db = new Database();
    $query = "%$query%";
    $sql = "SELECT * FROM produtos WHERE estabelecimento_id = :estabelecimento_id AND nome LIKE :query AND status_produtos = 1";
    $params = [
        ':estabelecimento_id' => $estabelecimento_id,
        ':query' => $query,
    ];
    $result = $db->execute_query($sql, $params);
    return $result->results ? $result->results : [];
}

public function searchByEstabelecimentoAndCondition($estabelecimento_id)
{
    $db = new Database();
    $sql = "SELECT p.id,p.nome, p.descricao, p.valor, p.imagem FROM produtos p JOIN estabelecimentos e ON p.estabelecimento_id = e.id WHERE e.id = :id AND p.status_produtos = 1;";
    $params = [
        ':id' => $estabelecimento_id,
    ];
    $result = $db->execute_query($sql, $params);
    return $result->results ? $result->results : [];
}

}