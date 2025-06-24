<?php

$routes = [
    /* ROTAS CLIENTES */
    '/' => 'DashClienteController@index',
    '/restaurantes' => 'RestaurantesController@index',
    '/restaurante/{id}' => 'RestaurantesController@indexRestaurante',
    '/pedidos/{id}' => 'PedidosController@indexEmpresa',
    
    /* ROTAS EMPRESARIAIS */
    '/empresarial' => 'HomeController@index',
    '/empresarial/dashboard/{id}' => 'DashboardController@index',
    '/empresarial/cadastro' => 'CadastroController@index',
    '/empresarial/login' => 'LoginController@index',
    '/empresarial/esqueceuSenha' => 'EsqueceuSenha@index',
    '/empresarial/sobre' => 'SobreController@index',
    '/empresarial/suporte' => 'SuporteController@index',
    '/empresarial/funcionalidades' => 'FuncionalidadesController@index',
    '/empresarial/logout' => 'LogoutController@index',

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

    /* ROTAS DE API ABAIXO: */
    '/api/visualizar/categorias' => 'ProdutosController@getCategorias',
    '/api/visualizar/estabelecimentos' => 'ProdutosController@getEstabelecimentos',
    '/api/visualizar/produtos' => 'ProdutosController@getProdutos',
    '/api/send/SMS' => 'SendSMSController@sendSMS',

    /* ROTAS ESPECIALMENTE DA EMPRESA PARA O CLIENTE: */
    '/api/estabelecimento/editar' => 'GerenciarController@editarEstabelecimento',
    '/cardapio/{id}' => 'CardapioController@indexCliente',
    '/gerenciar/cardapio/{id}' => 'CardapioController@indexAdmin',
    '/gerenciar/estabelecimento/{id}' => 'GerenciarController@index',
    '/gerenciar/lixeira/{id}' => 'CardapioController@lixeira',

    /* ROTAS ESPECIALMENTE DA EMPRESA PARA A EMPRESA: */
    '/api/produtos/cadastrar' => 'ProdutosController@cadastrar',
    '/api/produtos/desativar' => 'ProdutosController@desativar',
    '/api/produtos/editar' => 'ProdutosController@atualizar',
    '/api/produtos/excluir' => 'ProdutosController@excluir',
    '/api/produtos/procurar/{id}' => 'ProdutosController@searchProdutos',
    '/api/visualizar/produtos/{id}' => 'ProdutosController@getProdutos',
    '/api/produtos/ativar' => 'ProdutosController@ativar',

    /* ROTA ADMINISTRAÇÃO */
    '/api/autenticar/admin' => 'LoginController@autenticarAdmin',
    '/admin' => 'AdminController@index',
    '/admin/dashboard' => 'AdminController@dashboard',
    '/admin/logs' => 'LogsController@index',

    /* ROTAS DE PEDIDOS */
    '/api/pedidos/register' => 'PedidosController@registerOrder',
    '/api/pedidos/atualizar-status' => 'PedidosController@atualizarStatus',

    /* ROTAS DE CATEGORIAS */
    '/api/categorias/excluir' => 'CategoriasController@excluir',

];
