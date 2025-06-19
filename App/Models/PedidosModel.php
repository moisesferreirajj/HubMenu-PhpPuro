<?php

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

    public function getOrderByUser($id) {
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
        $params = [

        ];
        return $db->execute_non_query($sql, $params);
    }

    public function registerGuestClient($nome_cliente){
        $db = new Database();
        $sql = "INSERT INTO usuarios (nome) 
                VALUES (:nome)";
        $params = [
            ':nome' => $nome_cliente,
        ];
        $result = $db->execute_non_query($sql, $params);
    }

    public function registerOrderProducts($productId, $quantity) {
        $db = new Database();
        $sql = "INSERT INTO pedidos_produtos (produto_id, quantidade)
                VALUES ( :produto_id, :quantidade)";
        $params = [
            ':produto_id' => $productId, 
            ':quantidade' => $quantity
        ];
        return $db->execute_non_query($sql, $params);
    }

    // Agrupa os produtos por pedido

}
?>