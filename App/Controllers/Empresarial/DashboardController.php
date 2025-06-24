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
        $cargosModel = new CargosModel();

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

        $CategoriasObj = $categoriasModel->findAll() ?? [];
        $categorias = $CategoriasObj->results ?? [];

        $cargosObj = $cargosModel->findAll();
        $cargos = $cargosObj->results ?? [];

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
            'Categorias' => $categorias,
            'Cargos' => $cargos
        ]);
    }

    public function Categoria()
    {
        // Cadastro de Categoria
        if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar_categoria') {
            $categoriasModel = new CategoriasModel();
            $nome = $_POST['nome'] ?? '';
            $categoriasModel->insert($nome);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Editar Categoria
        if (isset($_POST['acao']) && $_POST['acao'] === 'editar_categoria') {
            $categoriasModel = new CategoriasModel();
            $id = $_POST['id'] ?? null;
            $nome = $_POST['nome'] ?? '';
            if ($id && $nome) {
                $categoriasModel->update($id, $nome);
                echo "<script>alert('Categoria atualizada com sucesso!'); window.location.href = '" . $_SERVER['REQUEST_URI'] . "';</script>";
                exit;
            }
        }
    }

    public function Produto()
    {

        // Cadsatro Produto
        if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar_produto') {
            $produtosModel = new ProdutosModel();
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $valor = $_POST['valor'] ?? 0;
            $categoria_id = $_POST['categoria_id'] ?? null;
            $estabelecimento_id = $_POST['estabelecimento_id'] ?? null;
            $status_produtos = $_POST['status_produtos'] ?? 1;
            $imagem = null;

            // Upload de imagem (opcional)
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $permitidas = ['png', 'jpg', 'jpeg', 'webp'];
                if (in_array($ext, $permitidas)) {
                    $nomeImagem = uniqid() . '.' . $ext;
                    $destino = __DIR__ . '/../../Views/Assets/Images/Produtos/' . $nomeImagem;
                    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                        $imagem = '/Views/Assets/Images/Produtos/' . $nomeImagem;
                    }
                }
            }

            $produtosModel->insert($nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id, $status_produtos);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        // Editar Produto
        if (isset($_POST['acao']) && $_POST['acao'] === 'editar_produto') {
            $produtosModel = new ProdutosModel();
            $id = $_POST['id'] ?? null;
            $nome = $_POST['nome'] ?? '';
            $descricao = $_POST['descricao'] ?? '';
            $valor = $_POST['valor'] ?? 0;
            $categoria_id = $_POST['categoria_id'] ?? null;
            $estabelecimento_id = $_POST['estabelecimento_id'] ?? null; // <-- PEGUE O ESTABELECIMENTO
            $status_produtos = $_POST['status_produtos'] ?? 1;
            $imagem = null;

            // Upload de imagem (opcional)
            if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
                $ext = strtolower(pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION));
                $permitidas = ['png', 'jpg', 'jpeg', 'webp'];
                if (in_array($ext, $permitidas)) {
                    $nomeImagem = uniqid() . '.' . $ext;
                    $destino = __DIR__ . '/../../Views/Assets/Images/Produtos/' . $nomeImagem;
                    if (move_uploaded_file($_FILES['imagem']['tmp_name'], $destino)) {
                        $imagem = '/Views/Assets/Images/Produtos/' . $nomeImagem;
                    }
                }
            }

            if ($id && $nome) {
                $produtosModel->update($id, $nome, $descricao, $valor, $imagem, $estabelecimento_id, $categoria_id, $status_produtos);
                echo "<script>alert('Produto atualizado com sucesso!'); window.location.href = '" . $_SERVER['REQUEST_URI'] . "';</script>";
                exit;
            }
        }
    }

    public function Usuario()
    {
        // Cadastro de Usuário
        if (isset($_POST['acao']) && $_POST['acao'] === 'cadastrar_usuario') {
            $usuariosModel = new UsuariosModel();
            $nome = $_POST['nome'] ?? '';
            $email = $_POST['email'] ?? '';
            $telefone = $_POST['telefone'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $senha2 = $_POST['senha2'] ?? '';
            $cargo_id = $_POST['cargo'] ?? '';
            $estabelecimento_id = $_POST['estabelecimento_id'] ?? null;

            if ($senha !== $senha2) {
                echo "<script>alert('Cadastro Realizado!'); window.location.href = '" . $_SERVER['REQUEST_URI'] . "';</script>";
                exit;
            }

            $senhaHash = password_hash($senha, PASSWORD_DEFAULT);

            // 1. Insere o usuário
            $usuario_id = $usuariosModel->insert($nome, $senhaHash, $email, $cargo_id, null, null, $telefone);

            // 2. Insere o vínculo na tabela estabelecimentos_usuarios
            if ($usuario_id && $estabelecimento_id && $cargo_id) {
                $estabUsuariosModel = new EstabelecimentosUsuariosModel();
                $estabUsuariosModel->insert($estabelecimento_id, $usuario_id, $cargo_id);
            }

            echo "<script>alert('Cadastro Realizado'); window.history.back()</script>";
            exit;
        }
    }

    public function Pedido()
    {
        // Atualizar status do pedido
        if (isset($_POST['acao']) && $_POST['acao'] === 'editar_status_pedido') {
            $pedidoId = $_POST['pedido_id'] ?? null;
            $novoStatus = $_POST['status'] ?? null;

            if ($pedidoId && $novoStatus) {
                // Exemplo de model, ajuste conforme seu projeto
                $pedidosModel = new PedidosModel();
                $pedidosModel->atualizarStatus($pedidoId, $novoStatus);
                echo "<script>alert('Status do pedido atualizado!'); window.location.href = '" . $_SERVER['REQUEST_URI'] . "';</script>";
                exit;
            }
        }
    }
}