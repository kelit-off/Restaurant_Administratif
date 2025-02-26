<?php

namespace Core;

use Exception;
use PDO;
use PDOException;

class Database {
    private $pdo;

    public function __construct() {
        $config = require 'config/main.conf.php';
        try {
            // Tentative de connexion avec PDO
            $this->pdo = new PDO(
                "mysql:host={$config['database']['host']};dbname={$config['database']['dbname']}",
                $config['database']['username'], 
                $config['database']['password']
            );

            // Définir le mode d'erreur pour obtenir des exceptions
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        } catch (PDOException $e) {
            // Affichage du message d'erreur complet pour mieux comprendre le problème
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function query($query, array $params = []) {
        if ($this->pdo === null) {
            throw new \Exception('Connexion à la base de données échouée.');
        }
        $stmt = $this->pdo->prepare($query);
        $stmt->execute($params);

        if (strpos(strtoupper($query), 'INSERT') === 0) {
            return $this->pdo->lastInsertId(); // Retourne l'ID auto-incrémenté
        }
        return $stmt;
    }

    public function find($query, array $params = []) {
        $stmt = $this->query($query, $params);
        $result = $stmt->fetch(\PDO::FETCH_ASSOC);
        return $result !== false ? $result : null;
    }

    public function getListe() {
        $stmt = $this->query("SELECT * FROM " . static::TABLE ."");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function insert($array = []) {
        if (empty($array)) {
            return [
                'status' => 'error',
                'message' => "Il n'y a aucune donnée à insérer."
            ];
        }
    
        try {
            $query = "INSERT INTO ". static::TABLE ." SET " . $this->preparingRequete($array);
            $stmt = $this->pdo->prepare($query);
            
            foreach ($array as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            if ($stmt->execute()) {
                return [
                    'status' => 'success',
                    'message' => "Données insérées avec succès."
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => "Erreur lors de l'insertion."
                ];
            }
        } catch (Exception $e) {
            var_dump($e->getMessage());
            return [
                'status' => 'error',
                'message' => "Exception : " . $e->getMessage()
            ];
        }
    }

    public function update($id, $array = [], $primaryKey = null) {
        if (empty($array)) {
            return [
                'status' => 'error',
                'message' => "Aucune donnée à mettre à jour."
            ];
        }
    
        if (!defined('static::TABLE')) {
            return [
                'status' => 'error',
                'message' => "La constante TABLE n'est pas définie."
            ];
        }, $secondaryKey = null, $id2 = null
    
        // Détection automatique de la clé primaire
        if (!$primaryKey) {
            return [
                'status' => 'error',
                'message' => "Impossible de trouver la clé primaire."
            ];
        }
    
        try {
            // Exclure la clé primaire de la requête SET
            unset($array[$primaryKey]);
            // Construire la requête SQL
            $query = "UPDATE " . static::TABLE . " SET " . $this->preparingRequete($array) . " WHERE $primaryKey = :$primaryKey" . 
            (is_null($secondaryKey) ? "" : " AND $secondaryKey = :$secondaryKey");
            var_dump($query);
            $stmt = $this->pdo->prepare($query);
            
            // Lier les valeurs sauf la clé primaire
            foreach ($array as $key => $value) {
                $stmt->bindValue(":$key", $value);
            }
    
            // Lier la clé primaire séparément
            $stmt->bindValue(":$primaryKey", $id);
            
            if(!is_null($secondaryKey)) {
                $stmt->bindValue(":$secondaryKey", $id2);
            }
            if ($stmt->execute()) {
                return [
                    'status' => 'success',
                    'message' => "Données mises à jour avec succès."
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => "Erreur lors de la mise à jour."
                ];
            }
        } catch (PDOException $e) {
            var_dump($e->getMessage());
            return [
                'status' => 'error',
                'message' => "Exception SQL : " . $e->getMessage()
            ];
        }
    }    

    public function delete($id, $primaryKey = null, $secondaryKey = null, $id2 = null) {
        if (!defined('static::TABLE')) {
            return [
                'status' => 'error',
                'message' => "La constante TABLE n'est pas définie."
            ];
        }
    
        // Détection automatique de la clé primaire
        if (!$primaryKey) {
            return [
                'status' => 'error',
                'message' => "Impossible de trouver la clé primaire."
            ];
        }
    
        try {
            $query = "DELETE FROM " . static::TABLE . " WHERE $primaryKey = :$primaryKey" . 
            (is_null($secondaryKey) ? "" : " AND $secondaryKey = :$secondaryKey");
            $stmt = $this->pdo->prepare($query);
            $stmt->bindValue(":$primaryKey", $id);
    
            if ($stmt->execute()) {
                return [
                    'status' => 'success',
                    'message' => "Enregistrement supprimé avec succès."
                ];
            } else {
                return [
                    'status' => 'error',
                    'message' => "Erreur lors de la suppression."
                ];
            }
        } catch (PDOException $e) {
            return [
                'status' => 'error',
                'message' => "Exception SQL : " . $e->getMessage()
            ];
        }
    }

    private function preparingRequete($data) {
        return implode(', ', array_map(fn($field) => "$field = :$field", array_keys($data)));
    }

    private function detectPrimaryKey($data) {
        foreach (array_keys($data) as $key) {
            if (strpos($key, 'id_') === 0) {
                var_dump($key);
                return $key;
            }
        }
        return null; // Aucune clé trouvée
    }
    
}
