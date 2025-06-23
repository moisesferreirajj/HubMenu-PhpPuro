<?php

class PedidosController {

    /**
     * Lista pedidos e produtos da empresa, recebendo o ID da empresa via parâmetro
     */
    public function indexEmpresa()
    {
        $uri = $_SERVER['REQUEST_URI']; // ex: /pedidos/1
        $segments = explode('/', trim($uri, '/')); // ['pedidos', '1']
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

    /**
     * Registra novo pedido para a empresa do usuário logado
     */
    public function registerOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                if (!isset($_SESSION['usuario_id'])) {
                    throw new Exception('Usuário não autenticado.');
                }

                $usuariosModel = new UsuariosModel();
                $pedidosModel = new PedidosModel();
                $produtosModel = new ProdutosModel();

                // Pega empresa do usuário
                $userCompany = $usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
                if (!$userCompany || !isset($userCompany)) {
                    throw new Exception('Empresa do usuário não encontrada.');
                }

                $valor_total = 0;
                $produtos_info = [];

                foreach ($_POST['products'] as $produto_id) {
                    $produto = $produtosModel->findById($produto_id);
                    $quantidade = $_POST['quantidade'][$produto_id] ?? 1;
                    $valor_total += $produto->valor * $quantidade;

                    $produtos_info[] = [
                        'produto_id' => $produto_id,
                        'quantidade' => $quantidade,
                        'observacao' => $_POST['observacao'][$produto_id] ?? null
                    ];
                }

                // Cadastra pedido
                $pedido_id = $pedidosModel->cadastrarPedido([
                    'usuario_id' => $_SESSION['usuario_id'],
                    'estabelecimento_id' => $userCompany,
                    'nome_cliente' => $_POST['nome_cliente'],
                    'valor_total' => $valor_total
                ]);

                // Adiciona produtos no pedido
                foreach ($produtos_info as $produto) {
                    $pedidosModel->adicionarProdutoPedido(
                        $pedido_id,
                        $produto['produto_id'],
                        $produto['quantidade'],
                        $produto['observacao']
                    );
                }

                $_SESSION['mensagem'] = 'Pedido cadastrado com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';

                header('Location: /pedidos/' . $userCompany);
                exit();

            } catch (Exception $e) {
                $_SESSION['mensagem'] = 'Erro ao cadastrar pedido: ' . $e->getMessage();
                $_SESSION['tipo_mensagem'] = 'danger';

                // Redireciona para a página da empresa do usuário (se possível)
                $userCompanyId = isset($userCompany) ? $userCompany : '';
                header('Location: /pedidos/' . $userCompanyId);
                exit();
            }
        }
    }

    /**
     * Atualiza status do pedido
     */
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

                // Redireciona para a página anterior
                $referer = $_SERVER['HTTP_REFERER'] ?? '/';
                header('Location: ' . $referer);
                exit();

            } catch (Exception $e) {
                $_SESSION['mensagem'] = 'Erro ao atualizar status: ' . $e->getMessage();
                $_SESSION['tipo_mensagem'] = 'danger';

                $referer = $_SERVER['HTTP_REFERER'] ?? '/';
                header('Location: ' . $referer);
                exit();
            }
        }
    }

}
