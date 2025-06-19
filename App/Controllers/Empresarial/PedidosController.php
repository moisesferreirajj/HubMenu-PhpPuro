<?php

class PedidosController extends RenderView
{
    public function indexEmpresa($id)
    {

        AcessoController::verificarAcesso('/pedidos/{id}', $_SESSION['usuario_cargo'], $id);

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
        $pedidos = new PedidosModel();
        $users = new UsuariosModel();

        // Pega o id do dono logado
        $usuarioDonoId = $_SESSION['usuario_id'];
        $data = [
            'usuario_id' => $_POST['usuario_id'],
            'produto_id' => $_POST['produto_id'],
            'quantidade' => $_POST['quantidade'],
            'valor_total' => $_POST['valor_total'],
            'status' => 'Pendente',
            'data_pedido' => date('Y-m-d H:i:s')
        ];

        $pedidosModel = new PedidosModel();
        $usuario = new UsuariosModel();
        $pedidosModel->insert($data[]);

        header('Location: /empresarial/pedidos');
        exit;
    }
}
