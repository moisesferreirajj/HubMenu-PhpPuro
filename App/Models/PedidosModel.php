<?php
    class PedidosModel
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database();
        }

        public function getOrders()
        {
            $sql = "SELECT p.id, p.data_pedido, p.status 
                    FROM pedidos p
                    ORDER BY p.data_pedido DESC";

            $result = $this->db->execute_query($sql);

            return $result->status === 'success' ? $result->results : [];
        }

        public function getOrderByCompanyId($estabelecimento_id)
        {
            // 1. Buscar pedidos
            $sqlPedidos = "SELECT 
                    p.id, 
                    u.nome AS cliente, 
                    p.valor_total, 
                    p.observacao,
                    p.status, 
                    p.avaliacao, 
                    p.data_pedido
                FROM pedidos p
                JOIN usuarios u ON u.id = p.usuario_id
                WHERE p.estabelecimento_id = :estabelecimento_id
                ORDER BY p.data_pedido DESC";

            $params = [':estabelecimento_id' => $estabelecimento_id];
            $resultPedidos = $this->db->execute_query($sqlPedidos, $params);

            if ($resultPedidos->status !== 'success') {
                return [];
            }

            $pedidos = $resultPedidos->results;

            // 2. Para cada pedido, buscar produtos
            foreach ($pedidos as &$pedido) {
                $sqlProdutos = "SELECT 
                        pp.quantidade, 
                        pr.nome, 
                        pr.descricao, 
                        pp.preco_unitario AS valor,
                        pp.observacao
                    FROM pedidos_produtos pp
                    JOIN produtos pr ON pr.id = pp.produto_id
                    WHERE pp.pedido_id = :pedido_id";

                $paramsProdutos = [':pedido_id' => $pedido->id];
                $resultProdutos = $this->db->execute_query($sqlProdutos, $paramsProdutos);

                if ($resultProdutos->status === 'success') {
                    $pedido->produtos = $resultProdutos->results;
                } else {
                    $pedido->produtos = [];
                }
            }

            return $pedidos;
        }

        public function findOrderProdById($pedido_id)
        {
            $sql = "SELECT pp.quantidade, pr.nome, pp.observacao, pr.valor
                    FROM pedidos_produtos pp
                    JOIN produtos pr ON pp.produto_id = pr.id
                    WHERE pp.pedido_id = :pedido_id";

            $params = [':pedido_id' => $pedido_id];
            $result = $this->db->execute_query($sql, $params);

            return $result->status === 'success' ? $result->results : [];
        }

        public function cadastrarPedido($dados) {
            $sql = "INSERT INTO pedidos 
                    (usuario_id, estabelecimento_id, valor_total, observacao, status, data_pedido) 
                    VALUES (:usuario_id, :estabelecimento_id, :valor_total, :observacao, 'pendente', NOW())";

            $params = [
                ':usuario_id' => $dados['usuario_id'],
                ':estabelecimento_id' => $dados['estabelecimento_id'],
                ':valor_total' => $dados['valor_total'],
                ':observacao' => $dados['observacao'] ?? null
            ];

            $result = $this->db->execute_non_query($sql, $params);

            if ($result->status === 'error') {
                throw new Exception($result->message);
            }

            return $result->last_id;
        }

        public function adicionarProdutoPedido($pedido_id, $produto_id, $quantidade, $observacao = null)
        {
            // Busque o valor do produto antes de inserir
            $sqlValor = "SELECT valor FROM produtos WHERE id = :produto_id";
            $paramsValor = [':produto_id' => $produto_id];
            $resultValor = $this->db->execute_query($sqlValor, $paramsValor);

            if ($resultValor->status !== 'success' || empty($resultValor->results)) {
                throw new Exception('Produto não encontrado');
            }

            $valor = $resultValor->results[0]->valor;

            $sql = "INSERT INTO pedidos_produtos (pedido_id, produto_id, quantidade, preco_unitario, observacao)
                    VALUES (:pedido_id, :produto_id, :quantidade, :preco_unitario, :observacao)";

            $params = [
                ':pedido_id' => $pedido_id,
                ':produto_id' => $produto_id,
                ':quantidade' => $quantidade,
                ':preco_unitario' => $valor,
                ':observacao' => $observacao
            ];

            $result = $this->db->execute_non_query($sql, $params);

            if ($result->status === 'error') {
                throw new Exception($result->message);
            }

            return $result->affected_rows > 0;
        }

        public function atualizarStatusPedido($pedido_id, $status)
        {
            $sql = "UPDATE pedidos SET status = :status WHERE id = :pedido_id";

            $params = [
                ':pedido_id' => $pedido_id,
                ':status' => $status
            ];

            $result = $this->db->execute_non_query($sql, $params);

            if ($result->status === 'error') {
                throw new Exception($result->message);
            }

            return $result->affected_rows > 0;
        }

        public function searchByEstabelecimentoAndCondition($estabelecimento_id)
        {
            if (!$estabelecimento_id) {
                throw new Exception('ID do estabelecimento não fornecido.');
            }

            $sql = "SELECT * FROM produtos WHERE estabelecimento_id = :estabelecimento_id";
            $params = [':estabelecimento_id' => $estabelecimento_id];
            $result = $this->db->execute_query($sql, $params);

            return $result->status === 'success' ? $result->results : [];
        }

        public function getRecentOrdersByCompanyId($estabelecimento_id, $limit = 4)
        {
            $db = new Database();
            $sql = "SELECT 
                        pedidos.id,
                        clientes.nome AS cliente_nome,
                        estabelecimentos.nome AS estabelecimento_nome,
                        pedidos.status,
                        pedidos.valor_total,
                        pedidos.data_pedido
                    FROM pedidos
                    JOIN usuarios AS clientes ON clientes.id = pedidos.usuario_id
                    JOIN estabelecimentos ON estabelecimentos.id = pedidos.estabelecimento_id
                    WHERE pedidos.estabelecimento_id = :estabelecimento_id
                    ORDER BY pedidos.data_pedido DESC
                    LIMIT $limit";
            $params = [':estabelecimento_id' => $estabelecimento_id];
            $result = $db->execute_query($sql, $params);
            return $result->status === 'success' ? $result->results : [];
        }

        public function atualizarStatus($pedido_id, $status)
        {
            $sql = "UPDATE pedidos SET status = :status WHERE id = :pedido_id";
            $params = [
                ':pedido_id' => $pedido_id,
                ':status' => $status
            ];
            $result = $this->db->execute_non_query($sql, $params);

            if ($result->status === 'error') {
                throw new Exception($result->message);
            }

            return $result->affected_rows > 0;
        }

        public function findById($pedido_id)
        {
            $sql = "SELECT * FROM pedidos WHERE id = :pedido_id";
            $params = [':pedido_id' => $pedido_id];
            $result = $this->db->execute_query($sql, $params);

            if ($result->status === 'success' && !empty($result->results)) {
                return $result->results[0];
            }
            return null;
        }

        public function atualizarValorTotal($pedido_id, $valor_total)
        {
            $sql = "UPDATE pedidos SET valor_total = :valor_total WHERE id = :pedido_id";
            $params = [
                ':valor_total' => $valor_total,
                ':pedido_id' => $pedido_id
            ];
            $result = $this->db->execute_non_query($sql, $params);

            if ($result->status === 'error') {
                throw new Exception($result->message);
            }

            return $result->affected_rows > 0;
        }
    }