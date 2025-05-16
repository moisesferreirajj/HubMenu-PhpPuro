<?php

require_once __DIR__ . '/Database.php';

class VendasModel
{

    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM vendas WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Busca todos os vendas do banco.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM vendas";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($referencia, $transacao_id, $status_pagamento, $estabelecimento_id, $valor_total, $data_venda)
    {

        $db = new Database();
        $sql = "INSERT INTO vendas (referencia, transacao_id, status_pagamento, estabelecimento_id, valor_total, data_venda)
                VALUES (:referencia, :transacao_id, :status_pagamento, :estabelecimento_id, :valor_total, :data_venda)";
        $params = [
            ':referencia' => $referencia,
            ':transacao_id' => $transacao_id,
            ':status_pagamento' => $status_pagamento,
            ':estabelecimento_id' => $estabelecimento_id,
            ':valor_total' => $valor_total,
            ':data_venda' => $data_venda
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update($id, $referencia, $transacao_id, $status_pagamento, $estabelecimento_id, $valor_total, $data_venda)
    {
        $db = new Database();
        $sql = "UPDATE vendas SET 
                    referencia = :referencia,
                    transacao_id = :transacao_id,
                    status_pagamento = :status_pagamento,
                    estabelecimento_id = :estabelecimento_id,
                    valor_total = :valor_total,
                    data_venda = :data_venda
                WHERE id = :id";
        $params = [
            ':referencia' => $referencia,
            ':transacao_id' => $transacao_id,
            ':status_pagamento' => $status_pagamento,
            ':estabelecimento_id' => $estabelecimento_id,
            ':valor_total' => $valor_total,
            ':data_venda' => $data_venda,
            ':id' => $id
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Deleta um usuário com base no ID.
     */
    public function delete($id)
    {
        $db = new Database();
        $sql = "DELETE FROM vendas WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }
}
