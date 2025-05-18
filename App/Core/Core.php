<?php

class Core {
    public function run($routes) {
        // Obter a URL atual
        $url = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';
        $url = ($url !== '/') ? rtrim($url, '/') : $url;

        $routerFound = false;

        // Loop pelas rotas definidas
        foreach ($routes as $path => $controller) {
            // Substituir parâmetros {id} por regex (\w+)
            $pattern = '#^' . preg_replace('/{[^}]+}/', '(\w+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches); // Remove a URL completa do match

                $routerFound = true;

                [$controllerName, $action] = explode('@', $controller);

                // Pastas onde procurar os controllers
                $controllerFolders = [
                    __DIR__ . '/../Controllers/Cadastros/',
                    __DIR__ . '/../Controllers/Empresarial/',
                    __DIR__ . '/../Controllers/Clientes/',
                ];

                $controllerFile = null;

                foreach ($controllerFolders as $folder) {
                    $file = $folder . $controllerName . '.php';
                    if (file_exists($file)) {
                        $controllerFile = $file;
                        break;
                    }
                }

                // Se não encontrou o arquivo do controller
                if (!$controllerFile) {
                    require_once __DIR__ . '/../Controllers/NotFoundController.php';
                    return;
                }

                // Carrega o controller
                require_once $controllerFile;

                // Instancia e executa o método
                $controllerInstance = new $controllerName();
                call_user_func_array([$controllerInstance, $action], $matches);
                return;
            }
        }

        // Se nenhuma rota bateu
        if (!$routerFound) {
            require_once __DIR__ . '/../Controllers/NotFoundController.php';
        }
    }
}
