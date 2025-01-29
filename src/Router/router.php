<?php
namespace Router;

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
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    
        if (isset($this->routes[$method][$uri])) {
            $action = explode('@', $this->routes[$method][$uri]);
            $controller = $action[0]; 
            $method = $action[1];
    
            // Inclure manuellement le contrôleur si l'autoloading n'est pas configuré
            $controllerPath = __DIR__ . '/../Controllers/' . $action[0] . '.php';
            
            if (file_exists($controllerPath)) {
                require_once $controllerPath;  // Inclure le fichier du contrôleur
                if (class_exists($controller)) {
                    $instance = new $controller();
                    if (method_exists($instance, $method)) {
                        $instance->$method();
                    } else {
                        echo "Méthode $method non trouvée dans $controller";
                    }
                } else {
                    echo "Contrôleur $controller non trouvé";
                }
            } else {
                echo "Fichier du contrôleur $controllerPath non trouvé";
            }
        } else {
            echo "Route non trouvée";
        }
    }    
}