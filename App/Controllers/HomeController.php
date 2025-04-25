<?php

class HomeController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('index',
            [
            'Title' => 'HubMenu |',
            'users' => $users->fetch()
            ],
        );
    }
}