<?php

class Controller {
    protected function view($viewName, $data = []) {
        extract($data); // Permet d'extraire les variables du tableau associatif
        $viewPath = __DIR__ . "/../Views/$viewName.view.php";
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "Vue $viewName non trouvée.";
        }
    }
}