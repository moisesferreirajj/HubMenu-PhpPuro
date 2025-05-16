<?php

class HomeController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('empresarial/index',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
