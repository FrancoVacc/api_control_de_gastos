<?php

use Laminas\Diactoros\Response\JsonResponse;
use Laminas\Diactoros\ServerRequest;

require_once __DIR__ . '/../models/Gastos.php';

class gastosController
{

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

        if (!preg_match('^\d+(\.\d{1,2})?$^', $monto)) {
            return new JsonResponse(['message' => 'Error en el monto']);
        }
        if (!preg_match('^\d{4}([\-/.])(0?[1-9]|1[0-2])\1(3[01]|[12][0-9]|0?[1-9])$^', $fecha)) {
            return new JsonResponse(['message' => 'Error en la fecha']);
        }
        if (!preg_match('^\d+$^', $categoria)) {
            return new JsonResponse(['message' => 'Error en la categoria']);
        }
        if (!preg_match('^[A-Za-zÁÉÍÓÚáéíóú0-9 ]+$^', $descripcion)) {
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
}
//Pedir los ultimos 10 gastos al modelo
//Controlar los filtros por Fecha y por Categorías

//Validar cuando se carga un nuevo gasto
//Validar al editar un gasto
//Contolar el id a la hora de eliminar un gasto
