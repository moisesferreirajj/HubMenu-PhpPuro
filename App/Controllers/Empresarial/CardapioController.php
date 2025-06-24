<?php

class CardapioController extends RenderView
{
    public function indexCliente($id)
    {
        $produtoModel = new ProdutosModel();
        $estabelecimentosModel = new EstabelecimentosModel();

        $produtosResponse = $produtoModel->findByEstabelecimentoId($id);
        $estabelecimentoResponse = $estabelecimentosModel->findById($id);

        $produtos = ($produtosResponse->status === 'success') ? $produtosResponse->results : [];
        $estabelecimento = ($estabelecimentoResponse->status === 'success') ? $estabelecimentoResponse->results : null;

        $this->loadView('Clientes/cardapioCliente', [
            'Title' => 'HubMenu |',
            'Produtos' => $produtos,
            'Estabelecimento' => $estabelecimento,
            'Erro' => $produtosResponse->status === 'error' ? $produtosResponse->message : null
        ]);
    }

    public function indexAdmin($id): void
    {
        AcessoController::verificarAcesso('/gerenciar/cardapio/{id}', $_SESSION['usuario_cargo'], $id);

        $produtoModel = new ProdutosModel();
        $estabelecimentosModel = new EstabelecimentosModel();

        $produtosResponse = $produtoModel->findByEstabelecimentoId($id);
        $estabelecimentoResponse = $estabelecimentosModel->findById($id);

        $produtos = ($produtosResponse->status === 'success') ? $produtosResponse->results : [];
        // Mantendo como objeto para facilitar uso na view
        $estabelecimento = ($estabelecimentoResponse->status === 'success') ? $estabelecimentoResponse->results : null;

        $this->loadView('empresarial/cardapioEmpresa', [
            'Title' => 'HubMenu |',
            'Produtos' => $produtos,
            'EstabelecimentoID' => $id,
            'Estabelecimento' => $estabelecimento,
            'Erro' => $produtosResponse->status === 'error' ? $produtosResponse->message : null
        ]);
    }

    public function lixeira($id): void
    {
        AcessoController::verificarAcesso('/gerenciar/lixeira/{id}', $_SESSION['usuario_cargo'], $id);

        $produtoModel = new ProdutosModel();
        $estabelecimentosModel = new EstabelecimentosModel();

        // Buscar produtos inativos
        $produtosInativos = $produtoModel->listarDesativados($id);
        $estabelecimentoResponse = $estabelecimentosModel->findById($id);

        $produtos = is_array($produtosInativos) ? $produtosInativos : [];
        $estabelecimento = ($estabelecimentoResponse->status === 'success') ? $estabelecimentoResponse->results : null;
        $erro = empty($produtos) && !is_array($produtosInativos) ? 'Erro ao carregar produtos inativos.' : null;

        $this->loadView('empresarial/lixeira', [
            'Title' => 'HubMenu | Lixeira',
            'ProdutosInativos' => $produtos,
            'Estabelecimento' => $estabelecimento,
            'EstabelecimentoID' => $id,
            'Erro' => $erro
        ]);
    }

}