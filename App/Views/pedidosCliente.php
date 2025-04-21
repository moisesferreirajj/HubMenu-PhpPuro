<?php require '../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../Assets/Css/pedidosCliente.css">
    <link type="text/css" rel="stylesheet" href="../Assets/Css/Components/sidebar.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="../Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="../Assets/Vendor/bootstrap.min.css">
    <script href="../Assets/Vendor/bootstrap.min.js"></script>
    <script src="../Assets/Vendor/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Js/sidebar.js"></script>
    <title><?= $Title ?> Pedidos</title>
<body>
 

<?php require '../Views/Components/sidebar.php'; ?>
        <div class="order-card">
            <div class="order-heading">
                <span class="order_id">Pedido #81492</span>
                <span class="order_date">11/09/2001 - 19:45</span>
                <span class="order-status" id="entregue">Entregue</span>
            </div>
            <table class="table">
                <thead>
                    <tr>
                    <th scope="col">Produto</th>
                    <th scope="col">Quantidade</th>
                    <th scope="col">Preço</th>
                    <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                    <td scope="row">Udon de Camarão</td>
                    <td>2</td>
                    <td>R$12,50</td>
                    <td>R$25,00</td>
                    </tr>
                    <tr>
                    <td scope="row">Pizza</td>
                    <td>1</td>
                    <td>R$52,00</td>
                    <td>R$52,00</td>
                    </tr>
                    <tr>
                    <td scope="row">Tiramisu</td>
                    <td>1</td>
                    <td>R$07,00</td>
                    <td>R$07,00</td>
                    </tr>
                </tbody>
            </table>
            <span class="sub_total" >Sub-Total: <?php echo "87,00"; ?></span>
        </div>
    </div>

</body>
</html>