<?php
session_start();

function autoload($className) {
    $className = str_replace('\\', '/', $className);
    $file = __DIR__ . '/src/' . $className . '.php';
    if (file_exists($file)) {
        include_once $file;
    } else {
        die("Fichier introuvable : " . $file);
    }
}
spl_autoload_register('autoload');

require_once 'src/Router/web.php';