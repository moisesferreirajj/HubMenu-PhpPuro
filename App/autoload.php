<?php

spl_autoload_register(function($class) {
    // Converte o namespace para caminho de diretório
    $classPath = str_replace('\\', DIRECTORY_SEPARATOR, $class);

    // Caminho absoluto base
    $baseDir = __DIR__ . '/';

    // Caminhos possíveis para diferentes pastas
    $possiblePaths = [
        $baseDir . $classPath . '.php',  // Caminho direto com o namespace
        $baseDir . 'Models' . DIRECTORY_SEPARATOR . $class . '.php',  // Models
        $baseDir . 'Utils' . DIRECTORY_SEPARATOR . $class . '.php',  // Utils
        $baseDir . 'Core' . DIRECTORY_SEPARATOR . $class . '.php',    // Core
    ];

    // Tenta incluir o primeiro arquivo existente
    foreach ($possiblePaths as $file) {
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }

    // Se não encontrar, exibe erro (útil pra debug)
    die("Autoload error: Classe '$class' não encontrada. Tentativas: " . implode(', ', $possiblePaths));
});
