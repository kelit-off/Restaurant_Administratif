<?php

namespace Http\Controllers;

require_once 'src/Http/Controllers/Controller.php';
require_once __DIR__ . "/../../Core/App.php";

use Core\App;

class LandingPageController extends Controller
{   

    public function index()
    {     
        $app = new App();
        return $app->view('landingPage', [
            'title' => 'Accueil',
            "headerType" => null,
            "slimHeader" => false,
        ]);
    }
}