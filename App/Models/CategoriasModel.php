<?php

class CategoriasModel {
    public function findAll() {
        $db = new Database();
        $result = $db->execute_query("SELECT * FROM categorias");
        return $result->results;
    }
}
