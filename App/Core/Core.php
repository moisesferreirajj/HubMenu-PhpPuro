<?php

class Core {
    public function run($routes) {
        $url = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routerFound = false;

        foreach ($routes as $path => $controller) {
            $pattern = '#^' . preg_replace('/{id}/', '(\w+)', $path) . '$#';

            if (preg_match($pattern, $url, $matches)) {
                array_shift($matches);

                $routerFound = true;

                [$currentController, $action] = explode('@', $controller);
                require_once __DIR__ . "/../Controllers/$currentController.php";

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
