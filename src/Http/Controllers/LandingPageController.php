<?php

namespace Http\Controllers;

require_once 'src/Http/Controllers/Controller.php';

use Core\App;
use Core\Session;

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