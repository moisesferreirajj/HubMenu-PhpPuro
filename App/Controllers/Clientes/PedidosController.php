<?php

class PedidosController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('empresarial/pedidosCliente',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
