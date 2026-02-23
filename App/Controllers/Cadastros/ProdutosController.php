<?php

class ProdutosController extends RenderView
{
    public function index()
    {
        $estabelecimentos = (new EstabelecimentosModel())->findAll();
        $categorias = (new CategoriasModel())->findAll();

        $this->loadView('Components/Cadastros/cadastrarProdutos', [
            'Title' => 'HubMenu |'
        ]);
    }

    public function cadastrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $categoria_id = $_POST['categoria_id'];
            $estabelecimento_id = $_POST['estabelecimento_id'] ?? null;

            if (!$estabelecimento_id) {
                die('Estabelecimento não informado.');
            }

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
            $produtosModel->insert($nome, $descricao, $valor, $imagemPath, $estabelecimento_id, $categoria_id, 1);

            echo "<script>
                alert('Produto cadastrado com sucesso!');
                window.location.href = '/gerenciar/cardapio/$estabelecimento_id';
            </script>";
            exit;
        }
    }

    public function getCategorias(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $categorias = (new CategoriasModel())->findAll();
        echo json_encode(['status' => 'success', 'categorias' => $categorias], JSON_UNESCAPED_UNICODE);
    }

    public function getEstabelecimentos(): void
    {
        header('Content-Type: application/json; charset=utf-8');
        $estabelecimentos = (new EstabelecimentosModel())->findAll();
        echo json_encode(['status' => 'success', 'estabelecimentos' => $estabelecimentos], JSON_UNESCAPED_UNICODE);
    }

    public function atualizar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $nome = $_POST['nome'];
            $descricao = $_POST['descricao'];
            $valor = $_POST['valor'];
            $categoria_id = $_POST['categoria_id'];
            $estabelecimento_id = $_POST['estabelecimento_id'];

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

                $imagemPath = $nomeImagem;
            } else {
                $imagemPath = null;
            }

            $produtosModel = new ProdutosModel();
            $produtosModel->update($id, $nome, $descricao, $valor, $imagemPath, $estabelecimento_id, $categoria_id, 1);

            echo "<script>
                alert('Produto editado com sucesso!');
                window.location.href = '/gerenciar/cardapio/$estabelecimento_id';
            </script>";
            exit;
        } else {
            echo "Erro: Requisição inválida.";
        }
    }

    public function getProdutos($estabelecimento_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $produtosModel = new ProdutosModel();
        $produtos = $produtosModel->findByEstabelecimentoId($estabelecimento_id);
        echo json_encode(['status' => 'success', 'produtos' => $produtos], JSON_UNESCAPED_UNICODE);
    }

    public function getProdutoPorId($id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $produtosModel = new ProdutosModel();
        $produto = $produtosModel->findById($id);

        if ($produto) {
            echo json_encode(['status' => 'success', 'produto' => $produto[0]], JSON_UNESCAPED_UNICODE);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado']);
        }
    }

    public function adicionarProdutoPedido($pedido_id, $produto_id, $quantidade, $observacao, $preco_unitario)
    {
        $db = new Database();
        $sql = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade, preco_unitario, observacao)
                VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario, :observacao)";
        $params = [
            ':pedido_id' => intval($pedido_id),
            ':produto_id' => intval($produto_id),
            ':quantidade' => intval($quantidade),
            ':preco_unitario' => floatval($preco_unitario),
            ':observacao' => $observacao
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Atualiza o valor total de um pedido.
     */
    public function atualizarValorTotal($pedido_id, $valor_total)
    {
        $db = new Database();
        $sql = "UPDATE pedidos SET valor_total = :valor_total WHERE id = :pedido_id";
        $params = [
            ':pedido_id' => intval($pedido_id),
            ':valor_total' => floatval($valor_total)
        ];
        return $db->execute_non_query($sql, $params);
    }

    /**
     * Busca um pedido pelo ID.
     */
    public function findById($pedido_id)
    {
        $db = new Database();
        $sql = "SELECT * FROM pedidos WHERE id = :pedido_id";
        $params = [':pedido_id' => intval($pedido_id)];
        $result = $db->execute_query($sql, $params);
        return $result->results[0] ?? null;
    }

    public function desativar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'] ?? null;
            if ($id) {
                (new ProdutosModel())->desativarProduto($id);
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
                (new ProdutosModel())->ativarProduto($id);
                echo json_encode(['status' => 'success', 'message' => 'Produto ativado com sucesso.']);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'ID do produto não informado.']);
            }
        }
    }



    public function searchProdutos($estabelecimento_id)
    {
        header('Content-Type: application/json; charset=utf-8');
        $query = $_GET['query'] ?? '';
        $produtosModel = new ProdutosModel();
        $produtos = $produtosModel->searchByEstabelecimentoAndQuery($estabelecimento_id, $query);
        echo json_encode(['status' => 'success', 'produtos' => $produtos], JSON_UNESCAPED_UNICODE);
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

    // Exemplo de método no controller de API
    public function visualizarProdutos($estabelecimentoId)
    {
        $produtosModel = new ProdutosModel();
        $produtos = $produtosModel->findByEstabelecimentoId($estabelecimentoId);

        // Filtra apenas produtos ativos, se necessário
        $produtosAtivos = array_filter($produtos, function($produto) {
            return $produto->status_produtos == 1;
        });

        echo json_encode([
            'status' => 'success',
            'produtos' => array_values($produtosAtivos)
        ]);
    }
}
