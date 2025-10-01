<?php
require_once __DIR__ . '/../settings/db.php';

class Categorias
{
    protected $con;

    public function __construct()
    {
        $this->con = Database::connect();
    }
}

//Método GET
//Traer las categorías