<?php

require_once 'global.php';

class Database {
    public function getConnection(){
        try {
            //PUXA AS INFORMAÇÕES DIRETAMENTE DO GLOBAL
            $dsn = "mysql:dbname=" . DB_NAME . ";host=" . DB_HOST . ";port=" . DB_PORT;
            $pdo = new PDO($dsn, DB_USER, DB_PASSWORD);
            //EXECUTA O PDO
            return $pdo;
        } catch (PDOException $e) {
            //RETORNA QUALQUER TIPO DE ERRO NO PDO
            die("Erro na conexão: " . $e->getMessage());
        }
    }
}
