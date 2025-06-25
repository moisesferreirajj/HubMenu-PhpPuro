<?php

class EstabelecimentosUsuariosModel
{

    public function insert($usuario_id, $cargo_id, $estabelecimento_id)
    {
        $db = new Database();
        $sql = "INSERT INTO estabelecimentos_usuarios (usuario_id, cargo_id, estabelecimento_id)
                VALUES (:usuario_id, :cargo_id, :estabelecimento_id)";
        $params = [
            ':usuario_id' => $usuario_id,
            ':cargo_id' => $cargo_id,
            ':estabelecimento_id' => $estabelecimento_id
        ];

        return $db->execute_non_query($sql, $params);
    }

    public function update($usuario_id, $estabelecimento_id, $cargo_id)
    {
        $db = new Database();
        $sql = "UPDATE estabelecimentos_usuarios SET cargo_id = :cargo_id
                WHERE usuario_id = :usuario_id AND estabelecimento_id = :estabelecimento_id";
        $params = [
            ':cargo_id' => $cargo_id,
            ':usuario_id' => $usuario_id,
            ':estabelecimento_id' => $estabelecimento_id
        ];
        return $db->execute_non_query($sql, $params);
    }

    public function delete($usuario_id, $estabelecimento_id)
    {
        $db = new Database();
        $sql = "DELETE FROM estabelecimentos_usuarios WHERE usuario_id = :usuario_id AND estabelecimento_id = :estabelecimento_id";
        $params = [
            ':usuario_id' => $usuario_id,
            ':estabelecimento_id' => $estabelecimento_id
        ];
        return $db->execute_non_query($sql, $params);
    }
}
