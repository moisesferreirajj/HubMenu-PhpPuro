<?php

//PUXA O CORE QUE É O NÚCLEO DO SISTEMA MVC
require_once __DIR__.'/Core/Core.php';
//PUXA AS ROTAS QUE É PARA SABER AONDE VOCÊ SE ENCONTRA MEU AMIGO
require_once __DIR__ . '/Router/Routes.php';

spl_autoload_register(function($file){
    if (file_exists(__DIR__ . "/Utils/$file.php")){
        require_once __DIR__ . "/Utils/$file.php";
    }
    else if (file_exists(__DIR__ . "/Models/$file.php")){
        require_once __DIR__ . "/Models/$file.php";
    }
});

$core = new Core();
$core->run($routes);