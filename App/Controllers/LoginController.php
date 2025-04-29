<?php

class LoginController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('login',
            [
                'Title' => 'HubMenu |',
                'users' => $users->fetch()
            ],
        );
    }
}
