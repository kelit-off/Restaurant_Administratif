<?php

namespace Http\Controllers;

use Core\App;
use Core\Session;
use Http\Model\Categorie;
use Http\Model\Depot;
use Http\Model\Droits;
use Http\Model\Prestation;
use Http\Model\Tarif;
use Http\Model\Ticket;
use Http\Model\Usager;
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
        if($user['droits'] != 1) {
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
        $userManager = new Users();
        $userListe = $userManager->getListe();
        $userListeFormatted = [];
        foreach ($userListe as $key => $user) {
            $userListeFormatted[] = [
                "id" => $user['user']['id'],
                "Prénom" => $user['user']['prenom'],
                "Nom" => $user['user']['nom'],
                "Email" => $user['user']['email'],
                "Droits" => $user['droits']['libelle_droits'],
            ];
        }
        return $app->view('admin/listePage', [
            'title' => 'Gestion des utilisateurs',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => false,
            "type" => 'user',
            "HeadersTable" => [
                "Prénom",
                "Nom",
                "Email",
                "Droits",
            ],
            "ContentsTable" => $userListeFormatted,
        ]);
    }

    public function viewEditUsers($id) {
        $app = new App();
        $userManager = new Users();
        $user = $userManager->find("SELECT * FROM users WHERE id = :id", [
            "id" => $id
        ]);
        return $app->view('admin/editUser', [
            'title' => 'Modifier un utilisateur',
            "headerType" => 'admin',
            "slimHeader" => false,
            "user" => $user,
        ]);
    }

    public function postUsers($id) {

    }

    public function viewUsager() {
        $app = new App();
        $usagerManager = new Usager();
        $usagerListe = $usagerManager->getListe();
        $usagerListeFormatted = [];
        foreach($usagerListe as $key => $usager) {
            $usagerListeFormatted[] = [
                "id" => $usager['usager']['id_carte'],
                "Carte" => $usager['usager']['id_carte'],
                "Nom" => $usager['usager']['nom'],
                "Categorie" => $usager['categorie']['libelle_categorie'],
                "Montant de la caution" => $usager['usager']['montant_caution'],
            ];
        }
        return $app->view('admin/listePage', [
            'title' => 'Gestion des usagers',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'usager',
            "HeadersTable" => [
                "Carte",
                "Nom",
                "Categorie",
                "Montant de la caution",
            ],
            "ContentsTable" => $usagerListeFormatted,
        ]);
    }

    public function viewCategory() {
        $app = new App();
        $CategorieListe = new Categorie();
        $CategorieListeFormatted = [];
        foreach($CategorieListe->getListe() as $key => $categorie) {
            $CategorieListeFormatted[] = [
                "id" => $categorie['id_categorie'],
                "libelle_categorie" => $categorie['libelle_categorie'],
            ];
        }
        return $app->view('admin/listePage', [
            'title' => 'Gestion des catégories',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'category',
            "HeadersTable" => [
                "Libellé",
            ],
            "ContentsTable" => $CategorieListeFormatted 
        ]);
    }

    public function viewPrestation() {
        $app = new App();
        $presationManager = new Prestation();
        $prestationListe = $presationManager->getListe();
        $prestationListeFormatted = [];
        foreach($prestationListe as $key => $prestation) {
            $prestationListeFormatted[] = [
                "id" => $prestation['id_prestation'],
                "libelle_prestation" => $prestation['type_prestation'],
            ];
        }
        return $app->view('admin/listePage', [
            'title' => 'Gestion des prestations',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'prestation',
            "HeadersTable" => [
                "Libéllé",
            ],
            "ContentsTable" => $prestationListeFormatted
        ]);
    }

    public function viewTarif() {
        $app = new App();
        $tarifManager = new Tarif();
        $tarifListe = $tarifManager->getListe();
        $tarifListeFormatted = [];
        foreach($tarifListe as $key => $tarif) {
            $tarifListeFormatted[] = [
                "id_prestation" => $tarif['prestation']['id_prestation'],
                "id_categorie" => $tarif['categorie']['id_categorie'],
                "prix" => $tarif['tarif']['prix'],
            ];
        }
        return $app->view('admin/listePage', [
            'title' => 'Gestion des tarifs',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'tarif',
            "HeadersTable" => [
                "Prestation",
                "Categorie",
                "Prix",
            ],
            "ContentsTable" => $tarifListeFormatted
        ]);
    }

    public function viewTicket() {
        $app = new App();
        $ticketManager = new Ticket();
        $ticketListeFormatted = [];
        foreach($ticketManager->getListe() as $ticket) {
            $ticketListeFormatted[] = [
                "id" => $ticket['id_ticket'],
                "id_carte" => $ticket['id_carte'],
                "date" => $ticket['date_achat'],
            ];
        }

        return $app->view('admin/listePage', [
            'title' => 'Gestion des tickets',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'ticket',
            "HeadersTable" => [
                "Carte",
                "Date"
            ],
            "ContentsTable" => $ticketListeFormatted
        ]);
    }

    public function viewDroits() {
        $app = new App();
        $droitsManager = new Droits();
        $droitsListe = $droitsManager->getListe();
        $droitsListeFormatted = [];
        foreach($droitsListe as $key => $droit) {
            $droitsListeFormatted[] = [
                "id" => $droit['id_droits'],
                "libelle_droits" => $droit['libelle_droits'],
            ];
        }

        return $app->view('admin/listePage', [
            'title' => 'Gestion des droits',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'droits',
            "HeadersTable" => [
                "Libellé",
            ],
            "ContentsTable" => $droitsListeFormatted
        ]);
    }

    public function viewCreateDroits() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer un droit',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'droits',
            "formFields" => [
                "Libelle droits" => "text",
            ]
        ]);
    }

    public function postCreateDroits() {
        $app = new App();
        $droitsManager = new Droits();

        if($droitsManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/droits");
            exit;
        }
    }

    public function viewUpdateDroits($id) {
        var_dump($id);
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier un droit',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'droits',
            "formFields" => [
                "Libelle droits" => "text",
            ],
            "id" => $id
        ]);
    }

    public function postUpdateDroits() {
        $droitsManager = new Droits();
        $id = $_POST['id'];
        $_POST = array_slice($_POST, 1);
        
        if($droitsManager->update($id,$_POST, "id_droits")["status"] == "success") {
            header("Location: /admin/droits");
            exit;
        }
    }

    public function deleteDroits($id) {
        $droitsManager = new Droits();
        if($droitsManager->delete($id, "id_droits")["status"] == "success") {
            header("Location: /admin/droits");
            exit;
        }
    }

    public function viewDepot() {
        $app = new App();
        $depotManager = new Depot();
        $depotListe = $depotManager->getListe();
        $depotListeFormatted = [];
        foreach($depotListe as $key => $depot) {
            $depotListeFormatted[] = [
                "id" => $depot['id_carte'],
                "id_carte" => $depot['id_carte'],
                "date" => $depot['date_depot'],
                "montant" => $depot['montant'],
            ];
        }
        return $app->view('admin/listePage', [
            'title' => 'Gestion des dépots',
            "headerType" => 'admin',
            "slimHeader" => false,
            "can_add" => true,
            "type" => 'depot',
            "HeadersTable" => [
                "Carte",
                "Date",
                "Montant",
            ],
            "ContentsTable" => $depotListeFormatted
        ]);
    }
}