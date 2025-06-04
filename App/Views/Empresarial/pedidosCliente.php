<?php 
   require_once __DIR__ . '/../global.php';
   require_once __DIR__ . '/../Models/UsuariosModel.php';
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/pedidosCliente.css">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Css/Components/sidebar.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="/Views/Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="/Views/Assets/Vendor/bootstrap.min.css">
    <script href="/Views/Assets/Vendor/bootstrap.min.js"></script>
    <script src="/Views/Assets/Vendor/bootstrap.bundle.min.js"></script>
    <script src="/Views/Assets/Js/sidebar.js"></script>
    <title><?= $Title ?> Pedidos</title>

<body>


    <?php require '../Views/Components/sidebar.php'; ?>
    <div class="header">
        <div class="header-btn">
            <button type="button" onclick="openNav()" id="open-btn" class="open-btn">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M7.8205 3.26875C8.2111 2.87823 8.8442 2.87823 9.2348 3.26875L15.8792 9.91322C17.0505 11.0845 17.0508 12.9833 15.88 14.155L9.3097 20.7304C8.9192 21.121 8.286 21.121 7.8955 20.7304C7.505 20.3399 7.505 19.7067 7.8955 19.3162L14.4675 12.7442C14.8581 12.3536 14.8581 11.7205 14.4675 11.33L7.8205 4.68297C7.43 4.29244 7.43 3.65928 7.8205 3.26875Z" fill="#0e7a56" />
                </svg>
            </button>
        </div>
        <div class="search-box">
            <div class="srch-input">
                <label for="srch-date" id="period">Período: </label>
                <select>
                    <option value="7">Última Semana</option>
                    <option value="30">Último Mês</option>
                    <option value="365">Último Ano</option>
                    <option value="367">Mais Antigos</option>
                </select>
            </div>
            <div class="srch-input">
                <label for="srch-status" id="status">Status: </label>
                <select>
                    <option value="all">Todos</option>
                    <option value="pending">Pendente</option>
                    <option value="done">Entregue</option>
                    <option value="trip">Á caminho</option>
                    <option value="cancel">Cancelado</option>
                </select>
            </div>
            <div class="srch-input" id="srch-final">
                <input type="text" id="srch-text" placeholder="Data ou Código do Pedido"><input type="submit" id="srch-btn" value="Buscar">
            </div>
        </div>
    </div>

    
    <div class="orders">
            <div class="order-card">
                <div class="order-heading">
                    <span class="order_id">Pedido </span>
                    <span class="order_date"></span>
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
                        <?php 
                            $total = 0;
                            // foreach($produtos as &$produto){
                            //     $sub_total = $produto['valor'] * $produto['quantidade'];
                            //     $total += $sub_total;
                            //}
                            ?>
                            <tr>
                                <td scope="row"></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="payment-method">
                        <span class="payment-icon">💳</span>
                        <span>Cartão de Crédito - Final 1234</span>
                    </div>
                    <span class="sub_total">Sub-Total: <?php // echo "R$". $total; ?></span>
                </div>
    </div>


</body>
</html>