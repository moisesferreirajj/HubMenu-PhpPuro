<?php

$routes = [
    '/' => 'HomeController@index',
    '/cadastro' => 'CadastroController@index',
    '/login' => 'LoginController@index',
    '/sobre' => 'SobreController@index',
    '/user/{id}' => 'UserController@show',
    '/cardapio/{id}' => 'CardapioController@indexCliente',
    /* ROTAS DE ADMIN */
    '/gerenciar/cardapio/{id}'=> 'CardapioController@indexAdmin',
    '/cadastro/produtos' => 'ProdutosController@index',
    /* ROTAS DE API ABAIXO: */
    '/api/produtos/cadastrar' => 'ProdutosController@cadastrar',
    '/api/visualizar/categorias' => 'ProdutosController@getCategorias',
    '/api/visualizar/estabelecimentos' => 'ProdutosController@getEstabelecimentos',
]

?>
