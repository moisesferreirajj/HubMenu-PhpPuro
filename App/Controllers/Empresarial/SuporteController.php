<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class SuporteController extends RenderView
{
    public function index()
    {
        $users = new UsuariosModel();

        $this->loadView('empresarial/suporte', [
            'Title' => 'HubMenu |'
        ]);
    }
}