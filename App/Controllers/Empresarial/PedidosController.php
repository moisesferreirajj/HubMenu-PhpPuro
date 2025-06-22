<?php
require_once 'App/Controllers/Cadastros/ProdutosController.php';
class PedidosController {
    private $pedidosModel;
    private $produtosModel;
    private $usuariosModel;

    public function __construct() {
        $this->pedidosModel = new PedidosModel();
        $this->produtosModel = new ProdutosModel();
        $this->usuariosModel = new UsuariosModel();
    }

    public function indexEmpresa() {
        $userCompany = $this->usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
        $ordersResponse = $this->pedidosModel->getOrderByCompanyId($userCompany);
        $menuProducts = $this->produtosModel->searchByEstabelecimentoAndCondition($userCompany);
        
        require_once 'Views/pedidosEmpresa.php';
    }

    public function registerOrder() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $userCompany = $this->usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
                
                // Calcula o valor total
                $valor_total = 0;
                $produtos_info = [];
                
                foreach ($_POST['products'] as $produto_id) {
                    $produto = $this->produtosModel->findById($produto_id);
                    $quantidade = $_POST['quantidade'][$produto_id] ?? 1;
                    $valor_total += $produto->valor * $quantidade;
                    
                    $produtos_info[] = [
                        'produto_id' => $produto_id,
                        'quantidade' => $quantidade,
                        'observacao' => $_POST['observacao'][$produto_id] ?? null
                    ];
                }
                
                // Cadastra o pedido
                $pedido_id = $this->pedidosModel->cadastrarPedido([
                    'usuario_id' => $_SESSION['usuario_id'],
                    'estabelecimento_id' => $userCompany,
                    'nome_cliente' => $_POST['nome_cliente'],
                    'valor_total' => $valor_total
                ]);
                
                // Cadastra os produtos do pedido
                foreach ($produtos_info as $produto) {
                    $this->pedidosModel->adicionarProdutoPedido(
                        $pedido_id,
                        $produto['produto_id'],
                        $produto['quantidade'],
                        $produto['observacao']
                    );
                }
                
                $_SESSION['mensagem'] = 'Pedido cadastrado com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';
                
            } catch (Exception $e) {
                $_SESSION['mensagem'] = 'Erro ao cadastrar pedido: ' . $e->getMessage();
                $_SESSION['tipo_mensagem'] = 'danger';
            }
            
            header('Location: /pedidos/' . $userCompany);
            exit();
        }
    }

    public function atualizarStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $pedido_id = $_POST['pedido_id'];
                $status = $_POST['status'];
                
                $this->pedidosModel->atualizarStatusPedido($pedido_id, $status);
                
                $_SESSION['mensagem'] = 'Status atualizado com sucesso!';
                $_SESSION['tipo_mensagem'] = 'success';
                
            } catch (Exception $e) {
                $_SESSION['mensagem'] = 'Erro ao atualizar status: ' . $e->getMessage();
                $_SESSION['tipo_mensagem'] = 'danger';
            }
            
            $userCompany = $this->usuariosModel->getCompanyByUserId($_SESSION['usuario_id']);
            header('Location: /pedidos/' . $userCompany);
            exit();
        }
    }
}