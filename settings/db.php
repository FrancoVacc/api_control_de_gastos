<?php

class Database
{
    protected $host;
    protected $user;
    protected $pass;
    protected $db_name;

    public function __construct()
    {
        $this->host = "localhost";
        $this->user = "root";
        $this->pass = "";
        $this->db_name = "control_gastos";
    }

    public static function connect()
    {
        $con = new mysqli(self::$host, self::$user, self::$pass, self::$db_name) or die('Error en la conexión');
        return $con;
    }
}
