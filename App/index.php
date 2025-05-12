<?php

//SEPARA OS MODELS VIEWS ETC
require_once __DIR__ . '/autoload.php';
//PUXA O CORE QUE É O NÚCLEO DO SISTEMA MVC
require_once __DIR__.'/Core/Core.php';
//PUXA AS ROTAS QUE É PARA SABER AONDE VOCÊ SE ENCONTRA MEU AMIGO
require_once __DIR__ . '/Router/Routes.php';

$core = new Core();
$core->run($routes);