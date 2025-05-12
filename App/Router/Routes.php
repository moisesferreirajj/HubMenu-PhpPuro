<?php

$routes = [
    '/' => 'HomeController@index',
    '/cadastro' => 'CadastroController@index',
    '/login' => 'LoginController@index',
    '/sobre' => 'SobreController@index',
    '/user/{id}' => 'UserController@show',
    '/cadastro/produtos' => 'ProdutosController@index',
    /* ROTAS DE API ABAIXO: */
    '/api/produtos/cadastrar' => 'ProdutosController@cadastrar',
]

?>
