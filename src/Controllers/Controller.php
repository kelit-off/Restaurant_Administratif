<?php

class Controller {
    protected function view($viewName, $data = []) {
        extract($data); // Permet d'extraire les variables du tableau associatif
        $viewPath = __DIR__ . "/../View/$viewName.php";
        if (file_exists($viewPath)) {
            require $viewPath;
        } else {
            echo "Vue $viewName non trouvée.";
        }
    }
}