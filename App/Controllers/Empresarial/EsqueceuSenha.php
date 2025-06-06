<?php

class EsqueceuSenha extends RenderView
{
    public function index()
    {
        $this->loadView(
            'empresarial/forget_password',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }

    public function autenticar()
    {
        
    }
}