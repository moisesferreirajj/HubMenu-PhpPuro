<?php

class SobreController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('empresarial/sobre',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}