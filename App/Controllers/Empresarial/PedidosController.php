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
        // Verifica permissão e sessão
        AcessoController::verificarAcesso('/pedidos/registerOrder', $_SESSION['usuario_cargo'], $_SESSION['estabelecimento_id']);

        $estabelecimentoId = $_SESSION['estabelecimento_id'];
        $nomeUsuario = $_POST['nome_cliente'];
        $produtoIds = $_POST['products'] ?? [];
        $valorTotal = str_replace(',', '.', $_POST['valor_total']);
        $quantidades = $_POST['quantidade'] ?? [];
        $observacoes = $_POST['observacao'] ?? [];

        // 1. Cria usuário "guest" para o pedido
        $pedidosModel = new PedidosModel();
        $usuarioId = $pedidosModel->registerGuestClient($nomeUsuario);

        // 2. Cria o pedido
        $pedidoId = $pedidosModel->registerOrder([
            'usuario_id' => $usuarioId,
            'estabelecimento_id' => $estabelecimentoId,
            'valor_total' => $valorTotal,
            'status' => 'Pendente',
            'data_pedido' => date('Y-m-d H:i:s')
        ]);

        // 3. Adiciona os produtos ao pedido
        foreach ($produtoIds as $produtoId) {
            $quantidade = isset($quantidades[$produtoId]) ? (int)$quantidades[$produtoId] : 1;
            $produto = (new ProdutosModel())->findById($produtoId);
            $preco_unitario = $produto->results[0]->valor ?? 0;

            $pedidosModel->registerOrderProducts($pedidoId, $produtoId, $quantidade, $preco_unitario);
            // Se quiser salvar observação por produto, crie um campo na tabela pedidos_produtos e salve aqui
        }

        echo "<script>alert('Pedido cadastrado com sucesso!'); window.location.href = '/pedidos';</script>";
        exit();
    }

}
