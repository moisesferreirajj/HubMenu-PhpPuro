<?php 

class EstabelecimentosUsuariosModel {

    public function insert($estabelecimento_id, $usuario_id, $cargo_id) {
        $db = new Database();
        $sql = "INSERT INTO estabelecimentos_usuarios (estabelecimento_id, usuario_id, cargo_id)
                VALUES (:estabelecimento_id, :usuario_id, :cargo_id)";
        $params = [
            ':estabelecimento_id' => $estabelecimento_id,
            ':usuario_id' => $usuario_id,
            ':cargo_id' => $cargo_id
        ];
        return $db->execute_non_query($sql, $params);
    }

}

?>