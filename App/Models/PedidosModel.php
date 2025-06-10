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

    public function getOrderByCompanyId($id) {
        $query = "SELECT DISTINCT * FROM pedidos p JOIN pedidos_produtos pp ON pp.pedido_id = p.id JOIN estabelecimentos e ON e.id = p.estabelecimento_id JOIN usuarioS u ON p.usuario_id = u.id WHERE e.id = :id GROUP BY p.id";
        $params = [':id' => $id];
        $result = $this->db->execute_query($query, $params);
        return $result->results ? $result->results : [];
    }
    public function getOrderByUser($id) {
        $query = "SELECT * FROM pedidos WHERE id = :id";
        $params = [':id' => $id];
        $result = $this->db->execute_query($query, $params);
        return $result->results ? $result->results[0] : null;
    }



    // Agrupa os produtos por pedido

}
?>