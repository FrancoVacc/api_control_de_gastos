<?php
require_once __DIR__ . "/../settings/db.php";

class Gastos
{
    protected $con;

    public function __construct()
    {
        $this->con = Database::connect();
    }

    public function create($data)
    {

        $query = "INSERT INTO gastos (monto, categoria, fecha, descripcion) VALUES(?,?,?,?)";
        try {
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('diss', $data['monto'], $data['categoria'], $data['fecha'], $data['descripcion']);
            $stmt->execute();

            if ($stmt->error) {
                throw new Exception('Error al conectar');
            }

            return ['message' => 'gasto guardado'];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }
}


//Modelo de Gastos

//Metodos a tener en cuenta
//Métodos GET
//Obtener los ultimos 10 Gastos
//Obtener los ultimos 10 gastos según un período de fechas
//Obtener los ultimos 10 gastos según la categoría

//Método Post
//Agregar un nuevo gasto

//Método PUT
//Modificar un gasto

//Método Delete
//Eliminar un gasto