<?php

class Core {
    public function run($routes) {
        //OBTEM O URL ATUAL
        $url = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';
        $url = ($url !== '/') ? rtrim($url, '/') : $url;

        $routerFound = false;

        //LOOP PELAS ROTAS
        foreach ($routes as $path => $controller) {
            //SUBSTITUI O {id} POR REGEX
            $pattern = '#^' . preg_replace('/{[^}]+}/', '(\w+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$controllerName, $action] = explode('@', $controller);

                //PASTA PARA PROCURAR OS CONTROLLER, MUDE AQUI CASO FOR NECESSARIO - BY MOISES
                $controllerFolders = [
                    __DIR__ . '/../Controllers/',
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

                //PAGINA DE ERRO
                if (!$controllerFile) {
                    require_once __DIR__ . '/../Controllers/NotFoundController.php';
                    return;
                }

                //CARREGA O CONTROLLER
                require_once $controllerFile;

                //INSTANCIA E EXECUTA O MÉTODO
                $controllerInstance = new $controllerName();
                call_user_func_array([$controllerInstance, $action], $matches);
                return;
            }
        }

        //SE NENHUMA ROTA BATER, VOLTA O NOT FOUND
        if (!$routerFound) {
            require_once __DIR__ . '/../Controllers/NotFoundController.php';
            $notFound = new NotFoundController();
            $notFound->index();
        }
    }
}