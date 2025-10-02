<?php

use Laminas\Diactoros\Response\JsonResponse;

require_once __DIR__ . '/../settings/db.php';

class Categorias
{
    protected $con;

    public function __construct()
    {
        $this->con = Database::connect();
    }

    public function get()
    {
        $query = 'SELECT * FROM categorias';

        try {
            $stmt = $this->con->prepare($query);
            $stmt->execute();

            if ($stmt->error) {
                throw new Exception('Error en la base de datos');
            }

            $res = $stmt->get_result();
            $data_arr = [];

            if ($res->num_rows > 0) {
                while ($data = $res->fetch_assoc()) {
                    array_push($data_arr, $data);
                }
                return $data_arr;
            }
            return $data_arr;
        } catch (\Throwable $th) {
            return new JsonResponse(['message' => $th->getMessage()]);
        }
    }
}

//Método GET
//Traer las categorías
