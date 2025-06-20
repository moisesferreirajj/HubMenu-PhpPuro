<?php

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
    
    public function findByEstabelecimentoId($estabelecimento_id)
    {
        $db = new Database();
        $sql = "SELECT * FROM vendas WHERE estabelecimento_id = :estabelecimento_id";
        $params = [':estabelecimento_id' => $estabelecimento_id];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }

    // Vendas por mês (para gráfico)
    public function getVendasPorMes($estabelecimento_id)
    {
        $db = new Database();
        $sql = "SELECT DATE_FORMAT(data_venda, '%m/%Y') as mes, SUM(valor_total) as total
            FROM vendas
            WHERE estabelecimento_id = :estabelecimento_id
            GROUP BY mes
            ORDER BY data_venda";
        $params = [':estabelecimento_id' => $estabelecimento_id];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }

    // Top estabelecimentos por vendas (ranking geral)
    public function getTopEstabelecimentos($limit = 5)
    {
        $db = new Database();
        $sql = "SELECT e.nome, SUM(v.valor_total) as total_vendas
            FROM vendas v
            JOIN estabelecimentos e ON v.estabelecimento_id = e.id
            GROUP BY v.estabelecimento_id
            ORDER BY total_vendas DESC
            LIMIT :limit";
        $params = [':limit' => $limit];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }
}
