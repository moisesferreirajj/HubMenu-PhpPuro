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
        return $result->results ?? []; // retorna apenas os resultados
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
        return $result->results ?? [];
    }

    public function getOrderByUser($id)
    {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $params = [':id' => $id];
        $result = $this->db->execute_query($query, $params);
        return $result->results ? $result->results[0] : null;
    }

    public function registerOrder($dados)
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos (usuario_id, estabelecimento_id, valor_total, status, data_pedido)
                VALUES (:usuario_id, :estabelecimento_id, :valor_total, :status, :data_pedido)";
        $params = [
            ':usuario_id' => $dados['usuario_id'],
            ':estabelecimento_id' => $dados['estabelecimento_id'],
            ':valor_total' => $dados['valor_total'],
            ':status' => $dados['status'],
            ':data_pedido' => $dados['data_pedido'],
        ];
        $result = $db->execute_non_query($sql, $params);
        return $result->last_id; // Retorna o ID do pedido inserido
    }

    public function registerGuestClient($nome_cliente)
    {
        $db = new Database();
        $sql = "INSERT INTO usuarios (nome) VALUES (:nome)";
        $params = [':nome' => $nome_cliente];
        $result = $db->execute_non_query($sql, $params);
        return $result->last_id; // Aqui você pega o ID gerado
    }

    public function registerOrderProducts($pedidoId, $productId, $quantidade, $preco_unitario)
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade, preco_unitario)
                VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario)";
        $params = [
            ':pedido_id' => $pedidoId,
            ':produto_id' => $productId,
            ':quantidade' => $quantidade,
            ':preco_unitario' => $preco_unitario
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
