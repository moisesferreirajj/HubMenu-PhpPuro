<?php

class LoginController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('empresarial/login',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
