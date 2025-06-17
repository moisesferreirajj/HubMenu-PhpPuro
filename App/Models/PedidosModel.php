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
        $query = "SELECT p.id as id, u.nome as nome 
                FROM pedidos p 
                JOIN usuarios u ON p.usuario_id = u.id 
                WHERE p.estabelecimento_id = :id 
                GROUP BY p.id";
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

    public function insert($nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id)
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos (nome, descricao, valor, imagem, estabelecimento_id, categoria_id)
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


    // Agrupa os produtos por pedido

}
?>