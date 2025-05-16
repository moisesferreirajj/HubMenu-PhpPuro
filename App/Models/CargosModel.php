<?php

require_once __DIR__ . '/Database.php';

class CargosModel
{

    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM cargos WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Busca todos os cargos do banco.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM cargos";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($nome)
    {

        $db = new Database();
        $sql = "INSERT INTO cargos (nome)
                VALUES (:nome)";
        $params = [
            ':nome' => $nome,
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update($id, $nome)
    {
        $db = new Database();
        $sql = "UPDATE cargos SET 
                    nome = :nome, 
                WHERE id = :id";
        $params = [
            ':nome' => $nome,
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
        $sql = "DELETE FROM cargos WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }
}
