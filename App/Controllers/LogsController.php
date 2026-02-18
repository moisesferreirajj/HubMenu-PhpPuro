<?php

class LogsController extends RenderView
{
    public function index(){
        $this->loadView('Logs/index',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}