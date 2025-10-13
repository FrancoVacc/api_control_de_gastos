<?php
require_once 'dotenv.php';

class Database
{
    protected static $host;
    protected static $user;
    protected static $pass;
    protected static $db_name;
    protected static $port;


    public static function connect()
    {
        self::$host = $_ENV['DB_HOST'];
        self::$user = $_ENV['DB_USER'];
        self::$pass = $_ENV['DB_PASS'];
        self::$db_name = $_ENV['DB_NAME'];
        self::$port = isset($_ENV['DB_PORT']) ? $_ENV['DB_PORT'] : 3306;

        $con = new mysqli(self::$host, self::$user, self::$pass, self::$db_name, self::$port) or die('Error en la conexión');
        return $con;
    }
}

//Solucionado
// El problema era que no estaba utilizando atributos estáticos.
// cuando usamos atributos estáticos no se pueden inicializar con el constructor
// por eso el constructor no debería estar y se inicializan directamente dentro del metodo connect