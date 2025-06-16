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
        if (!isset($_SESSION['usuario_cargo'])){
            echo "<script>alert('Você não está logado em uma conta!'); window.location.href = '/empresarial/login';</script>";
            exit();
        }

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
}
