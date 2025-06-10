<?php

class PedidosController extends RenderView
{
    public function indexEmpresa(){
        $users = new UsuariosModel();

        $this->loadView('empresarial/pedidosEmpresa',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
