<?php

$routes = [
    '/' => 'HomeController@index',
    '/cadastro' => 'CadastroController@index',
    '/login' => 'LoginController@index',
    '/sobre' => 'SobreController@index',
    '/user/{id}' => 'UserController@show',
]

?>
