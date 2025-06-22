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
        $avaliacoesModel = new AvaliacoesModel();
        $categoriasModel = new CategoriasModel();

        // Dados principais
        $estabelecimento = $estabelecimentosModel->findById($id)->results[0] ?? null;
        $produtosObj = $produtoModel->findByEstabelecimentoId($id);
        $produtos = $produtosObj->results ?? [];
        $pedidos = $pedidosModel->getOrderByCompanyId($id) ?? [];
        $usuarios = $usuariosModel->findByEstabelecimentoId($id) ?? [];
        $vendas = $vendasModel->findByEstabelecimentoId($id) ?? [];

        // Pedidos recentes (últimos 10)
        $pedidosRecentes = $pedidosModel->getRecentOrdersByCompanyId($id, 10) ?? [];

        // Vendas por mês (para gráfico)
        $vendasPorMes = $vendasModel->getVendasPorMes($id) ?? [];
        $vendasPorHora = $vendasModel->getVendasPorHora($id) ?? [];
        $vendasPorCategoria = $vendasModel->getVendasPorCategoria($id) ?? [];

        // Top estabelecimentos (para gráfico, pode ser só o próprio ou ranking geral)
        $topEstabelecimentos = $vendasModel->getTopEstabelecimentos() ?? [];
        // Top produtos de cada estabelecimento
        $topProdutos = $vendasModel->getTopProdutos($id) ?? [];

        $avaliacoes = $avaliacoesModel->getByEstabelecimento($id, 10); // 10 últimas avaliações

        $CategoriasObj = $categoriasModel->findAll($id) ?? [];
        $categorias = $CategoriasObj->results ?? [];

        $this->loadView('empresarial/dashboard', [
            'Title' => 'HubMenu | Dashboard',
            'EstabelecimentoID' => $id,
            'Estabelecimento' => $estabelecimento,
            'Produtos' => $produtos,
            'TopProdutos' => $topProdutos,
            'Pedidos' => $pedidos,
            'Usuarios' => $usuarios,
            'Vendas' => $vendas,
            'VendasPorHora' => $vendasPorHora,
            'VendasPorMes' => $vendasPorMes,
            'VendasPorCategoria' => $vendasPorCategoria,
            'TopEstabelecimentos' => $topEstabelecimentos,
            'PedidosRecentes' => $pedidosRecentes,
            'Avaliacoes' => $avaliacoes,
            'Categorias' => $categorias
        ]);
    }
}