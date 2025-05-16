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

        $this->loadView('Components/Cadastros/cadastrarProdutos', [
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
            // Recebendo os dados do formulário
            $id = $_POST['id']; // ID do produto que será atualizado
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $estabelecimento_id = $_POST['estabelecimento_id'];
            $categoria_id = $_POST['categoria_id'];

            // Verificando se a imagem foi enviada
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                // Validação de extensão de imagem
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $extensoesPermitidas = ['png', 'jpg', 'jpeg', 'webp'];

                if (!in_array($ext, $extensoesPermitidas)) {
                    die('Apenas imagens nos formatos .png, .jpg, .jpeg ou .webp são permitidas.');
                }

                // Gerando nome único para a imagem e movendo o arquivo
                $nomeImagem = uniqid() . '.' . $ext;
                $caminhoDestino = __DIR__ . '/../../Views/Assets/Images/Produtos/' . $nomeImagem;

                if (!move_uploaded_file($_FILES['imagem']['tmp_name'], $caminhoDestino)) {
                    die('Erro ao salvar a imagem.');
                }

                // Caminho da imagem que será armazenado no banco de dados
                $imagemPath = '/Views/Assets/Images/Produtos/' . $nomeImagem;
            } else {
                // Se a imagem não for enviada, apenas usar a imagem antiga, se necessário
                // Caso precise, você pode pegar a imagem atual do produto no banco
                // e não sobrescrever a imagem se não houver novo upload
                // Vamos assumir que a imagem não será alterada neste caso.
                $imagemPath = null; // Este campo será tratado mais tarde no SQL
            }

            // Instanciando o modelo para acessar o banco de dados
            $produtosModel = new ProdutosModel();

            // Atualizando produto no banco
            $produtosModel->update(
                $id, // ID do produto a ser atualizado
                $nome,
                $descricao,
                $valor,
                $imagemPath, // Se imagem for null, não será atualizada
                $estabelecimento_id,
                $categoria_id
            );

            echo "Produto atualizado com sucesso!";
        } else {
            // Caso a requisição não seja POST, você pode retornar algum erro
            echo "Erro: Requisição inválida.";
        }
    }
}