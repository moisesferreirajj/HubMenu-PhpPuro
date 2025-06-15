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
        $produtoModel = new ProdutosModel();
        $estabelecimentosModel = new EstabelecimentosModel();

        $produtosResponse = $produtoModel->findByEstabelecimentoId($id);
        $estabelecimentoResponse = $estabelecimentosModel->findById($id);

        $produtos = ($produtosResponse->status === 'success') ? $produtosResponse->results : [];
        // Mantendo como objeto para facilitar uso na view
        $estabelecimento = ($estabelecimentoResponse->status === 'success') ? $estabelecimentoResponse->results : null;

        // Debug - imprime o estabelecimento e para a execução para você ver os dados
        // echo '<pre>Estabelecimento:' . PHP_EOL;
        // print_r($estabelecimento);
        // echo '</pre>';
        // exit;

        $this->loadView('empresarial/cardapioEmpresa', [
            'Title' => 'HubMenu |',
            'Produtos' => $produtos,
            'EstabelecimentoID' => $id,
            'Estabelecimento' => $estabelecimento,
            'Erro' => $produtosResponse->status === 'error' ? $produtosResponse->message : null
        ]);
    }
}
