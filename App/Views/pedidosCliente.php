<?php require '../global.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link type="text/css" rel="stylesheet" href="../Assets/Css/pedidosCliente.css">
    <!-- BOOTSTRAP GERENCIAMENTO -->
    <link rel="icon" href="../Assets/Images/favicon.png">
    <link type="text/css" rel="stylesheet" href="../Assets/Vendor/bootstrap.min.css">
    <script href="../Assets/Vendor/bootstrap.min.js"></script>
    <script src="../Assets/Vendor/bootstrap.bundle.min.js"></script>
    <script src="../Assets/Js/sidebar.js"></script>
    <title><?= $Title ?> Pedidos</title>
<body>
    <div class="sidebar" id="sidebar">
            <button onclick="closeNav()" class="close-btn" >
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path id="arrow-path" d="M16.1795 3.26875C15.7889 2.87823 15.1558 2.87823 14.7652 3.26875L8.12078 9.91322C6.94952 11.0845 6.94916 12.9833 8.11996 14.155L14.6903 20.7304C15.0808 21.121 15.714 21.121 16.1045 20.7304C16.495 20.3399 16.495 19.7067 16.1045 19.3162L9.53246 12.7442C9.14194 12.3536 9.14194 11.7205 9.53246 11.33L16.1795 4.68297C16.57 4.29244 16.57 3.65928 16.1795 3.26875Z" fill="#0F0F0F"/>
                </svg>
            </button>
            <a class="side-item"><i>🏠</i>Home</a>
            <a class="side-item" id="active"><i>📋</i>Pedidos</a>
            <a class="side-item"><i>👤</i>SLA</a>
    </div>
    <div class="content" id="content">
            <button type="button" onclick="openNav()" id="open-btn">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="-4.5 0 20 20" aria-hidden="true" focusable="false">
                    <path d="M249.365851,6538.70769 L249.365851,6538.70769 C249.770764,6539.09744 250.426289,6539.09744 250.830166,6538.70769 L259.393407,6530.44413 C260.202198,6529.66364 260.202198,6528.39747 259.393407,6527.61699 L250.768031,6519.29246 C250.367261,6518.90671 249.720021,6518.90172 249.314072,6519.28247 L249.314072,6519.28247 C248.899839,6519.67121 248.894661,6520.31179 249.302681,6520.70653 L257.196934,6528.32352 C257.601847,6528.71426 257.601847,6529.34685 257.196934,6529.73759 L249.365851,6537.29462 C248.960938,6537.68437 248.960938,6538.31795 249.365851,6538.70769" transform="translate(-245 -6519)"/>
                </svg>
            </button>
        <div class="order-card">
            <div class="order-heading">
                <span>Pedido #81492</span>
                <span>11/09/2001 - 19:45</span>
                <span>Status: Entregue</span>
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
            <span>Sub-Total:R$85,00</span>
        </div>
    </div>
    
    <script src="../Assets/Js/FooterLayout.js"></script>
    <footer-layout></footer-layout>
</body>
</html>