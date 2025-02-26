<?php

namespace Http\Model;

use Core\Database;

class Ticket extends Database {
    const TABLE = "ticket";

    protected $fillable = [
        
    ];

    public function getDernierId() {
        // Effectuer la requête pour récupérer tous les id_ticket
        $query = "SELECT id_ticket FROM ticket";
        $result = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        
        if ($result) {
            // Trier les id_ticket par la partie numérique de l'identifiant
            usort($result, function ($a, $b) {
                // Extraction des parties numériques de chaque id_ticket
                preg_match('/\d+/', $a['id_ticket'], $matchesA);
                preg_match('/\d+/', $b['id_ticket'], $matchesB);
                
                // Comparaison des parties numériques
                return (int)$matchesA[0] - (int)$matchesB[0];
            });
    
            // Récupérer le dernier identifiant après tri
            $lastId = $result[count($result) - 1]['id_ticket'];
    
            // Incrémenter la partie numérique de l'identifiant
            preg_match('/\d+/', $lastId, $matches);
            $newIdNumber = (int)$matches[0] + 1;  // Incrémentation de la partie numérique
    
            // Retourner le nouvel id avec le préfixe 'C'
            return 'T' . $newIdNumber;
        }
        
        // Si aucune entrée n'est trouvée, retourner 'C1' par défaut
        return 'T1';
    }
}