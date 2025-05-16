<?php

$routes = [
    /* ROTAS CLIENTES */
    '/clientes' => 'DashClienteController@index',
    /* ROTAS EMPRESARIAIS */
    '/empresarial' => 'HomeController@index',
    '/empresarial/cadastro' => 'CadastroController@index',
    '/empresarial/login' => 'LoginController@index',
    '/empresarial/sobre' => 'SobreController@index',
    /* ROTAS GLOBAIS */
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