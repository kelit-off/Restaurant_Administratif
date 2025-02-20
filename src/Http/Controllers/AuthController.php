<?php
require_once 'src/Controllers/Controller.php';

class AuthController extends Controller {
    public function viewLogin() {
        return parent::view('auth/login', [
            'title' => 'Connexion',
            "headerType" => null,
            "slimHeader" => true,
        ]);
    }

    public function postLogin() {

    }

    public function viewRegister() {

    }

    public function postRegister() {

    }
}