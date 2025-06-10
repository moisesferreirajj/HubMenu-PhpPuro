<?php

require_once __DIR__ . '/Database.php';

class UsuariosModel
{
    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Retorna todos os usuários da tabela.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM usuarios";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($nome, $senha, $email, $cep = null, $endereco = null, $telefone = null)
    {
        $db = new Database();
        $sql = "INSERT INTO usuarios (nome, senha, email, cep, endereco, telefone)
                VALUES (:nome, :senha, :email, :cep, :endereco, :telefone)";
        $params = [
            ':nome' => $nome,
            ':senha' => $senha,
            ':email' => $email,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':telefone' => $telefone
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update($id, $nome, $senha, $email, $cep, $endereco, $telefone)
    {
        $db = new Database();
        $sql = "UPDATE usuarios SET 
                    nome = :nome, 
                    senha = :senha, 
                    email = :email, 
                    cep = :cep, 
                    endereco = :endereco, 
                    telefone = :telefone
                WHERE id = :id";
        $params = [
            ':nome' => $nome,
            ':senha' => $senha,
            ':email' => $email,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':telefone' => $telefone,
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
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }


    /**
     * Busca um usuário pelo email. (query demoniaca)
     */
    public function buscarPorEmail($email)
    {
        $db = new Database();
        $sql = "SELECT id, nome, senha, cargo_id, email FROM usuarios WHERE email = :email LIMIT 1";
        $params = [':email' => $email];

        return $db->execute_query($sql, $params);

        // if (isset($response->status) && $response->status === 'success' && !empty($response->results)) {
        //     return $response->results[0]; // sempre objeto
        // }
    }

    public function updatePassword($senha, $id){
        $db = new Database();
        $sql = "UPDATE usuarios SET 
                    senha = :senha 
                WHERE id = :id";
        $params = [
            ':senha' => $senha,
            ':id' => $id,
        ];
        return $db->execute_non_query($sql, $params);
    }
}
