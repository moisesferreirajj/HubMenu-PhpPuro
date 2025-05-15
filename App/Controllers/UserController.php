<?php

class UserController
{
    public function index(){
        echo "User Controller";
    }

    public function show($id){
        echo "User " .$id[0];
    }

}
