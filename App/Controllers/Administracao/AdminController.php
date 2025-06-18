<?php

class AdminController extends RenderView
{
    public function index(){
        // Se já está logado como admin válido, redireciona
        if (!empty($_SESSION['usuario_id']) && in_array((int)($_SESSION['cargo_id'] ?? 0), [1, 2, 3])) {
            header('Location: /admin/dashboard');
            exit();
        }

        $users = new UsuariosModel();

        $this->loadView('administracao/login',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }

    public function dashboard() {
        if (empty($_SESSION['usuario_id']) || !in_array((int)($_SESSION['cargo_id'] ?? 0), [1, 2, 3])) {
            header('Location: /admin');
            exit();
        }

        $estabelecimentosModel = new EstabelecimentosModel();
        $pedidosModel = new PedidosModel();
        $vendasModel = new VendasModel();
        
        $pedidos = $pedidosModel->getOrders() ?: [];
        $vendasResultado = $vendasModel->findAll();
        $vendas = ($vendasResultado && is_array($vendasResultado->results)) ? $vendasResultado->results : [];

        $totalPedidos = count($pedidos);
        $totalVendas = 0.0;
        $pedidosHoje = 0;
        $hoje = date('Y-m-d');

        foreach ($vendas as $venda) {
            if (isset($venda->status_pagamento) && $venda->status_pagamento === 'Aprovado') {
                $totalVendas += floatval($venda->valor_total ?? 0);
            }

            if (isset($venda->data_venda) && substr($venda->data_venda, 0, 10) === $hoje) {
                $pedidosHoje++;
            }
        }

        $estabelecimentosResultado = $estabelecimentosModel->findAll();
        $estabelecimentos = ($estabelecimentosResultado && is_array($estabelecimentosResultado->results)) ? $estabelecimentosResultado->results : [];
        $estabelecimentosNovos = $estabelecimentosModel->findNewest(5); // pegar 5 mais novos
        $totalEstabelecimentos = count($estabelecimentos);

        $this->loadView('administracao/dashboard', [
            'Title' => 'HubMenu |',
            'totalVendas' => number_format($totalVendas, 2, ',', '.'),
            'totalPedidos' => $totalPedidos,
            'pedidosHoje' => $pedidosHoje,
            'estabelecimentosNovos' => $estabelecimentosNovos,
            'totalEstabelecimentos' => $totalEstabelecimentos
        ]);
    }

}
