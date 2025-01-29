<?php

require_once 'src/Controllers/Controller.php';

class LandingPageController extends Controller
{
    public function index()
    {   
        return parent::view('landingPage', [
            'title' => 'Accueil',
            "headerType" => null,
            "slimHeader" => false,
        ]);
    }
}