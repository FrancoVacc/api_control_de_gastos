<?php
require_once './vendor/autoload.php';
require_once 'controllers/categoriasController.php';
require_once 'controllers/gastosController.php';


use MiladRahimi\PhpRouter\Router;
use Laminas\Diactoros\Response\JsonResponse;

$router = Router::create();

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");


if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// lo que se muestra en la raíz
$router->get('/', function () {
    return new JsonResponse(['message' => 'ok']);
});

//Rutas para categorías
$router->get('/categorias', [CategoriasController::class, 'obtenerCategorias']);

//Rutas para Gastos
$router->get('/gastos', [gastosController::class, 'obtenerGasto']);
$router->get('/gastos/{categoria}', [gastosController::class, 'obtenerGasto']);
$router->get('/gastos/fechas/{fechas}', [gastosController::class, 'obtenerGasto']);
$router->post('/gastos', [gastosController::class, 'crearGasto']);
$router->put('/gastos/{id}', [gastosController::class, 'modificarGasto']);
$router->delete('/gastos/{id}', [gastosController::class, 'eliminarGasto']);

$router->dispatch();
