<?php
class PedidosModel {
    private $db;

    public function __construct() {
        $this->db = new Database();
    }

    public function getOrderByCompanyId($estabelecimento_id) {
        $sql = "SELECT p.id, p.nome_cliente as nome, p.data_pedido, p.status 
                FROM pedidos p
                WHERE p.estabelecimento_id = :estabelecimento_id
                ORDER BY p.data_pedido DESC";
        
        $params = [':estabelecimento_id' => $estabelecimento_id];
        $result = $this->db->execute_query($sql, $params);
        
        return $result->status === 'success' ? $result->results : [];
    }

    public function findOrderProdById($pedido_id) {
        $sql = "SELECT pp.quantidade, pr.nome, pp.observacao as descricao, pr.valor
                FROM pedidos_produtos pp
                JOIN produtos pr ON pp.produto_id = pr.id
                WHERE pp.pedido_id = :pedido_id";
        
        $params = [':pedido_id' => $pedido_id];
        $result = $this->db->execute_query($sql, $params);
        
        return $result->status === 'success' ? $result->results : [];
    }

    public function cadastrarPedido($dados) {
        $sql = "INSERT INTO pedidos (usuario_id, estabelecimento_id, nome_cliente, valor_total, status, data_pedido) 
                VALUES (:usuario_id, :estabelecimento_id, :nome_cliente, :valor_total, 'pendente', NOW())";
        
        $params = [
            ':usuario_id' => $dados['usuario_id'],
            ':estabelecimento_id' => $dados['estabelecimento_id'],
            ':nome_cliente' => $dados['nome_cliente'],
            ':valor_total' => $dados['valor_total']
        ];
        
        $result = $this->db->execute_non_query($sql, $params);
        
        if ($result->status === 'error') {
            throw new Exception($result->message);
        }
        
        return $result->last_id;
    }

    public function adicionarProdutoPedido($pedido_id, $produto_id, $quantidade, $observacao = null) {
        $sql = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade, preco_unitario, observacao)
                SELECT :pedido_id, :produto_id, :quantidade, p.valor, :observacao
                FROM produtos p
                WHERE p.id = :produto_id";
        
        $params = [
            ':pedido_id' => $pedido_id,
            ':produto_id' => $produto_id,
            ':quantidade' => $quantidade,
            ':observacao' => $observacao
        ];
        
        $result = $this->db->execute_non_query($sql, $params);
        
        if ($result->status === 'error') {
            throw new Exception($result->message);
        }
        
        return $result->affected_rows > 0;
    }

    public function atualizarStatusPedido($pedido_id, $status) {
        $sql = "UPDATE pedidos SET status = :status WHERE id = :pedido_id";
        
        $params = [
            ':pedido_id' => $pedido_id,
            ':status' => $status
        ];
        
        $result = $this->db->execute_non_query($sql, $params);
        
        if ($result->status === 'error') {
            throw new Exception($result->message);
        }
        
        return $result->affected_rows > 0;
    }
}