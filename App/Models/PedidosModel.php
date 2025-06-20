<?php

class PedidosModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }

    public function getOrders()
    {
        $query = "SELECT * FROM pedidos";
        $result = $this->db->execute_query($query);
        return $result->results; // retorna apenas os resultados
    }

    public function getOrderByCompanyId($id)
    {
        $query = "SELECT 
                p.id,
                p.valor_total,
                p.observacao,
                p.avaliacao,
                p.data_pedido,
                u.nome
            FROM 
                pedidos p
            JOIN 
                usuarios u ON p.usuario_id = u.id
            JOIN 
                estabelecimentos e ON p.estabelecimento_id = e.id
            WHERE 
                p.estabelecimento_id = :id
            ORDER BY 
                p.data_pedido DESC";
        $params = [':id' => $id];
        $result = $this->db->execute_query($query, $params);
        return $result->results;
    }

    public function getOrderByUser($id)
    {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $params = [':id' => $id];
        $result = $this->db->execute_query($query, $params);
        return $result->results ? $result->results[0] : null;
    }

    public function registerOrder()
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos (nome, descricao, valor, imagem, estabelecimento_id, categoria_id)
                VALUES (:nome, :descricao, :valor, :imagem, :estabelecimento_id, :categoria_id)";
        $params = [];
        return $db->execute_non_query($sql, $params);
    }

    public function registerGuestClient($nome_cliente)
    {
        $db = new Database();
        $sql = "INSERT INTO usuarios (nome) VALUES (:nome)";
        $params = [':nome' => $nome_cliente];
        $result = $this->db->execute_query($sql, $params);
        return $result->results ?? null;
    }

    public function registerOrderProducts($productId, $quantity)
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos_produtos (produto_id)
                VALUES ( :produto_id)";
        $params = [
            ':produto_id' => $productId,
        ];
        return $db->execute_non_query($sql, $params);
    }

    // Agrupa os produtos por pedido


    public function getOrderDetailsByCompanyId($id)
    {
        $db = new Database();
        $sql = "SELECT p.*, u.nome as cliente_nome, e.nome as estabelecimento_nome
            FROM pedidos p
            JOIN usuarios u ON p.usuario_id = u.id
            JOIN estabelecimentos e ON p.estabelecimento_id = e.id
            WHERE p.estabelecimento_id = :id";
        $params = [':id' => $id];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }

    // Pedidos recentes
    public function getRecentOrdersByCompanyId($id, $limit = 10)
    {
        $db = new Database();
        $limit = (int)$limit; // Garante que é inteiro
        $sql = "SELECT p.id, p.usuario_id, p.estabelecimento_id, p.observacao,
        p.avaliacao, p.valor_total, p.data_pedido,
        u.nome as cliente_nome,
        e.nome as estabelecimento_nome
        FROM pedidos p
        INNER JOIN usuarios u ON p.usuario_id = u.id
        INNER JOIN estabelecimentos e ON p.estabelecimento_id = e.id
        WHERE p.estabelecimento_id = :id
        ORDER BY p.data_pedido DESC
        LIMIT $limit";
        $params = [':id' => $id];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }
}
