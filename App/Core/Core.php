<?php

class Core {
    public function run($routes) {
        $url = isset($_SERVER['REQUEST_URI']) ? parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) : '/';
        ($url != '/') ? $url = rtrim($url, '/') : $url;

        $routerFound = false;

        foreach ($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controller);
                $controllerFile = __DIR__ . "/../Controllers/$currentController.php";
                if (!file_exists($controllerFile)) {
                    $controllerFile = __DIR__ . "/../Controllers/Cadastros/$currentController.php";
                }
                if (!file_exists($controllerFile)) {
                    $controllerFile = __DIR__ . "/../Controllers/Empresarial/$currentController.php";
                }
                if (!file_exists($controllerFile)) {
                    $controllerFile = __DIR__ . "/../Controllers/Clientes/$currentController.php";
                }
                
                require_once $controllerFile;

                $newController = new $currentController();
                call_user_func_array([$newController, $action], $matches);
                return;
            }
        }

        if (!$routerFound) {
            require_once __DIR__ . "/../Controllers/NotFoundController.php";
            $controller = new NotFoundController();
            $controller->index();
        }
    }
}
