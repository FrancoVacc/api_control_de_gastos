<?php

use Laminas\Diactoros\Response\JsonResponse;

require_once __DIR__ . '/../models/Categorias.php';


class CategoriasController
{

    public function obtenerCategorias()
    {
        $categorias = new Categorias;
        return new JsonResponse($categorias->get());
    }
}
