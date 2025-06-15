<?php

class LogsController extends RenderView
{
    public function index(){
        $this->loadView('logs/index',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}