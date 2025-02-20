<?php

namespace Http\Controllers;

use Core\App;

require_once 'src/Http/Controllers/Controller.php';

class AdminController extends Controller {
    public function index() {
        $app = new App();
        return $app->view('admin/adminPage', [
            'title' => 'Admin',
            "headerType" => 'admin',
            "slimHeader" => false,
        ]);
    }
}