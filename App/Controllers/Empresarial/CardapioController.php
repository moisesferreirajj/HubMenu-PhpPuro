<?php

class CardapioController extends RenderView
{
    public function indexCliente($id)
    {
        $produtoModel = new ProdutosModel();
        $produtosResponse = $produtoModel->findByEstabelecimentoId($id);

        $produtos = ($produtosResponse->status === 'success') ? $produtosResponse->results : [];

        $this->loadView('Clientes/cardapioCliente', [
            'Title' => 'HubMenu |',
            'Produtos' => $produtos,
            'Erro' => $produtosResponse->status === 'error' ? $produtosResponse->message : null
        ]);
    }

    public function indexAdmin($id)
    {
        $produtoModel = new ProdutosModel();
        $produtosResponse = $produtoModel->findByEstabelecimentoId($id);

        $produtos = ($produtosResponse->status === 'success') ? $produtosResponse->results : [];

        $this->loadView('empresarial/cardapioEmpresa', [
            'Title' => 'HubMenu |',
            'Produtos' => $produtos,
            'EstabelecimentoID' => $id,
            'Erro' => $produtosResponse->status === 'error' ? $produtosResponse->message : null
        ]);
    }
}