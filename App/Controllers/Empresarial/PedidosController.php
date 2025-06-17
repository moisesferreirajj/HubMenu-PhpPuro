<?php

class PedidosController extends RenderView
{
    public function indexEmpresa(){
        $users = new UsuariosModel();
        $pedidos = (new PedidosModel())->getOrders();
        $produtos = (new ProdutosModel())->findAll();
        $this->loadView('empresarial/pedidosEmpresa',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }

    // public function registerOrders(){
    //     session_start();

    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         $id = $_POST['id'] ?? null;
            
    // }
}
