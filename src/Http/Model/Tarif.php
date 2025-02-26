<?php

namespace Http\Model;

use Core\Database;

class Tarif extends Database {
    const TABLE = "tarif";

    protected $fillable = [
        
    ];

    public function getListe() {
        $query = "SELECT * FROM tarif";
        $ListeTarif = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $query = "SELECT * FROM categorie";
        $ListeCategorie = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $query = "SELECT * FROM prestation";
        $ListePrestation = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $ListeTarifCategoriePrestation = [];
        foreach($ListeTarif as $tarif) {
            $ListeTarifCategoriePrestation[] = [
                "tarif" => $tarif,
                "categorie" => $ListeCategorie[array_search($tarif['id_categorie'], array_column($ListeCategorie, 'id_categorie'))],
                "prestation" => $ListePrestation[array_search($tarif['id_prestation'], array_column($ListePrestation, 'id_prestation'))],
            ];
        }

        return $ListeTarifCategoriePrestation;
    }
}