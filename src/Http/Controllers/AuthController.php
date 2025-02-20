<?php

namespace Http\Controllers;

require_once 'src/Http/Controllers/Controller.php';

use Core\App;
use Core\Session;
use Http\Model\Users;

class AuthController extends Controller {
    public function viewLogin() {
        $app = new App();
        return $app->view('auth/login', [
            'title' => 'Connexion',
            "headerType" => null,
            "slimHeader" => true,
        ]);
    }

    public function postLogin() {
        $userManager = new Users();
        $sessionManager = new Session();
        $user = $userManager->find("SELECT * FROM users WHERE email = :email", [
            "email" => $_POST['email']
        ]);
        if(!is_null($user) && password_verify($_POST['password'], $user['password'])) {
            $sessionManager->set("user_id", $user['id']);
            header('Location: /');
        }
    }

    public function viewRegister() {
        $app = new App();
        return $app->view('auth/register', [
            'title' => 'Inscription',
            "headerType" => null,
            "slimHeader" => true,
        ]);
    }

    public function postRegister() {
        $userManager = new Users();
        $sessionManager = new Session();
        $id_user = $userManager->create($_POST);
        if(!is_null($id_user)) {
            $sessionManager->set("user_id", $id_user);
            header('Location: /');
        }
    }
}