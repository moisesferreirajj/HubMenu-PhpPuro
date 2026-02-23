<?php

class RestaurantesController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('Clientes/restaurantes',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
