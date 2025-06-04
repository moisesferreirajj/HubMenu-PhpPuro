<?php

$routes = [
    /* ROTAS CLIENTES */
    '/' => 'DashClienteController@index',
    '/restaurantes' => 'RestaurantesController@index',
    '/restaurante/{id}' => 'RestaurantesController@indexRestaurante',
    /* ROTAS EMPRESARIAIS */
    '/empresarial' => 'HomeController@index',
    '/empresarial/cadastro' => 'CadastroController@index',
    '/empresarial/login' => 'LoginController@index',
    '/empresarial/sobre' => 'SobreController@index',
    '/empresarial/suporte' => 'SuporteController@index',
    '/empresarial/funcionalidades'=> 'FuncionalidadesController@index',
    /* ROTAS GLOBAIS */
    '/user/{id}' => 'UserController@show',
    /* ROTAS DE ADMIN */
    '/api/autenticar/usuario' => 'LoginController@autenticar',
    '/api/cadastrar/usuario' => 'CadastroController@cadastrar',
    '/cadastro/produtos' => 'ProdutosController@index',
    /* ROTAS DE API ABAIXO: */
    '/api/visualizar/categorias' => 'ProdutosController@getCategorias',
    '/api/visualizar/estabelecimentos' => 'ProdutosController@getEstabelecimentos',
    /* ROTAS ESPECIALMENTE DA EMPRESA PARA O CLIENTE: */
    '/cardapio/{id}' => 'CardapioController@indexCliente',
    '/gerenciar/cardapio/{id}'=> 'CardapioController@indexAdmin',
    /* ROTAS ESPECIALMENTE DA EMPRESA PARA A EMPRESA: */
    '/api/produtos/cadastrar' => 'ProdutosController@cadastrar',
    '/api/produtos/editar' => 'ProdutosController@atualizar',
    '/api/visualizar/produtos/{id}' => 'ProdutosController@getProdutos',
]

?>