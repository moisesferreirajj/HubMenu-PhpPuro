<?php

$routes = [
    '/' => 'HomeController@index',
    '/cadastro' => 'CadastroController@index',
    '/login' => 'LoginController@index',
    '/sobre' => 'SobreController@index',
    '/login' => 'LoginController@index',
    '/user/{id}' => 'UserController@show',
]

?>
