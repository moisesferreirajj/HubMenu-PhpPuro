<?php
// Caminho do log
$logPath = __DIR__ . '/erros.log';

// Lê o conteúdo do arquivo de log
$conteudo = file_exists($logPath) ? file_get_contents($logPath) : 'Nenhum erro registrado.';

// Separa as entradas por linha
$linhas = array_reverse(explode("\n", trim($conteudo)));

function formatarLinha($linha)
{
    if (stripos($linha, 'Fatal') !== false) {
        return '<span style="color: red;">' . htmlspecialchars($linha) . '</span>';
    } elseif (stripos($linha, 'Warning') !== false) {
        return '<span style="color: orange;">' . htmlspecialchars($linha) . '</span>';
    } elseif (stripos($linha, 'Notice') !== false) {
        return '<span style="color: yellow;">' . htmlspecialchars($linha) . '</span>';
    }
    return '<span style="color: #0f0;">' . htmlspecialchars($linha) . '</span>';
}

if (isset($_POST['limpar'])) {
    header("Location: " . $_SERVER['REQUEST_URI']);
    file_put_contents($logPath, '');
    exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Log de Erros</title>
    <style>
        body {
            background-color: #111;
            color: #eee;
            font-family: monospace;
            padding: 20px;
        }

        h1 {
            color: #0f0;
        }

        .log {
            background: #222;
            padding: 15px;
            border-radius: 10px;
            overflow-y: scroll;
            max-height: 90vh;
        }

        a.limpar {
            color: red;
            text-decoration: none;
            margin-top: 10px;
            display: inline-block;
        }
    </style>
</head>

<body>
    <h1>Log de Erros</h1>

    <div class="log">
        <?php foreach ($linhas as $linha) {
            echo formatarLinha($linha) . "<br>";
        } ?>
    </div>

    <br>

    <form method="post">
        <button type="submit" name="limpar">Limpar Log</button>
    </form>
</body>

</html>