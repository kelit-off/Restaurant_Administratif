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
}