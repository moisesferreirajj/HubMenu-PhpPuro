<?php

require_once __DIR__ . '/Database.php';

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
    public function insert($usuario_id, $estabelecimento_id, $avaliacao, $comentario = null, $data_avaliacao)
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
    public function update($id, $usuario_id, $estabelecimento_id, $avaliacao, $comentario = null, $data_avaliacao)
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
}
