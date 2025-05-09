<?php

//Arquivo exemplo de como fazer a busca

use sys4soft\Database;

require_once '../Models/Database.php';

$db = new Database();

$result = $db->execute_query("SELECT * FROM estabelecimentos");

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teste PHP com MySQL</title>
</head>
<body>
    <!-- <h1>Teste Conexão com MySQL</h1>
    <h2>Select da table estabelecimentos</h2>
    <table border="1">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Endereço</th>
                <th>Telefone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($result->results as $estabelecimento): ?>
                <tr>
                    <td><?php echo htmlspecialchars($estabelecimento->id_estabelecimento ?? ''); ?></td>
                    <td><?php echo htmlspecialchars($estabelecimento->nome); ?></td>
                    <td><?php echo htmlspecialchars($estabelecimento->endereco); ?></td>
                    <td><?php echo htmlspecialchars($estabelecimento->tipo); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody> -->
        <?php 
            echo "<pre>";
            print_r($result);
            echo "</pre>";
        ?>
</body>
</html>