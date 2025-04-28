<?php

<<<<<<< HEAD
class LoginController extends RenderView
{
    public function index(){
        $users = new UsuariosModel();

        $this->loadView('login',
            [
                'Title' => 'HubMenu |',
                'users' => $users->fetch()
            ],
        );
    }
}
=======
class LoginController
{
    public function index(){
        echo "Login Controller";
    }
}
>>>>>>> 7ee9314e10cef458a90e37326d60b970e9ec962c
