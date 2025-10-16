<?php

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;

require_once __DIR__ . '/../models/Gastos.php';

class gastosController
{

    public function obtenerGasto($categoria = null)
    {
        $gasto = new Gastos;

        if (!is_null($categoria)) {
            return new JsonResponse($gasto->get($categoria));
        }
        return new JsonResponse($gasto->get());
    }

    public function ObtenerGastoFecha($fecha = null)
    {
        [$fechaInicio, $fechaFin] = explode('_', $fecha);

        function comprobarFecha($fecha)
        {
            if (preg_match('/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/', $fecha)) {
                list($y, $m, $d) = explode('-', $fecha);
                if (!checkdate($m, $d, $y)) {
                    return ['message' => 'Error en la fecha'];
                }
                return $fecha;
            }
            return ['message' => 'Error en el formato de las fechas'];
        }

        $gasto = new Gastos;
        return new JsonResponse($gasto->get(null, comprobarFecha($fechaInicio), comprobarFecha($fechaFin)));
    }
    public function crearGasto(ServerRequest $request)
    {
        $data = $request->getParsedBody();

        if (empty($data)) {
            $json = $request->getBody()->getContents();
            $data = json_decode($json) ?? [];
        }

        $monto = $data->monto;
        $categoria = $data->categoria;
        $fecha = $data->fecha;
        $descripcion = $data->descripcion;

        if (!preg_match('/^[+-]?\d+(\.\d+)?$/', $monto)) {
            return new JsonResponse(['message' => 'Error en el monto']);
        }
        if (preg_match('/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/', $fecha)) {
            list($y, $m, $d) = explode('-', $fecha);
            $fecha_actual = time();
            $fecha_usuario = strtotime($fecha);
            if (!checkdate($m, $d, $y) || $fecha_usuario > $fecha_actual) {
                return new JsonResponse(['message' => 'Error en la fecha']);
            }
        }
        if (!preg_match('/^[1-9]\d*$/', $categoria)) {
            return new JsonResponse(['message' => 'Error en la categoria']);
        }
        if (!preg_match('/^.+$/s', $descripcion)) {
            return new JsonResponse(['message' => 'Error en la categoria']);
        }

        $data_arr =
            [
                'monto' => $monto,
                'categoria' => $categoria,
                'fecha' => $fecha,
                'descripcion' => $descripcion
            ];
        $gasto = new Gastos;
        return new JsonResponse($gasto->create($data_arr));
    }

    public function modificarGasto(ServerRequest $request, $id)
    {
        $id_al = (int) $id;
        if (!is_int(intval($id_al)) || intval($id_al) < 1) {
            return new JsonResponse(['message' => 'error en la consulta']);
        }
        $data = $request->getParsedBody();

        if (empty($data)) {
            $json = $request->getBody()->getContents();
            $data = json_decode($json) ?? [];
        }

        $monto = $data->monto;
        $categoria = $data->categoria;
        $fecha = $data->fecha;
        $descripcion = $data->descripcion;

        if (!preg_match('/^[+-]?\d+(\.\d+)?$/', $monto)) {
            return new JsonResponse(['message' => 'Error en el monto']);
        }
        if (preg_match('/^\d{4}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01])$/', $fecha)) {
            list($y, $m, $d) = explode('-', $fecha);
            $fecha_actual = time();
            $fecha_usuario = strtotime($fecha);
            if (!checkdate($m, $d, $y) || $fecha_usuario > $fecha_actual) {
                return new JsonResponse(['message' => 'Error en la fecha']);
            }
        }
        if (!preg_match('/^[1-9]\d*$/', $categoria)) {
            return new JsonResponse(['message' => 'Error en la categoria']);
        }
        if (!preg_match('/^.+$/s', $descripcion)) {
            return new JsonResponse(['message' => 'Error en la categoria']);
        }

        $data_arr =
            [
                'monto' => $monto,
                'categoria' => $categoria,
                'fecha' => $fecha,
                'descripcion' => $descripcion
            ];
        $gasto = new Gastos;
        return new JsonResponse($gasto->update($data_arr, $id_al));
    }

    public function eliminarGasto($id)
    {
        $id_al = (int) $id;
        if (!is_int(intval($id_al)) || intval($id_al) < 1) {
            return new JsonResponse(['message' => 'error en la consulta']);
        }

        $gasto = new Gastos;
        return new JsonResponse($gasto->delete($id_al));
    }
}
//Pedir los ultimos 10 gastos al modelo
//Controlar los filtros por Fecha y por Categorías

//Validar cuando se carga un nuevo gasto
//Validar al editar un gasto
//Contolar el id a la hora de eliminar un gasto
