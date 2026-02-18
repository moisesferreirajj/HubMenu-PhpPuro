<?php

class AvaliacoesSistemaModel
{

    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM avaliacoes_sistema WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Busca todos os avaliacoes_sistema do banco.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM avaliacoes_sistema";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($usuario_id, $estabelecimento_id, $avaliacao, $data_avaliacao, $comentario = null)
    {

        $db = new Database();
        $sql = "INSERT INTO avaliacoes_sistema (usuario_id, avaliacao, comentario, data_avaliacao)
                VALUES (:usuario_id, :avaliacao, :comentario, :data_avaliacao)";
        $params = [
            ':usuario_id' => $usuario_id,
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
        $sql = "UPDATE avaliacoes_sistema SET 
                    usuario_id = :usuario_id,
                    avaliacao = :avaliacao, 
                    comentario = :comentario, 
                    data_avaliacao = :data_avaliacao
                WHERE id = :id";
        $params = [
            ':usuario_id' => $usuario_id,
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
        $sql = "DELETE FROM avaliacoes_sistema WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }

    public function avaliacoes_sistema()
    {
        $db = new Database();
        $sql = "SELECT DISTINCT u.nome, av.comentario, av.avaliacao 
            FROM usuarios u 
            JOIN avaliacoes_sistema av ON u.id = av.usuario_id
            WHERE avaliacao >= 4 ORDER BY avaliacao DESC
            LIMIT 5";
        return $db->execute_query($sql);
    }
}
