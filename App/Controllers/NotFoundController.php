<?php

class NotFoundController extends RenderView
{
    public function index(){
        $this->loadView('error',
            [
                'Title' => 'HubMenu |'
            ],
        );
    }
}