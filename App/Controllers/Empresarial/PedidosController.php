<?php

class PedidosController
{

    public function indexEmpresa()
    {
        $uri = $_SERVER['REQUEST_URI'];
        $segments = explode('/', trim($uri, '/'));
        $companyId = isset($segments[1]) ? (int)$segments[1] : null;

        if (!$companyId) {
            throw new Exception("ID da empresa não encontrado na URL");
        }

        if (!isset($_SESSION['usuario_id'])) {
            throw new Exception('Usuário não está autenticado.');
        }

        $usuariosModel = new UsuariosModel();
        $pedidosModel = new PedidosModel();
        $orders = $pedidosModel->getOrderByCompanyId($companyId);

        require_once 'Views/Empresarial/pedidosEmpresa.php';
    }

    public function registerOrder()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (!isset($_SESSION['usuario_id'])) {
                    throw new Exception('Usuário não autenticado.');
                }

                $usuariosModel = new UsuariosModel();
                $pedidosModel = new PedidosModel();
                $produtosModel = new ProdutosModel();

                $userCompany = $usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
                $estabelecimento_id = is_object($userCompany) ? $userCompany->id : $userCompany;

                if (!$estabelecimento_id) {
                    throw new Exception('Empresa do usuário não encontrada.');
                }

                // Recebe o nome do cliente do formulário
                $nomeCliente = $_POST['nome_cliente'] ?? null;
                if (!$nomeCliente) {
                    throw new Exception("Nome do cliente é obrigatório");
                }

                // Cria o cliente na tabela usuarios e pega o id gerado
                $clienteId = $usuariosModel->criar($nomeCliente);

                // Prepara os produtos selecionados
                $produtos_info = [];
                if (!empty($_POST['products'])) {
                    foreach ($_POST['products'] as $produto_id) {
                        $produtos_info[] = [
                            'produto_id' => $produto_id,
                            'quantidade' => $_POST['quantidade'][$produto_id] ?? 1,
                            'observacao' => $_POST['observacao'][$produto_id] ?? null
                        ];
                    }
                }

                // Calcula o valor total do pedido
                $valor_total = 0;
                foreach ($produtos_info as $produto) {
                    $produtoInfo = $produtosModel->findById($produto['produto_id']);
                    if ($produtoInfo) {
                        $valor_total += $produtoInfo->valor * $produto['quantidade'];
                    }
                }

                // Cadastra o pedido usando o id do cliente criado
                $pedido_id = $pedidosModel->cadastrarPedido([
                    'usuario_id' => $clienteId,
                    'estabelecimento_id' => $estabelecimento_id,
                    'valor_total' => $valor_total,
                    'observacao' => $_POST['observacao_geral'] ?? null
                ]);

                if (!$pedido_id) {
                    throw new Exception("Erro ao cadastrar pedido.");
                }

                // Adiciona produtos ao pedido
                foreach ($produtos_info as $produto) {
                    $pedidosModel->adicionarProdutoPedido(
                        $pedido_id,
                        $produto['produto_id'],
                        $produto['quantidade'],
                        $produto['observacao'] ?? null
                    );
                }

                echo "<script>
                        alert('Pedido cadastrado com sucesso!');
                        window.location.href = '/pedidos/{$estabelecimento_id}';
                      </script>";
                exit;
            } catch (Exception $e) {
                echo "<script>
                        alert('Erro ao cadastrar pedido: " . addslashes($e->getMessage()) . "');
                        window.history.back();
                      </script>";
                exit;
            }
        }
    }
    public function adicionarProdutoAoPedidoExistente()
    {
        // Força o content-type para JSON
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Método não permitido']);
            return;
        }

        try {
            $pedido_id = $_POST['pedido_id'] ?? null;
            $produto_ids = $_POST['products'] ?? [];
            $quantidades = $_POST['quantidade'] ?? [];
            $observacoes = $_POST['observacao'] ?? [];

            if (!$pedido_id || empty($produto_ids)) {
                echo json_encode(['status' => 'error', 'message' => 'ID do pedido ou produtos não informados.']);
                return;
            }

            $pedidosModel = new PedidosModel();
            $produtosModel = new ProdutosModel();

            // Verifica se o pedido existe
            $pedido = $pedidosModel->findById($pedido_id);
            if (!$pedido) {
                echo json_encode(['status' => 'error', 'message' => 'Pedido não encontrado']);
                return;
            }

            // Verifica se o usuário tem permissão para modificar este pedido
            if (!isset($_SESSION['usuario_id'])) {
                echo json_encode(['status' => 'error', 'message' => 'Usuário não autenticado']);
                return;
            }

            $usuariosModel = new UsuariosModel();
            $userCompany = $usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
            $estabelecimento_id = is_object($userCompany) ? $userCompany->id : $userCompany;

            if ($pedido->estabelecimento_id != $estabelecimento_id) {
                echo json_encode(['status' => 'error', 'message' => 'Você não tem permissão para modificar este pedido']);
                return;
            }

            $produtosAdicionados = 0;
            $valorAdicional = 0;

            foreach ($produto_ids as $produto_id) {
                // Verifica se o produto existe
                $produto = $produtosModel->findById($produto_id);
                if (!$produto) {
                    echo json_encode(['status' => 'error', 'message' => "Produto ID {$produto_id} não encontrado"]);
                    return;
                }

                // Verifica se o produto pertence ao mesmo estabelecimento do pedido
                if ($produto->estabelecimento_id != $pedido->estabelecimento_id) {
                    echo json_encode(['status' => 'error', 'message' => "Produto ID {$produto_id} não pertence ao estabelecimento do pedido"]);
                    return;
                }

                $quantidade = isset($quantidades[$produto_id]) ? (int)$quantidades[$produto_id] : 1;
                $observacao = $observacoes[$produto_id] ?? null;

                // Adiciona o produto ao pedido
                $success = $pedidosModel->adicionarProdutoPedido($pedido_id, $produto_id, $quantidade, $observacao);

                if ($success) {
                    $produtosAdicionados++;
                    $valorAdicional += $produto->valor * $quantidade;
                }
            }

            if ($produtosAdicionados > 0) {
                // Atualiza o valor total do pedido
                $novoValorTotal = $pedido->valor_total + $valorAdicional;
                $pedidosModel->atualizarValorTotal($pedido_id, $novoValorTotal);

                $mensagem = $produtosAdicionados === 1 ?
                    'Produto adicionado com sucesso!' :
                    "{$produtosAdicionados} produtos adicionados com sucesso!";

                echo json_encode(['status' => 'success', 'message' => $mensagem]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Nenhum produto foi adicionado']);
            }
        } catch (Exception $e) {
            echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
        }
    }

    public function atualizarStatus()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $usuariosModel = new UsuariosModel();
                $pedidosModel = new PedidosModel();

                $pedido_id = $_POST['pedido_id'];
                $status = $_POST['status'];

                $pedidosModel->atualizarStatusPedido($pedido_id, $status);

                $_SESSION['mensagem'] = 'Status atualizado com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';

                header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
                exit;
            } catch (Exception $e) {
                $_SESSION['mensagem'] = 'Erro ao atualizar status: ' . $e->getMessage();
                $_SESSION['tipo_mensagem'] = 'danger';

                header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/'));
                exit;
            }
        }
    }

    public function salvar()
    {
        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            die('Usuário não autenticado!');
        }

        $nomeCliente = $_POST['nome_usuario'];
        $usuarioLogadoId = $_SESSION['usuario_id'];

        $usuariosModel = new UsuariosModel();
        $pedidosModel = new PedidosModel();


        $dadosPedido = [
            'nome_usuario' => $nomeCliente,
            'id_usuario' => $usuarioLogadoId
        ];

        $pedidosModel->cadastrarPedido($dadosPedido);

        header("Location: /pedidos");
        exit;
    }

    public function salvarCliente($cliente)
    {
        session_start();

        $usuariosModel = new UsuariosModel();

        if (!isset($_SESSION['usuario_id'])) {
            die('Usuário não autenticado!');
        }

        $guestClient = $_POST['cliente_id'];

        $clienteNome = $_POST['nome_cliente'] ?? null;
        if (!$clienteNome) {
            throw new Exception("Nome do cliente é obrigatório");
        }

        $clienteId = $usuariosModel->criar($clienteNome);
        if (!$clienteId) {
            throw new Exception("Erro ao criar cliente visitante");
        }
        header("Location: /pedidos");
        exit;
    }
}
