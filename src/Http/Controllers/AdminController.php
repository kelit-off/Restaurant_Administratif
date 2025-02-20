<?php

namespace Http\Controllers;

use Core\App;
use Core\Session;
use Http\Model\Prestation;
use Http\Model\Users;

require_once 'src/Http/Controllers/Controller.php';

class AdminController extends Controller {
    public function __construct() {
        $sessionManager = new Session();
        if (is_null($sessionManager->get('user_id'))) {
            header('Location: /auth/login');
        }
        $userManager = new Users();
        $user = $userManager->find("SELECT * FROM users WHERE id = :id", [
            "id" => $sessionManager->get('user_id')
        ]);
        if($user['droit'] != 1) {
            header('Location: /');
        }
    }

    public function index() {
        $app = new App();
        return $app->view('admin/adminPage', [
            'title' => 'Admin',
            "headerType" => 'admin',
            "slimHeader" => false,
        ]);
    }

    public function viewUsers() {
        $app = new App();
        return $app->view('admin/user/ListeUsers', [
            'title' => 'Gestion des utilisateurs',
            "headerType" => 'admin',
            "slimHeader" => false,
            "users" => (new Users())->getListe(),
        ]);
    }

    public function viewUsager() {
        $app = new App();
        return $app->view('admin/usager/ListeUsager', [
            'title' => 'Gestion des usagers',
            "headerType" => 'admin',
            "slimHeader" => false,
        ]);
    }

    public function viewCategory() {
        $app = new App();
        return $app->view('admin/listeCategory', [
            'title' => 'Gestion des catégories',
            "headerType" => 'admin',
            "slimHeader" => false,
        ]);
    }

    public function viewPrestation() {
        $app = new App();
        return $app->view('admin/prestation/listePrestation', [
            'title' => 'Gestion des prestations',
            "headerType" => 'admin',
            "slimHeader" => false,
            "prestationsListe" => (new Prestation())->getAllPrestation(),
        ]);
    }
}