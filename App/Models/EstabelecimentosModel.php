<?php

class EstabelecimentosModel {
    public function findAll() {
        $db = new Database();
        $result = $db->execute_query("SELECT * FROM estabelecimentos");
        return $result->results;
    }
}
