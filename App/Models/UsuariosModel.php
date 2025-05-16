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

    public function  queryOrders($id){
        $db = new Database();
        $sql = "SELECT id AS id_pedido, data_pedido, forma_pagamento FROM pedidos WHERE usuario_id = :id";
        $params = [':id' => $id];

        return $db->execute_query($sql, $params);
    }

    public function  queryProduct($id){
        $db = new Database();
        $sql = "SELECT pr.nome AS nome_produto, pp.quantidade AS Quantidade, pr.valor AS Preço FROM produtos pr JOIN pedidos_produtos pp ON pr.id = pp.produto_id JOIN pedidos p ON p.id = pp.pedido_id JOIN usuarios u ON u.id = p.usuario_id WHERE p.usuario_id = :id";
        $params = [':id' => $id];

        return $db->execute_query($sql, $params);
    }
}
