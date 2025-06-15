<?php

$routes = [
    /* ROTAS CLIENTES */
    '/' => 'DashClienteController@index',
    '/restaurantes' => 'RestaurantesController@index',
    '/restaurante/{id}' => 'RestaurantesController@indexRestaurante',
    '/pedidos/{id}' => 'PedidosController@indexEmpresa',
    /* ROTAS EMPRESARIAIS */
    '/empresarial' => 'HomeController@index',
    '/empresarial/cadastro' => 'CadastroController@index',
    '/empresarial/login' => 'LoginController@index',
    '/empresarial/esqueceuSenha' => 'EsqueceuSenha@index',
    '/empresarial/sobre' => 'SobreController@index',
    '/empresarial/suporte' => 'SuporteController@index',
    '/empresarial/funcionalidades' => 'FuncionalidadesController@index',
    /* ROTAS GLOBAIS */
    '/user/{id}' => 'UserController@show',
    /* ROTAS DE ADMIN */
    '/api/autenticar/usuario' => 'LoginController@autenticar',
    '/api/cadastrar/usuario' => 'CadastroController@cadastrar',
    /* ROTAS ENVIO EMAIL - ESQUECEU A SENHA */
    '/api/autenticar/senha' => 'EsqueceuSenha@autenticar',
    '/api/autenticar/sendtype' => 'EsqueceuSenha@sendType',
    '/api/autenticar/code' => 'EsqueceuSenha@code',
    '/api/autenticar/changepassword' => 'EsqueceuSenha@changePassword',
    /* ROTA CADASTRO DE PRODUTOS */
    '/cadastro/produtos' => 'ProdutosController@index',
    /* ROTA DE LOG - ERROS */
    '/admin/logs' => 'LogsController@index',
    /* ROTAS DE API ABAIXO: */
    '/api/visualizar/categorias' => 'ProdutosController@getCategorias',
    '/api/visualizar/estabelecimentos' => 'ProdutosController@getEstabelecimentos',
    '/api/send/SMS' => 'SendSMSController@sendSMS',
    /* ROTAS ESPECIALMENTE DA EMPRESA PARA O CLIENTE: */
    '/cardapio/{id}' => 'CardapioController@indexCliente',
    '/gerenciar/cardapio/{id}' => 'CardapioController@indexAdmin',
    /* ROTAS ESPECIALMENTE DA EMPRESA PARA A EMPRESA: */
    '/api/produtos/cadastrar' => 'ProdutosController@cadastrar',
    '/api/produtos/editar' => 'ProdutosController@atualizar',
    '/api/produtos/procurar/{id}' => 'ProdutosController@searchProdutos',
    '/api/visualizar/produtos/{id}' => 'ProdutosController@getProdutos',
    /* ROTA ADMINISTRAÇÃO */
    '/api/autenticar/admin' => 'LoginController@autenticarAdmin',
    '/admin/login' => 'AdminController@index',
];
