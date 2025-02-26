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

    public function getDernierId() {
        // Effectuer la requête pour récupérer tous les id_carte
        $query = "SELECT id_carte FROM usager";
        $result = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        
        if ($result) {
            // Trier les id_carte par la partie numérique de l'identifiant
            usort($result, function ($a, $b) {
                // Extraction des parties numériques de chaque id_carte
                preg_match('/\d+/', $a['id_carte'], $matchesA);
                preg_match('/\d+/', $b['id_carte'], $matchesB);
                
                // Comparaison des parties numériques
                return (int)$matchesA[0] - (int)$matchesB[0];
            });
    
            // Récupérer le dernier identifiant après tri
            $lastId = $result[count($result) - 1]['id_carte'];
    
            // Incrémenter la partie numérique de l'identifiant
            preg_match('/\d+/', $lastId, $matches);
            $newIdNumber = (int)$matches[0] + 1;  // Incrémentation de la partie numérique
    
            // Retourner le nouvel id avec le préfixe 'C'
            return 'C' . $newIdNumber;
        }
        
        // Si aucune entrée n'est trouvée, retourner 'C1' par défaut
        return 'C1';
    }
    
}