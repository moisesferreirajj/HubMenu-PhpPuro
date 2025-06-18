<?php

class PedidosController extends RenderView
{
    public function indexEmpresa()
    {

        AcessoController::verificarAcesso('/pedidos/{id}', $_SESSION['usuario_cargo']);

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
        $estabUsuario = $this->getEstabelecimentoByUsuario($usuarioDonoId);
        $estabelecimentoId = $estabUsuario->estabelecimento_id ?? null;

        $data = [
            'estabelecimento_id' => $estabelecimentoId,
            'nome_cliente' => $_POST['nome_cliente'] ?? '',
            'observacao' => $_POST['observacao'] ?? '',
            'total' => $_POST['total'] ?? 0,
            'data_pedido' => date('Y-m-d H:i:s'),
            'status' => 'novo',
            'produtos' => $_POST['produtos'] ?? []
        ];

        $pedidos->createOrder($data);

        header('Location: /empresarial/pedidos');
        exit;
    }
}
