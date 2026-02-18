<?php

class DashClienteController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('Clientes/dashCliente',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
