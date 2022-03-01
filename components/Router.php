<?php

class Router
{
    private $routes;

    public function __construct()
    {
        $routesPath = ROOT . '/config/routes.php';
        $this->routes = include($routesPath);
    }

    private function getPath(): string
    {
        $action = empty($_GET['action']) ? '' : $_GET['action'];
        foreach ($this->routes as $uriPattern => $path) {
            if ($action == $uriPattern) {
                return $path;
            }
        }

        return $this->routes[''];
    }

    public function run(): void
    {
        $segments = explode('/', $this->getPath());
        $controllerName = ucfirst(array_shift($segments) . 'Controller');
        $actionName = 'action' . ucfirst(array_shift($segments));

        $controllerFile = ROOT . '/controllers/' . $controllerName . '.php';
        if (file_exists($controllerFile)) {
            include_once $controllerFile;
        }

        $controllerObject = new $controllerName;
        $controllerObject->$actionName();
    }
}