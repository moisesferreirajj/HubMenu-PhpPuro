<?php

class PedidosController extends RenderView
{
    public function indexEmpresa($id)
    {

        AcessoController::verificarAcesso('/pedidos/{id}', $_SESSION['usuario_cargo'], $_SESSION['estabelecimento_id']);

        $users = new UsuariosModel();
        $pedidos = (new PedidosModel())->getOrders();
        $produtos = (new ProdutosModel())->findAll();
        $this->loadView(
            'empresarial/pedidosEmpresa',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }

    public function registerOrder()
    {
        AcessoController::verificarAcesso('/pedidos/registerOrder', $_SESSION['usuario_cargo'], $_SESSION['estabelecimento_id']);
        
        $estabelecimentoId = $_SESSION['estabelecimento_id']; // forçado pela sessão
        $nomeUsuario = $_POST['nome_cliente'];
        $produtoIds = $_POST['products'];
        $valorTotal = $_POST['valor_total'];

        $pedidosModel = new PedidosModel();
        $usuarioId = $pedidosModel->registerGuestClient($nomeUsuario);

        $pedidoId = $pedidosModel->registerOrder([
            'usuario_id' => $usuarioId,
            'estabelecimento_id' => $estabelecimentoId,
            'valor_total' => $valorTotal,
            'status' => 'Pendente',
            'data_pedido' => date('Y-m-d H:i:s')
        ]);

        foreach ($produtoIds as $index => $produtoId) {
            $pedidosModel->registerOrderProducts($pedidoId, $produtoId);
        }

        echo "<script>alert('Pedido Cadastrado'); window.history.back();</script>";
        exit();
    }

}
