<?php

namespace Http\Model;

use Core\Database;

class Users extends Database {
    protected $fillable = [
        "first_name",
        "last_name",
        "email",
        "password",
    ];

    public function create(array $data) {
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);
        $query = "INSERT INTO users (first_name, last_name, email, password, droit) VALUES (:first_name, :last_name, :email, :password, 0)";

        return $this->query($query, $data);
    }

    public function find($query, array $params = []) {
        $stmt = $this->query($query, $params);

        
        return $stmt->fetch(\PDO::FETCH_ASSOC);

    }
}