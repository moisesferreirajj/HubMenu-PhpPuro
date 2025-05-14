<?php

@require_once __DIR__ . '/../../Models/ProdutosModel.php';
@require_once __DIR__ . '/../../Models/EstabelecimentosModel.php';
@require_once __DIR__ . '/../../Models/CategoriasModel.php';

class ProdutosController extends RenderView
{
    /**
     * Exibe o formulário para cadastro de produto.
     */
    public function index()
    {
        $estabelecimentos = (new EstabelecimentosModel())->findAll();
        $categorias = (new CategoriasModel())->findAll();

        $this->loadView('Cadastros/cadastrarProdutos', [
            'Title' => 'HubMenu |'
        ]);
    }

    /**
     * Processa o cadastro de um produto.
     */
    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $estabelecimento_id = $_POST['estabelecimento_id'];
            $categoria_id = $_POST['categoria_id'];

            // Upload de imagem
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $extensoesPermitidas = ['png', 'jpg', 'jpeg', 'webp'];

                if (!in_array($ext, $extensoesPermitidas)) {
                    die('Apenas imagens nos formatos .png, .jpg, .jpeg ou .webp são permitidas.');
                }

                $nomeImagem = uniqid() . '.' . $ext;
                $caminhoDestino = __DIR__ . '/../../Views/Assets/Images/Produtos/' . $nomeImagem;

                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                    die('Erro ao salvar a imagem.');
                }

                $imagemPath = '/Views/Assets/Images/Produtos/' . $nomeImagem;
            } else {
                die('Imagem não enviada corretamente.');
            }

            $produtosModel = new ProdutosModel();
            $produtosModel->insert($nome, $descricao, $valor, $imagemPath, $estabelecimento_id, $categoria_id);

            echo "Produto cadastrado com sucesso!";
        }
    }

    /**
     * Exibe todas as categorias via API.
     */
    public function getCategorias()
    {
        $categorias = (new CategoriasModel())->findAll();
        echo json_encode(['status' => 'success', 'categorias' => $categorias]);
    }

    /**
     * Exibe todos os estabelecimentos via API.
     */
    public function getEstabelecimentos()
    {
        $estabelecimentos = (new EstabelecimentosModel())->findAll();
        echo json_encode(['status' => 'success', 'estabelecimentos' => $estabelecimentos]);
    }
}
