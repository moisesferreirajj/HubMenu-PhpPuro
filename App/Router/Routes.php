<?php

$routes = [
    '/' => 'HomeController@index',
    '/login' => 'LoginController@index',
    '/user/{id}' => 'UserController@show',
]

?>
