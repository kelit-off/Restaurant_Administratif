<?php

namespace Core;

class Router {
    private $routes = [];

    public function get($uri, $controller) {
        $this->routes['GET'][$uri] = $controller;
    }

    public function post($uri, $controller) {
        $this->routes['POST'][$uri] = $controller;
    }

    public function run() {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        foreach ($this->routes[$method] as $route => $controller) {
            $routePattern = preg_replace('/\{[a-zA-Z0-9_]+\}/', '([a-zA-Z0-9-_]+)', trim($route, '/'));
            if (preg_match("#^$routePattern$#", $uri, $matches)) {
                array_shift($matches); // Enlever le premier élément (URI complète)

                $action = explode('@', $controller);
                $controllerClass = "Http\\Controllers\\" . $action[0];
                $method = $action[1];

                $controllerPath = __DIR__ . '/../Http/Controllers/' . $action[0] . '.php';

                if (file_exists($controllerPath)) {
                    require_once $controllerPath;
                    if (class_exists($controllerClass)) {
                        $instance = new $controllerClass();
                        if (method_exists($instance, $method)) {
                            $instance->$method(...$matches);
                            return;
                        } else {
                            echo "Méthode $method non trouvée dans $controllerClass";
                            return;
                        }
                    } else {
                        echo "Contrôleur $controllerClass non trouvé";
                        return;
                    }
                } else {
                    echo "Fichier du contrôleur $controllerPath non trouvé";
                    return;
                }
            }
        }

        echo "Route non trouvée";
    }
}