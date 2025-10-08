<?php
require_once './vendor/autoload.php';
require_once 'controllers/categoriasController.php';
require_once 'controllers/gastosController.php';


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
$router->get('/gastos', [gastosController::class, 'obtenerGasto']);
$router->get('/gastos/{categoria}', [gastosController::class, 'obtenerGasto']);
$router->post('/gastos', [gastosController::class, 'crearGasto']);
$router->put('/gastos/{id}', [gastosController::class, 'modificarGasto']);
$router->delete('/gastos/{id}', [gastosController::class, 'eliminarGasto']);

$router->dispatch();
