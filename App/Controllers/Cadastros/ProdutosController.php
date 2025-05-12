<?php

@require_once __DIR__ . '/../../Models/ProdutosModel.php';

class ProdutosController extends RenderView
{
    /**
     * Exibe o formulário para cadastro de produto.
     */
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('Cadastros/cadastrarProdutos',
            [
                'Title' => 'HubMenu |',
                'users' => $users->findAll()
            ],
        );
    }

    /**
     * Processa o cadastro de um produto.
     */
    public function cadastrar()
    {
        if (isset($_SERVER['REQUEST_METHOD']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $id_estabelecimento = $_POST['id_estabelecimento'];

            $produtosModel = new ProdutosModel();
            $produtosModel->insert($nome, $descricao, $valor, $id_estabelecimento);

            echo "Produto cadastrado com sucesso!";
        }
    }
}