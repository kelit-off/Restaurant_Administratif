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
            "type" => 'users',
            "HeadersTable" => [
                "Prénom",
                "Nom",
                "Email",
                "Droits",
            ],
            "ContentsTable" => $userListeFormatted,
        ]);
    }

    public function viewUpdateUser($id) {
        $app = new App();
        $userManager = new Users();
        return $app->view('admin/createPage', [
            'title' => 'Modifier un utilisateur',
            "headerType" => 'admin',
            "slimHeader" => false,
            "type" => 'user',
            "id" => $id,
            "formFields" => [
                "Nom" => "text",
                "Prénom" => "text",
                "Email" => "email",
                "Droits" => "select",
            ],
        ]);
    }

    public function postUpdateUser() {
        $userManager = new Users();
        $id = $_POST['id'];
        $_POST = array_slice($_POST, 1);
        if($userManager->update($id, $_POST, "id")["status"] == "success") {
            header("Location: /admin/users");
            exit;
        }
    }

    public function deleteUser($id) {
        $userManager = new Users();
        if($userManager->delete($id, "id")["status"] == "success") {
            header("Location: /admin/users");
            exit;
        }
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

    public function viewCreateUsager() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer un droit',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'usager',
            "formFields" => [
                "Nom" => "text",
                "Id categorie" => "number",
                "Montant caution" => "number",
            ]
        ]);
    }

    public function postCreateUsager() {
        $usagerManager = new Usager();
        $_POST['date_carte'] = date("Y-m-d");
        $_POST['id_carte'] = $usagerManager->getDernierId();
        if($usagerManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/usager");
            exit;
        }
    }

    public function viewUpdateUsager($id) {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier un utilisateur',
            "headerType" => 'admin',
            "slimHeader" => false,
            "type" => 'usager',
            "id" => $id,    
            "formFields" => [
                "Nom" => "text",
                "Id categorie" => "number",
                "Montant caution" => "number",
            ]
        ]);
    }

    public function postUpdateUsager() {
        $usagerManager = new Usager();
        $id = $_POST['id'];
        $_POST = array_slice($_POST, 1);
        if($usagerManager->update($id,$_POST, "id_carte")["status"] == "success") {
            header("Location: /admin/usager");
            exit;
        }
    }

    public function deleteUsager($id) {
        $usagerManager = new Usager();
        if($usagerManager->delete($id, "id_carte")["status"] == "success") {
            header("Location: /admin/usager");
            exit;
        }
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

    public function viewCreateCategory() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer une catégorie',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'category',
            "formFields" => [
                "Libelle categorie" => "text",
            ]
        ]);
    }

    public function postCreateCategory() {
        $categorieManager = new Categorie();
        if($categorieManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/category");
            exit;
        }
    }

    public function viewUpdateCategory($id) {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier une catégorie',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'category',
            "id" => $id,
            "formFields" => [
                "Libelle categorie" => "text",
            ]
        ]);
    }

    public function postUpdateCategory() {
        $categorieManager = new Categorie();
        $id = $_POST['id'];
        $_POST = array_slice($_POST, 1);
        if($categorieManager->update($id, $_POST, "id_categorie")["status"] == "success") {
            header("Location: /admin/category");
            exit;
        }
    }

    public function deleteCategory($id) {
        $categorieManager = new Categorie();
        if($categorieManager->delete($id, "id_categorie")["status"] == "success") {
            header("Location: /admin/category");
            exit;
        }
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

    public function viewCreatePrestation() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer une prestation',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'prestation',
            "formFields" => [
                "Type prestation" => "text",
            ]
        ]);
    }

    public function postCreatePrestation() {
        $prestationManager = new Prestation();
        if($prestationManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/prestation");
            exit;
        }
    }

    public function viewUpdatePrestation($id) {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier une prestation',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'prestation',
            "id" => $id,
            "formFields" => [
                "Type prestation" => "text",
            ]
        ]);
    }

    public function postUpdatePrestation() {
        $prestationManager = new Prestation();
        $id = $_POST['id'];
        $_POST = array_slice($_POST, 1);
        if($prestationManager->update($id, $_POST, "id_prestation")["status"] == "success") {
            header("Location: /admin/prestation");
            exit;
        }
    }

    public function deletePrestation($id) {
        $prestationManager = new Prestation();
        if($prestationManager->delete($id, "id_prestation")["status"] == "success") {
            header("Location: /admin/prestation");
            exit;
        }
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
    
    public function viewCreateTarif() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer un tarif',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'tarif',
            "formFields" => [
                "Id prestation" => "number",
                "Id categorie" => "number",
                "Prix" => "number",
            ]
        ]);
    }

    public function postCreateTarif() {
        $tarifManager = new Tarif();
        if($tarifManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/tarif");
            exit;
        }
    }

    public function viewUpdateTarif($id) {
        list($id_prestation, $id_categorie) = explode('-', $id);
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier un tarif',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'tarif',
            "id" => $id_prestation . "-" . $id_categorie,
            "formFields" => [
                "Prix" => "number",
            ]
        ]);
    }

    public function postUpdateTarif() {
        $tarifManager = new Tarif();
        $id = $_POST['id'];
        list($id_prestation, $id_categorie) = explode('-', $id);
        $_POST = array_slice($_POST, 1);
        if($tarifManager->update($id_categorie, $_POST, "id_categorie", "id_prestation", $id_prestation)["status"] == "success") {
            header("Location: /admin/tarif");
            exit;
        }
    }

    public function deleteTarif($id_prestation, $id_categorie) {
        $tarifManager = new Tarif();
        if($tarifManager->delete($id_prestation, $id_categorie)["status"] == "success") {
            header("Location: /admin/tarif");
            exit;
        }
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

    public function viewCreateTicket() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer un ticket',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'ticket',
            "formFields" => [
                "Id carte" => "text",
                "Date achat" => "date",
            ]
        ]);
    }

    public function postCreateTicket() {
        $ticketManager = new Ticket();
        $_POST['id_ticket'] = $ticketManager->getDernierId();
        if($ticketManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/ticket");
            exit;
        }
    }

    public function viewUpdateTicket($id) {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier un ticket',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'ticket',
            "id" => $id,
            "formFields" => [
                "Id carte" => "text",
                "Date achat" => "date",
            ]
        ]);
    }

    public function postUpdateTicket() {
        $ticketManager = new Ticket();
        $id = $_POST['id'];
        $_POST = array_slice($_POST, 1);
        if($ticketManager->update($id, $_POST, "id_ticket")["status"] == "success") {
            header("Location: /admin/ticket");
            exit;
        }
    }

    public function deleteTicket($id) {
        $ticketManager = new Ticket();
        if($ticketManager->delete($id, "id_ticket")["status"] == "success") {
            header("Location: /admin/ticket");
            exit;
        }
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

    public function viewCreateDepot() {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Créer un depot',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'depot',
            "formFields" => [
                "Id carte" => "text",
                "Date depot" => "date",
                "Montant" => "number",
            ]
        ]);
    }

    public function postCreateDepot() {
        $depotManager = new Depot();
        if($depotManager->insert($_POST)["status"] == "success") {
            header("Location: /admin/depot");
            exit;
        }
    }

    public function viewUpdateDepot($id) {
        $app = new App();
        return $app->view('admin/createPage', [
            'title' => 'Modifier un depot',
            "headerType" => 'admin',
            "slimHeader" => false,
            'type' => 'depot',
            "id" => $id,
            "formFields" => [
                "Id carte" => "text",
                "Date depot" => "date",
                "Montant" => "number",
            ]
        ]);
    }

    public function postUpdateDepot() {
        $depotManager = new Depot();
        $id = $_POST['id'];
        unset($_POST['id']);
        unset($_POST['id_carte']);
        var_dump($id);
        if($depotManager->update($id, $_POST, "id_carte", "date_depot", $_POST['date_depot'])["status"] == "success") {
            header("Location: /admin/depot");
            exit;
        }
    }

    public function deleteDepot($id) {
        $depotManager = new Depot();
        if($depotManager->delete($id, "id_carte")["status"] == "success") {
            header("Location: /admin/depot");
            exit;
        }
    }
}