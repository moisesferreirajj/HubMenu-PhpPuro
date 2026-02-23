<?php

final class LogoutController extends RenderView
{
    public function index(){
        $this->loadView('Empresarial/logout', [
            'Title' => 'HubMenu |'
        ]);
    }
}