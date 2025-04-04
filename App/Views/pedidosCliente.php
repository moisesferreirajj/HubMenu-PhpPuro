<?php require '../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedidos</title>
    <title><?= $Title ?> Pedidos</title>
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link type="text/css" rel="stylesheet" href="../Assets/Css/bootstrap.min.css">
    <script href="../Assets/Css/bootstrap.min.js"></script>
    <link type="text/css" rel="stylesheet" href="../Assets/Css/pedidosCliente.css">
<body>
    <h1>PEDIDOS</h1><br>

    <div class="pedidos">
        <table id="pedidos">
            <tr>
                <th rowspan="5"><img id="pedidoimg" src="../Assets/Images/LogoHB-Render.png"></th>
            </tr>
            <tr>
                <th colspan="3", rowspan="4"><h3>Hamburguer</h3></th>
            </tr>
            <tr>
                <th rowspan="5"></th>
            </tr>
            <tr>
                <th><h4 id="valqtd">3x R$XX,xx</h4>
            </tr>
            <tr>
                <th><h4 id="valtot">R$XX,xx</h4></th>  
            </tr>
        </table>
    </div>

    <div class="pedidos">
        <table id="pedidos">
            <tr>
                <th rowspan="5"><img id="pedidoimg" src="../Assets/Images/LogoHB-Render.png"></th>
            </tr>
            <tr>
                <th colspan="3", rowspan="4"><h3>Coca-Cola</h3></th>
            </tr>
            <tr>
                <th rowspan="5"></th>
            </tr>
            <tr>
                <th><h4 id="valqtd">1x R$XX,xx</h4>
            </tr>
            <tr>
                <th><h4 id="valtot">R$XX,xx</h4></th>  
            </tr>
        </table>
    </div>

    <div class="pedidos">
        <table id="pedidos">
            <tr>
                <th rowspan="5"><img id="pedidoimg" src="../Assets/Images/LogoHB-Render.png"></th>
            </tr>
            <tr>
                <th colspan="3", rowspan="4"><h3>Pizza</h3></th>
            </tr>
            <tr>
                <th rowspan="5"></th>
            </tr>
            <tr>
                <th><h4 id="valqtd">2x R$XX,xx</h4>
            </tr>
            <tr>
                <th><h4 id="valtot">R$XX,xx</h4></th>  
            </tr>
        </table>
    </div>
    <div class="finalizarpedido">
        <div class="calcfinal">
            <table id="finalpedido">
                    <tr>
                        <th><h1>SUB-TOTAL: R$XX,xx</h1></th>
                    </tr>
                    <tr>
                        <th><h2>Frete: R$XX,xx</h2></th>
                    </tr>
                    <tr>
                        <th><h3>TOTAL: R$XX,xx</h3></th>
                    </tr>
            </table>
        </div>
    </div>
    <script src="../Assets/Js/FooterLayout.js"></script>
    <footer-layout></footer-layout>
</body>
</html>