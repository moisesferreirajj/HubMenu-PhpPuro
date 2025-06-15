<?php

// Ativa exibição de erros (opcional para desenvolvimento)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Define manipulador de erros
set_error_handler(function ($errno, $errstr, $errfile, $errline) {
    logErro("Erro [$errno] $errstr - Arquivo: $errfile - Linha: $errline");
});

// Define manipulador de exceções
set_exception_handler(function ($exception) {
    logErro("Exceção não capturada: " . $exception->getMessage() . " - Arquivo: " . $exception->getFile() . " - Linha: " . $exception->getLine());
});

// Função que grava no log
function logErro($mensagem)
{
    $arquivoLog = __DIR__ . '/Views/Logs/erros.log';
    $data = date('Y-m-d H:i:s');
    $entrada = "[$data] $mensagem\n";
    file_put_contents($arquivoLog, $entrada, FILE_APPEND);
}

//SEPARA OS MODELS VIEWS ETC
require_once __DIR__ . '/autoload.php';
//PUXA O CORE QUE É O NÚCLEO DO SISTEMA MVC
require_once __DIR__.'/Core/Core.php';
//PUXA AS ROTAS QUE É PARA SABER AONDE VOCÊ SE ENCONTRA MEU AMIGO
require_once __DIR__ . '/Router/Routes.php';

$core = new Core();
$core->run($routes);