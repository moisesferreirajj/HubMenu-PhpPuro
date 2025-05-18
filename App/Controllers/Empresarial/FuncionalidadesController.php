<?php

class FuncionalidadesController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('empresarial/funcionalidades',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
