<?php

session_start();

class AdminController extends RenderView
{
    public function index(){
        // Se já está logado como admin válido, redireciona
        if (!empty($_SESSION['usuario_id']) && in_array((int)($_SESSION['cargo_id'] ?? 0), [1, 2, 3])) {
            header('Location: /admin/dashboard');
            exit();
        }

        $users = new UsuariosModel();

        $this->loadView('administracao/login',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}
