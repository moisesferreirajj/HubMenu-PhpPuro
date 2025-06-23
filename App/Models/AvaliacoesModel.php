<?php

class AvaliacoesModel
{

    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM avaliacoes WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Busca todos os avaliacoes do banco.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM avaliacoes";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($usuario_id, $estabelecimento_id, $avaliacao, $data_avaliacao, $comentario = null)
    {

        $db = new Database();
        $sql = "INSERT INTO avaliacoes (usuario_id, estabelecimento_id, avaliacao, comentario, data_avaliacao)
                VALUES (:usuario_id, :estabelecimento_id, :avaliacao, :comentario, :data_avaliacao)";
        $params = [
            ':usuario_id' => $usuario_id,
            ':estabelecimento_id' => $estabelecimento_id,
            ':avaliacao' => $avaliacao,
            ':comentario' => $comentario,
            ':data_avaliacao' => $data_avaliacao
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update($id, $usuario_id, $estabelecimento_id, $avaliacao, $data_avaliacao, $comentario = null)
    {
        $db = new Database();
        $sql = "UPDATE avaliacoes SET 
                    usuario_id = :usuario_id, 
                    estabelecimento_id = :estabelecimento_id, 
                    avaliacao = :avaliacao, 
                    comentario = :comentario, 
                    data_avaliacao = :data_avaliacao
                WHERE id = :id";
        $params = [
            ':usuario_id' => $usuario_id,
            ':estabelecimento_id' => $estabelecimento_id,
            ':avaliacao' => $avaliacao,
            ':comentario' => $comentario,
            ':data_avaliacao' => $data_avaliacao,
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
        $sql = "DELETE FROM avaliacoes WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }

    public function getByEstabelecimento($estabelecimento_id, $limit = 10)
    {
        $db = new Database();
        $sql = "SELECT a.*, u.nome as usuario_nome
            FROM avaliacoes a
            INNER JOIN usuarios u ON a.usuario_id = u.id
            WHERE a.estabelecimento_id = :estabelecimento_id
            ORDER BY a.data_avaliacao DESC
            LIMIT $limit";
        $params = [
            ':estabelecimento_id' => $estabelecimento_id,
        ];

        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }
}
