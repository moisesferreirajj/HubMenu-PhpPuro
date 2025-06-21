<?php

class PedidosController extends RenderView
{
    public function indexEmpresa($id)
    {

        AcessoController::verificarAcesso('/pedidos/{id}', 'admin', '1');

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
        
        $estabelecimentoId = $_SESSION['estabelecimento_id'];
        $nomeUsuario = $_POST['nome_cliente'];
        $produtoIds = $_POST['products'];
        $valorTotal = $_POST['valor_total'];
        $quantidades = $_POST['quantidade']; // array: [produto_id => quantidade]

        $pedidosModel = new PedidosModel();
        $usuarioId = $pedidosModel->registerGuestClient($nomeUsuario);

        $pedidoId = $pedidosModel->registerOrder([
            'usuario_id' => $usuarioId,
            'estabelecimento_id' => $estabelecimentoId,
            'valor_total' => $valorTotal,
            'status' => 'Pendente',
            'data_pedido' => date('Y-m-d H:i:s')
        ]);

        foreach ($produtoIds as $produtoId) {
            $quantidade = isset($quantidades[$produtoId]) ? (int)$quantidades[$produtoId] : 1;
            // Busque o preço unitário do produto
            $produto = (new ProdutosModel())->findById($produtoId);
            $preco_unitario = $produto->valor ?? 0;

            $result = $pedidosModel->registerOrderProducts($pedidoId, $produtoId, $quantidade, $preco_unitario);
            if ($result->status !== 'success') {
                var_dump($result); exit;
            }
        }

        echo "<script>alert('Pedido cadastrado com sucesso!'); window.location.href = '/pedidos';</script>";
        exit();
    }

}
