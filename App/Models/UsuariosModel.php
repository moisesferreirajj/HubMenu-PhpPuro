<?php

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
    public function insert($nome, $senha, $email, $cargo_id = null, $cep = null, $endereco = null, $telefone = null)
    {
        $db = new Database();
        $sql = "INSERT INTO usuarios (nome, senha, email, cargo_id, cep, endereco, telefone)
            VALUES (:nome, :senha, :email, :cargo_id, :cep, :endereco, :telefone)";
        $params = [
            ':nome' => $nome,
            ':senha' => $senha,
            ':email' => $email,
            ':cargo_id' => $cargo_id,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':telefone' => $telefone
        ];

        $result = $db->execute_non_query($sql, $params);
        if ($result && $result->status) {
            return $result->last_id;
        }
        return null;
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
        $sql = "SELECT 
                u.id, 
                u.nome, 
                u.senha, 
                u.email, 
                eu.estabelecimento_id,
                COALESCE(eu.cargo_id, u.cargo_id) AS cargo_id,
                c.nome AS cargo_nome
            FROM usuarios u
            LEFT JOIN estabelecimentos_usuarios eu ON eu.usuario_id = u.id
            LEFT JOIN cargos c ON c.id = COALESCE(eu.cargo_id, u.cargo_id)
            WHERE u.email = :email
            LIMIT 1";
        $params = [':email' => $email];

        return $db->execute_query($sql, $params);
    }

    /**
     * Busca um admin pelo email
     */
    public function buscarAdmin($email)
    {
        $db = new Database();
        $sql = "SELECT 
                id,
                nome,
                email,
                senha,
                cargo_id            
            FROM usuarios 
            WHERE email = :email
            LIMIT 1;
            ";
        $params = [':email' => $email];

        return $db->execute_query($sql, $params);
    }

    public function buscarPorTelefone($telefone)
    {
        $db = new Database();
        $sql = "SELECT id, nome, senha, telefone FROM usuarios WHERE telefone = :telefone LIMIT 1";
        $params = [':telefone' => $telefone];

        return $db->execute_query($sql, $params);
    }

    public function updatePassword($senha, $id)
    {
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

    public function findByEstabelecimentoId($estabelecimento_id)
    {
        $db = new Database();
        $sql = "SELECT u.*, c.nome as cargo_nome, eu.cargo_id 
                FROM usuarios u
                INNER JOIN estabelecimentos_usuarios eu ON u.id = eu.usuario_id
                LEFT JOIN cargos c ON eu.cargo_id = c.id
                WHERE eu.estabelecimento_id = :estabelecimento_id";
        $params = [':estabelecimento_id' => $estabelecimento_id];
        $result = $db->execute_query($sql, $params);
        return $result->results ?? [];
    }

    public function getCompanyByUserId($user_id)
    {
        $db = new Database();
        $sql = "SELECT e.id 
                FROM estabelecimentos e
                JOIN estabelecimentos_usuarios eu ON e.id = eu.estabelecimento_id
                WHERE eu.usuario_id = :user_id
                LIMIT 1";
        $params = [':user_id' => $user_id];
        $result = $db->execute_query($sql, $params);

        if ($result->status === 'success' && !empty($result->results)) {
            return (int) $result->results[0]->id;
        }
        return null;
    }

    public function criar($nome)
    {
        $db = new Database();
        $sql = "INSERT INTO usuarios (nome) VALUES (:nome)";
        $params = [':nome' => $nome];

        $res = $db->execute_non_query($sql, $params);

        if ($res->status === 'success') {
            return $res->last_id; // Aqui você recupera o ID criado
        }

        return null; // Se falhar
    }
}
