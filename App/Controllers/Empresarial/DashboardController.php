<?php

class DashboardController extends RenderView
{
    public function index($id)
    {

        AcessoController::verificarAcesso('/empresarial/dashboard/{id}', $_SESSION['usuario_cargo'], $id);

        // Models
        $produtoModel = new ProdutosModel();
        $estabelecimentosModel = new EstabelecimentosModel();
        $pedidosModel = new PedidosModel();
        $usuariosModel = new UsuariosModel();
        $vendasModel = new VendasModel();

        // Dados principais
        $estabelecimento = $estabelecimentosModel->findById($id)->results[0] ?? null;
        $produtosObj = $produtoModel->findByEstabelecimentoId($id);
        $produtos = $produtosObj->results ?? [];
        $pedidos = $pedidosModel->getOrderByCompanyId($id) ?? [];
        $usuarios = $usuariosModel->findByEstabelecimentoId($id) ?? []; // Função nova, veja abaixo
        $vendas = $vendasModel->findByEstabelecimentoId($id) ?? []; // Função nova, veja abaixo

        // Pedidos recentes (últimos 10)
        $pedidosRecentes = $pedidosModel->getRecentOrdersByCompanyId($id, 10) ?? []; // Função nova

        // Vendas por mês (para gráfico)
        $vendasPorMes = $vendasModel->getVendasPorMes($id) ?? []; // Função nova

        // Top estabelecimentos (para gráfico, pode ser só o próprio ou ranking geral)
        $topEstabelecimentos = $vendasModel->getTopEstabelecimentos() ?? []; // Função nova

        $this->loadView('empresarial/dashboard', [
            'Title' => 'HubMenu | Dashboard',
            'EstabelecimentoID' => $id,
            'Estabelecimento' => $estabelecimento,
            'Produtos' => $produtos,
            'Pedidos' => $pedidos,
            'Usuarios' => $usuarios,
            'Vendas' => $vendas,
            'TopEstabelecimentos' => $topEstabelecimentos,
            'PedidosRecentes' => $pedidosRecentes,
            'VendasPorMes' => $vendasPorMes
        ]);
    }
}