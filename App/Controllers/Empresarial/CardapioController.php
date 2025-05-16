<?php

class CardapioController extends RenderView
{
    public function indexCliente(){
        $users = new UsuariosModel();
        $this->loadView('cardapioCliente',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }

    public function indexAdmin(){
        $users = new UsuariosModel();
        $this->loadView('empresarial/cardapioEmpresa',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
