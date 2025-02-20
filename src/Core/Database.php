<?php

namespace Core;

use PDO;
use PDOException;

class Database {
    private $pdo;

    public function __construct() {
        $config = require_once 'config/main.conf.php';
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
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function get($query, array $params = []) {
        $stmt = $this->query($query, $params);
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
}
