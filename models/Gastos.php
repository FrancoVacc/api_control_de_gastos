<?php
require_once __DIR__ . "/../settings/db.php";

class Gastos
{
    protected $con;

    public function __construct()
    {
        $this->con = Database::connect();
    }

    public function get($categoria = null)
    {
        try {
            if (!is_null($categoria)) {
                $query = 'SELECT * FROM gastos WHERE categoria = ? ORDER BY fecha DESC LIMIT 10';
                $stmt = $this->con->prepare($query);
                $stmt->bind_param('i', $categoria);
            } else {
                $query = 'SELECT * FROM gastos ORDER BY fecha DESC LIMIT 10';
                $stmt = $this->con->prepare($query);
            }

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
            return ['message' => $th->getMessage()];
        }
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

    public function update($data, $id)
    {
        $query = "UPDATE gastos SET monto = ?, categoria = ?, fecha = ?, descripcion = ? WHERE id_gastos = ?";
        try {
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('dissi', $data['monto'], $data['categoria'], $data['fecha'], $data['descripcion'], $id);
            $stmt->execute();

            if ($stmt->error) {
                throw new Exception('Error al actualizar');
            }
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }

        return ['message' => 'gasto actualizado correctamente'];
    }

    public function delete($id)
    {
        $query = "DELETE FROM gastos WHERE id_gastos = ?";
        try {
            $stmt = $this->con->prepare($query);
            $stmt->bind_param('i', $id);
            $stmt->execute();

            if ($stmt->error) {
                throw new Exception('error al eliminar');
            }

            return ['message' => 'gasto eliminado satisfactoriamente'];
        } catch (\Throwable $th) {
            return ['message' => $th->getMessage()];
        }
    }
}


//Modelo de Gastos

//Metodos a tener en cuenta
//Métodos GET
//Obtener los ultimos 10 gastos según un período de fechas
//Obtener los ultimos 10 gastos según la categoría
