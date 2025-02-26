<?php

namespace Http\Model;

use Core\Database;

class Prestation extends Database {
    const TABLE = "prestation";

    protected $fillable = [
        "name",
        "categorie",
        "price",
    ];

    public function getListe() {
        $query = "SELECT * FROM ". $this::TABLE;
        $ListePrestation = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $query = "SELECT * FROM categorie";
        $ListeCategory = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $query = "SELECT * FROM tarif";
        $ListeTarif = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $ListePrestationTarif = [];
        foreach ($ListeTarif as $tarif) {
            $ListePrestationTarif[] = [
                "prestation" => $ListePrestation[array_search($tarif['id_prestation'], array_column($ListePrestation, 'id'))],
                "categorie" => $ListeCategory[array_search($tarif['id_categorie'], array_column($ListeCategory, 'id_categorie'))],
                "prix" => $tarif['prix'],
            ];
        }
        return $ListePrestationTarif;
    }
}