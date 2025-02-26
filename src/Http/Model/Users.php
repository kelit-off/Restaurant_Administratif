<?php

namespace Http\Model;

use Core\Database;

class Users extends Database {
    const TABLE = "users";

    protected $fillable = [
        "prenom",
        "nom",
        "email",
        "password",
    ];

    public function create(array $data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO users (prenom, nom, email, password, droits) VALUES (:prenom, :nom, :email, :password, 2)";

        return $this->query($query, $data);
    }

    public function find($query, array $params = []) {
        $stmt = $this->query($query, $params);

        
        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getListe() {
        $query = "SELECT * FROM users";
        $ListeUsers = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $query = "SELECT * FROM droits";
        $ListeDroit = $this->query($query)->fetchAll(\PDO::FETCH_ASSOC);

        $ListeUsersDroit = [];

        foreach ($ListeUsers as $user) {
            $ListeUsersDroit[] = [
                "user" => $user,
                "droits" => $ListeDroit[array_search($user['droits'], array_column($ListeDroit, 'id_droits'))],
            ];
        }
        return $ListeUsersDroit;
    }
}