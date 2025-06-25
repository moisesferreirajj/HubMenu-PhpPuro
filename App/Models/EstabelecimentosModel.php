<?php

class EstabelecimentosModel
{
    private $db;

    public function __construct()
    {
        $this->db = new Database();
    }


    /**
     * Busca um usuário pelo ID.
     */
    public function findById($id)
    {
        $db = new Database();
        $sql = "SELECT * FROM estabelecimentos WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_query($sql, $params);
    }

    /**
     * Busca todos os estabelecimentos do banco.
     */
    public function findAll()
    {
        $db = new Database();
        $sql = "SELECT * FROM estabelecimentos";
        return $db->execute_query($sql);
    }

    /**
     * Insere um novo usuário no banco de dados.
     */
    public function insert($nome, $cep, $cnpj, $tipo, $media_avaliacao, $endereco = null, $imagem = null, $banner = null, $cor1 = null, $cor2 = null, $cor3 = null)
    {
        $db = new Database();
        $sql = "INSERT INTO estabelecimentos (nome, cep, endereco, cnpj, imagem, banner, cor1, cor2, cor3, tipo, media_avaliacao)
                VALUES (:nome, :cep, :endereco, :cnpj, :imagem, :banner, :cor1, :cor2, :cor3, :tipo, :media_avaliacao)";
        $params = [
            ':nome' => $nome,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':cnpj' => $cnpj,
            ':imagem' => $imagem,
            ':banner' => $banner,
            ':cor1' => $cor1,
            ':cor2' => $cor2,
            ':cor3' => $cor3,
            ':tipo' => $tipo,
            ':media_avaliacao' => $media_avaliacao
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza os dados de um usuário existente.
     */
    public function update($id, $nome, $cep, $cnpj, $tipo, $media_avaliacao, $endereco = null, $imagem = null, $banner = null, $cor1 = null, $cor2 = null, $cor3 = null)
    {
        $db = new Database();
        $sql = "UPDATE estabelecimentos SET 
                    nome = :nome, 
                    cep = :cep, 
                    endereco = :endereco, 
                    cnpj = :cnpj, 
                    imagem = :imagem,
                    banner = :banner,
                    cor1 = :cor1,
                    cor2 = :cor2,
                    cor3 = :cor3,
                    tipo = :tipo,
                    media_avaliacao = :media_avaliacao
                WHERE id = :id";
        $params = [
            ':nome' => $nome,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':cnpj' => $cnpj,
            ':imagem' => $imagem,
            ':banner' => $banner,
            ':cor1' => $cor1,
            ':cor2' => $cor2,
            ':cor3' => $cor3,
            ':tipo' => $tipo,
            ':media_avaliacao' => $media_avaliacao,
            ':id' => $id
        ];
        return $db->execute_non_query($sql, $params);
    }

        /**
     * Atualiza os dados de um estabelecimento existente no gerenciar.
     */
    public function updateGerenciar($id, $nome, $cep, $cnpj, $tipo, $endereco = null, $imagem = null, $banner = null, $cor1 = null, $cor2 = null, $cor3 = null)
    {
        $db = new Database();
        $sql = "UPDATE estabelecimentos SET 
                    nome = :nome, 
                    cep = :cep, 
                    endereco = :endereco, 
                    cnpj = :cnpj, 
                    imagem = :imagem,
                    banner = :banner,
                    cor1 = :cor1,
                    cor2 = :cor2,
                    cor3 = :cor3,
                    tipo = :tipo
                WHERE id = :id";
        $params = [
            ':nome' => $nome,
            ':cep' => $cep,
            ':endereco' => $endereco,
            ':cnpj' => $cnpj,
            ':imagem' => $imagem,
            ':banner' => $banner,
            ':cor1' => $cor1,
            ':cor2' => $cor2,
            ':cor3' => $cor3,
            ':tipo' => $tipo,
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
        $sql = "DELETE FROM estabelecimentos WHERE id = :id";
        $params = [':id' => $id];
        return $db->execute_non_query($sql, $params);
    }

    public function MoreStars()
    {
        $db = new Database();
        $sql = "SELECT media_avaliacao, nome, tipo, imagem FROM estabelecimentos ORDER BY media_avaliacao DESC LIMIT 5";
        return $db->execute_query($sql);
    }

    public function findNewest()
    {
        $db = new Database();
        $sql = "SELECT id, nome, endereco, media_avaliacao, tipo, imagem FROM estabelecimentos ORDER BY id DESC LIMIT 5";
        return $db->execute_query($sql);
    }

    public function getLastInsertId()
    {
        return $this->db->getLastInsertId();
    }

}