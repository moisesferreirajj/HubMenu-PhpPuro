<?php

class ProdutosController extends RenderView
{
    /**
     * Exibe o formulário para cadastro de produto.
     */
    public function index()
    {
        $estabelecimentos = (new EstabelecimentosModel())->findAll();
        $categorias = (new CategoriasModel())->findAll();

        $this->loadView('Components/Cadastros/cadastrarProdutos', [
            'Title' => 'HubMenu |'
        ]);
    }

    /**
     * Processa o cadastro de um produto.
     */
    public function cadastrar()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $categoria_id = $_POST['categoria_id'];
            $estabelecimento_id = $_POST['estabelecimento_id'] ?? null;

            if (!$estabelecimento_id) {
                die('Estabelecimento não informado.');
            }

            //UPLOAD DE IMAGEM
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $permitidas = ['png', 'jpg', 'jpeg', 'webp'];

                if (!in_array($ext, $permitidas)) {
                    die('Apenas imagens .png, .jpg, .jpeg ou .webp são permitidas.');
                }

                $nomeImagem = uniqid() . '.' . $ext;
                $destino = __DIR__ . '/../../Views/Assets/Images/Produtos/' . $nomeImagem;

                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                    die('Erro ao salvar a imagem.');
                }

                $imagemPath = '/Views/Assets/Images/Produtos/' . $nomeImagem;
            } else {
                die('Imagem não enviada corretamente.');
            }

            $produtosModel = new ProdutosModel();
            $produtosModel->insert($nome, $descricao, $valor, $imagemPath, $estabelecimento_id, $categoria_id);

            echo "<script>alert('Produto cadastrado com sucesso!')</script>";
            header(header: "Location: /gerenciar/cardapio/$estabelecimento_id");
        }
    }

    /**
     * Exibe todas as categorias via API.
     */
    public function getCategorias(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $categorias = (new CategoriasModel())->findAll();
        echo json_encode([
            'status' => 'success',
            'categorias' => $categorias
        ], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Exibe todos os estabelecimentos via API.
     */
    public function getEstabelecimentos(): void
    {
        header('Content-Type: application/json; charset=utf-8');

        $estabelecimentos = (new EstabelecimentosModel())->findAll();
        echo json_encode([
            'status' => 'success',
            'estabelecimentos' => $estabelecimentos
        ], JSON_UNESCAPED_UNICODE);
    }


    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //RECEBE OS DADOS DO FORM
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $categoria_id = $_POST['categoria_id'];
            $estabelecimento_id = $_POST['estabelecimento_id'];

            //VERIFICA SE A IMAGEM FOI ENVIADA
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $extensoesPermitidas = ['png', 'jpg', 'jpeg', 'webp'];

                if (!in_array($ext, $extensoesPermitidas)) {
                    die('Apenas imagens nos formatos .png, .jpg, .jpeg ou .webp são permitidas.');
                }

                //GERANDO O NOME ÚNICO DO ARQUIVO
                $nomeImagem = uniqid() . '.' . $ext;
                $caminhoDestino = __DIR__ . '/../../Views/Assets/Images/Produtos/' . $nomeImagem;

                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                    die('Erro ao salvar a imagem.');
                }

                //IMAGEM SERÁ GUARDADA AQUI
                $imagemPath = '/Views/Assets/Images/Produtos/' . $nomeImagem;
            } else {
                $imagemPath = null;
            }

            $produtosModel = new ProdutosModel();

            //ATUALIZAÇÃO NO BANCO
            $produtosModel->update(
                $id,
                $nome,
                $descricao,
                $valor,
                $imagemPath,
                $estabelecimento_id,
                $categoria_id
            );

            echo "<script>alert('Produto editado com sucesso!')</script>";
            header(header: "Location: /gerenciar/cardapio/$estabelecimento_id");
        } else {
            echo "Erro: Requisição inválida.";
        }
    }

    public function getProdutos($estabelecimento_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $produtosModel = new ProdutosModel();
        $produtos = $produtosModel->findByEstabelecimentoId($estabelecimento_id);

        echo json_encode([
            'status' => 'success',
            'produtos' => $produtos
        ], JSON_UNESCAPED_UNICODE);
    }

    public function getProdutoPorId($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $produtosModel = new ProdutosModel();
        $produto = $produtosModel->findById($id);

        if ($produto) {
            echo json_encode([
                'status' => 'success',
                'produto' => $produto[0]
            ], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode([
                'status' => 'error',
                'message' => 'Produto não encontrado'
            ]);
        }
    }

    public function desativar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                (new ProdutosModel())->desativar($id);
                echo json_encode(['status' => 'success', 'message' => 'Produto desativado com sucesso.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID do produto não informado.']);
            }
        }
    }

    public function ativar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                (new ProdutosModel())->ativar($id);
                echo json_encode(['status' => 'success', 'message' => 'Produto ativado com sucesso.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID do produto não informado.']);
            }
        }
    }

    public function searchProdutos($estabelecimento_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        
        //PEGA O PRODUTO PELO GET DE QUERY
        $query = $_GET['query'] ?? '';

        $produtosModel = new ProdutosModel();
        $produtos = $produtosModel->searchByEstabelecimentoAndQuery($estabelecimento_id, $query);

        echo json_encode([
            'status' => 'success',
            'produtos' => $produtos
        ], JSON_UNESCAPED_UNICODE);
    }

    public function excluir()
    {
        $id = $_POST['id'] ?? json_decode(file_get_contents('php://input'), true)['id'] ?? null;
        
        if (!$id) {
            echo json_encode(['status' => 'error', 'message' => 'ID inválido']);
            return;
        }

        $model = new ProdutosModel();
        $result = $model->delete($id);

        if ($result->status === 'success' && $result->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Produto excluído com sucesso']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado ou não foi excluído']);
        }
    }

}