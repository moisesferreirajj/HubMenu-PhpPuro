<?php

final class LogoutController extends RenderView
{
    public function index(){
        $this->loadView('empresarial/logout', [
            'Title' => 'HubMenu |'
        ]);
    }
}