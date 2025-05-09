<?php

// class UsuariosModel extends Database {
//     private $pdo;

//     public function __construct(){
//         $this->pdo = $this->getConnection();
//     }

//     public function fetch(){
//         try {
//             //INICIA A QUERY SQL
//             $this->pdo->beginTransaction();

//             $stm = $this->pdo->prepare("SELECT * FROM usuarios");
//             $stm->execute();

//             if ($stm->rowCount() > 0) {
//                 //SE TUDO OCORRER BEM, PROSSIGA
//                 $this->pdo->commit();
//                 return $stm->fetchAll(PDO::FETCH_ASSOC);
//             } else {
//                 //SE NÃO TIVER NENHUM RESULTADO FAZ ROLLBACK PARA EVITAR SQL INJECTION
//                 $this->pdo->rollback();
//                 return [];
//             }
//         } catch (Exception $error) {
//             $this->pdo->rollback();
//             throw $error;
//         }
//     }
// }
