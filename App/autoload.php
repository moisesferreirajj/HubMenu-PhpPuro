<?php

spl_autoload_register(function($class) {
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);
    $baseDir = __DIR__ . '/';

    $possiblePaths = [
        $baseDir . $classPath . '.php',
        $baseDir . 'Models' . DIRECTORY_SEPARATOR . $class . '.php',
        $baseDir . 'Utils' . DIRECTORY_SEPARATOR . $class . '.php',
        $baseDir . 'Core' . DIRECTORY_SEPARATOR . $class . '.php',
    ];

    //INCLUI O PRIMEIRO ARQUIVO DA CLASSE
    foreach ($possiblePaths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    //SE NAO ENCONTRAR MOSTRA O ERRO
    die("Autoload error: Classe '$class' não encontrada. Tentativas: " . implode(', ', $possiblePaths));
});
