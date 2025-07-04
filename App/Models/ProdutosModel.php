<?php

class ProdutosModel
{
    /**
     * Busca um produto pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM produtos WHERE id = :id";
        $params = [':id' => intval($id)];
        $result = $db->execute_query($sql, $params);
        return $result->results[0] ?? [];
    }

    /**
     * Busca produtos associados a um pedido pelo ID.
     */
    public function findOrderProdById($id)
    {
        $db = new Database();
        $sql = "SELECT pp.pedido_id, pp.quantidade, pp.preco_unitario, pr.id AS produto_id, pr.nome, pr.descricao, pr.imagem, c.nome AS categoria_nome
                FROM pedidos_produtos pp
                JOIN produtos pr ON pp.produto_id = pr.id
                LEFT JOIN categorias c ON pr.categoria_id = c.id
                WHERE pp.pedido_id = :id";
        $params = [':id' => intval($id)];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }

    /**
     * Busca produtos pelo ID do Estabelecimento.
     */
    public function findByEstabelecimentoId($estabelecimento_id)
    {
        $db = new Database();
        $sql = "SELECT p.*, c.nome AS categoria_nome, e.nome AS estabelecimento_nome
            FROM produtos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            LEFT JOIN estabelecimentos e ON p.estabelecimento_id = e.id
            WHERE p.estabelecimento_id = :estabelecimento_id
            ORDER BY p.status_produtos DESC, p.nome ASC"; // Ativos primeiro, depois inativos
        $params = [':estabelecimento_id' => intval($estabelecimento_id)];
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
    public function insert($nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id, $status_produtos)
    {
        $db = new Database();
        $sql = "INSERT INTO produtos (nome, descricao, valor, imagem, estabelecimento_id, categoria_id, status_produtos)
                VALUES (:nome, :descricao, :valor, :imagem, :estabelecimento_id, :categoria_id, :status_produtos)";
        $params = [
            ':nome' => trim($nome),
            ':descricao' => trim($descricao),
            ':valor' => floatval($valor),
            ':imagem' => $imagem,
            ':estabelecimento_id' => intval($estabelecimento_id),
            ':categoria_id' => intval($categoria_id),
            ':status_produtos' => intval($status_produtos)
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um produto existente.
     */
    public function update($id, $nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id, $status_produtos)
    {
        $db = new Database();

        if ($imagem !== null) {
            $sql = "UPDATE produtos SET 
                    nome = :nome, 
                    descricao = :descricao, 
                    valor = :valor, 
                    imagem = :imagem,
                    status_produtos = :status_produtos,
                    estabelecimento_id = :estabelecimento_id, 
                    categoria_id = :categoria_id 
                WHERE id = :id";
            $params = [
                ':id' => intval($id),
                ':nome' => trim($nome),
                ':descricao' => trim($descricao),
                ':valor' => floatval($valor),
                ':imagem' => $imagem,
                ':status_produtos' => intval($status_produtos),
                ':estabelecimento_id' => intval($estabelecimento_id),
                ':categoria_id' => intval($categoria_id)
            ];
        } else {
            $sql = "UPDATE produtos SET 
                    nome = :nome, 
                    descricao = :descricao, 
                    valor = :valor, 
                    status_produtos = :status_produtos,
                    estabelecimento_id = :estabelecimento_id, 
                    categoria_id = :categoria_id 
                WHERE id = :id";
            $params = [
                ':id' => intval($id),
                ':nome' => trim($nome),
                ':descricao' => trim($descricao),
                ':valor' => floatval($valor),
                ':status_produtos' => intval($status_produtos),
                ':estabelecimento_id' => intval($estabelecimento_id),
                ':categoria_id' => intval($categoria_id)
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

        $param = [':id' => intval($id)];

        // 1º: remove produtos relacionados nos pedidos
        $deletePedidosProdutos = $db->execute_non_query("DELETE FROM pedidos_produtos WHERE produto_id = :id", $param);

        // 2º: agora é seguro excluir o produto
        $deleteProduto = $db->execute_non_query("DELETE FROM produtos WHERE id = :id", $param);

        // Retorna verdadeiro apenas se ambos deram certo
        return $deleteProduto;
    }

    /**
     * Desativa um produto.
     */
    public function desativarProduto($id)
    {
        $db = new Database();
        $sql = "UPDATE produtos SET status_produtos = 0 WHERE id = :id";
        $params = [':id' => intval($id)];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Ativa um produto.
     */
    public function ativarProduto($id)
    {
        $db = new Database();
        $sql = "UPDATE produtos SET status_produtos = 1 WHERE id = :id";
        $params = [':id' => intval($id)];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Busca produtos inativos por ID do estabelecimento.
     */
    /**
     * Busca produtos inativos de um estabelecimento específico.
     *
     * @param int $estabelecimento_id
     * @return array Lista de produtos inativos (como objetos)
     */
    public function listarDesativados($estabelecimento_id)
    {
        try {
            $estabelecimento_id = intval($estabelecimento_id);
            error_log("Executando listarDesativados com estabelecimento_id: $estabelecimento_id");

            $db = new Database();
            $sql = "
            SELECT p.*, c.nome AS categoria_nome 
            FROM produtos p
            LEFT JOIN categorias c ON p.categoria_id = c.id
            WHERE p.estabelecimento_id = :estabelecimento_id
              AND p.status_produtos = 0
        ";

            $params = [':estabelecimento_id' => $estabelecimento_id];
            $result = $db->execute_query($sql, $params);

            $produtos = $result->results ?? [];
            error_log('Produtos inativos encontrados: ' . count($produtos));

            return $produtos;
        } catch (Exception $e) {
            error_log('Erro ao listar produtos inativos: ' . $e->getMessage());
            return [];
        }
    }


    /**
     * Busca produtos por termo de pesquisa e ID do estabelecimento.
     */
    public function searchByEstabelecimentoAndQuery($estabelecimento_id, $query)
    {
        $db = new Database();
        $query = "%" . trim($query) . "%";
        $sql = "SELECT * FROM produtos
                WHERE estabelecimento_id = :estabelecimento_id AND nome LIKE :query AND status_produtos = 1";
        $params = [
            ':estabelecimento_id' => intval($estabelecimento_id),
            ':query' => $query,
        ];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }

    /**
     * Busca produtos por condição e ID do estabelecimento.
     */
    public function searchByEstabelecimentoAndCondition($estabelecimento_id)
    {
        $db = new Database();
        $sql = "SELECT p.id, p.nome, p.descricao, p.valor, p.imagem
                FROM produtos p
                JOIN estabelecimentos e ON p.estabelecimento_id = e.id
                WHERE e.id = :id";
        $params = [':id' => intval($estabelecimento_id)];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }
}
