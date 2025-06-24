<?php

class PedidosController {

    public function indexEmpresa() {
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

    public function registerOrder() {
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

                // Recolhe produtos do POST
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
                $valor_total = 0;

                // Calcula valor total (opcional)
                foreach ($produtos_info as $produto) {
                    $produtoInfo = $produtosModel->findById($produto['produto_id']);
                    if ($produtoInfo) {
                        $valor_total += $produtoInfo->valor * $produto['quantidade'];
                    }
                }

                // Cria o pedido principal
                $pedido_id = $pedidosModel->cadastrarPedido([
                    'usuario_id' => $_SESSION['usuario_id'],
                    'estabelecimento_id' => $estabelecimento_id,
                    'valor_total' => $valor_total
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
                        $produto['observacao'] ?? null // Evita erro se não existir
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

    public function atualizarStatus() {
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

    public function salvar() {
        session_start();

        if (!isset($_SESSION['usuario_id'])) {
            die('Usuário não autenticado!');
        }

        $nomeCliente = $_POST['nome_usuario'];
        $usuarioLogadoId = $_SESSION['usuario_id'];

        $usuariosModel = new UsuariosModel();
        $pedidosModel = new PedidosModel();

        $clienteId = $usuariosModel->criar($nomeCliente);

        $dadosPedido = [
            'nome_usuario' => $nomeCliente,
            'id_usuario' => $usuarioLogadoId
        ];

        $pedidosModel->criar($dadosPedido);

        header("Location: /pedidos");
        exit;
    }
}
