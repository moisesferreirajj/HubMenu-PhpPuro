<?php

class DashClienteController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('clientes/dashCliente',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
