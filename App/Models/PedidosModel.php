<?php

require_once __DIR__ . '/Database.php';

class PedidosModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getOrders() {
        $query = "SELECT * FROM pedidos";
        $result = $this->db->execute_query($query);
        return $result->results; // retorna apenas os resultados
    }

    public function getOrderById($id) {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $params = [':id' => $id];
        $result = $this->db->execute_query($query, $params);
        return $result->results ? $result->results[0] : null;
    }

    public function getOrdersProducts() {
        $sql = "SELECT 
                p.id AS pedido_id,
                u.nome AS cliente_nome,
                p.observacao AS pedido_observacao,
                pr.nome AS produto_nome,
                pp.quantidade,
                pp.preco_unitario
            FROM pedidos p
            JOIN usuarios u ON u.id = p.usuario_id
            JOIN pedidos_produtos pp ON pp.pedido_id = p.id
            JOIN produtos pr ON pr.id = pp.produto_id
            ORDER BY p.id DESC";
        $result = $this->db->execute_query($sql);
        return $result->results;
    }

    // Agrupa os produtos por pedido
    public function agruparProdutosPorPedido($pedidos) {
        $pedidosAgrupados = [];
        foreach ($pedidos as $row) {
            $id = $row->pedido_id;
            if (!isset($pedidosAgrupados[$id])) {
                $pedidosAgrupados[$id] = [
                    'id' => $id,
                    'cliente' => $row->cliente_nome,
                    'observacao' => $row->pedido_observacao,
                    'produtos' => []
                ];
            }
            $pedidosAgrupados[$id]['produtos'][] = [
                'nome' => $row->produto_nome,
                'quantidade' => $row->quantidade,
                'preco_unitario' => $row->preco_unitario
            ];
        }
        return $pedidosAgrupados;
    }
}
?>