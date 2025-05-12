<?php

class SobreController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('sobre',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}