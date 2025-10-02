<?php
require_once './vendor/autoload.php';
require_once 'controllers/categoriasController.php';


use MiladRahimi\PhpRouter\Router;
use Laminas\Diactoros\Response\JsonResponse;

$router = Router::create();

// lo que se muestra en la raíz
$router->get('/', function () {
    return new JsonResponse(['message' => 'ok']);
});

//Rutas para categorías
$router->get('/categorias', [CategoriasController::class, 'obtenerCategorias']);

//Rutas para Gastos

$router->dispatch();
