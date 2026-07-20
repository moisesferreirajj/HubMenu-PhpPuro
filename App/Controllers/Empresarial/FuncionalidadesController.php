<?php

class FuncionalidadesController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('Empresarial/funcionalidades',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
