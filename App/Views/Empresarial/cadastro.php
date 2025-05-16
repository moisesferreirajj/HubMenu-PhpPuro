<?php @require_once __DIR__ . '/../../global.php'; ?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/cad.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="icon" href="/Views/Assets/Images/favicon.png">

    <title><?= $Title ?> Cadastro</title>
</head>

<body>
<?php include_once __DIR__ . '/../Components/form-cad.php'; ?>
</body>
</html>