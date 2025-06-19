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
            $usuarioDonoId = $_SESSION['usuario_id'];
            $nomeUsuario = $_POST['nome_usuario'];
            $produtoIds = $_POST['produto_id'];
            $quantidades = $_POST['quantidade'];
            $valorTotal = $_POST['valor_total'];

            $pedidosModel = new PedidosModel();
            
            // Registrar cliente convidado
            $pedidosModel->registerGuestClient($nomeUsuario);

            // Registrar pedido (você deveria receber o ID do novo pedido)
            $pedidoId = $pedidosModel->registerOrder([
                'valor_total' => $valorTotal,
                'status' => 'Pendente',
                'data_pedido' => date('Y-m-d H:i:s')
            ]);

            // Associar produtos ao pedido
            foreach ($produtoIds as $index => $produtoId) {
                $quantidade = $quantidades[$index];
                $pedidosModel->registerOrderProducts($pedidoId, $produtoId, $quantidade);
            }

            exit;
        }

}
