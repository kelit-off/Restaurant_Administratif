<?php

namespace Http\Controllers;

require_once 'src/Http/Controllers/Controller.php';

use Core\App;
use Core\Session;
use Http\Model\Prestation;

class LandingPageController extends Controller
{   

    public function index()
    {   
        $prestationManager = new Prestation();
        $app = new App();
        return $app->view('landingPage', [
            'title' => 'Accueil',
            "headerType" => null,
            "slimHeader" => false,
            "prestationsListe" => $prestationManager->getAllPrestation(),
        ]);
    }
}