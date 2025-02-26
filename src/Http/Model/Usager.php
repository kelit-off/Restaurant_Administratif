<?php

namespace Http\Model;

use Core\Database;

class Usager extends Database {
    const TABLE = "usager";

    protected $fillable = [
        
    ];

    public function getListe() {
        $query = "SELECT * FROM usager";
        $ListeUsager = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        
        $query = "SELECT * FROM categorie";
        $ListeCategorie = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $ListeUsagerCategorie = [];
        foreach ($ListeUsager as $usager) {
            $ListeUsagerCategorie[] = [
                "usager" => $usager,
                "categorie" => $ListeCategorie[array_search($usager['id_categorie'], array_column($ListeCategorie, 'id_categorie'))],
            ];
        }
        return $ListeUsagerCategorie;
    }
}