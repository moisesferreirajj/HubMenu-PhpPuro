<?php

class CadastroController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('cadastro',
            [
                'Title' => 'HubMenu |',
                'users' => $users->findAll()
            ],
        );
    }
}
