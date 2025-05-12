<?php

@require_once __DIR__ . '/Database.php';

class PedidosModel
{
    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id_pedido)
    {
        $db = new Database();
        $sql = "SELECT * FROM pedidos WHERE id_pedido = :id_pedido";
        $params = [':id_pedido' => $id_pedido];
        return $db->execute_query($sql, $params);
    }

    /**
     * Retorna todos os usuários da tabela.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM pedidos";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($id_usuario, $id_produto, $observacao = null, $avaliacao = null, $valor_total)
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos (id_usuario, id_produto, observacao, avaliacao, valor_total)
                VALUES (:id_usuario, :id_produto, :observacao, :avaliacao, :valor_total)";
        $params = [
            ':id_usuario' => $id_usuario,
            ':id_produto' => $id_produto,
            ':observacao' => $observacao,
            ':avaliacao' => $avaliacao,
            ':valor_total' => $valor_total
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update($id_pedido, $id_usuario, $id_produto, $observacao, $avaliacao, $valor_total)
    {
        $db = new Database();
        $sql = "UPDATE pedidos SET 
                    id_usuario = :id_usuario, 
                    id_produto = :id_produto, 
                    observacao = :observacao, 
                    avaliacao = :avaliacao, 
                    valor_total = :valor_total, 
                    telefone = :telefone
                WHERE id_pedido = :id_pedido";
        $params = [
            ':id_usuario' => $id_usuario,
            ':id_produto' => $id_produto,
            ':observacao' => $observacao,
            ':avaliacao' => $avaliacao,
            ':valor_total' => $valor_total,
            ':id_pedido' => $id_pedido
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Deleta um usuário com base no ID.
     */
    public function delete($id_pedido)
    {
        $db = new Database();
        $sql = "DELETE FROM pedidos WHERE id_pedido = :id_pedido";
        $params = [':id_pedido' => $id_pedido];
        return $db->execute_non_query($sql, $params);
    }
}
