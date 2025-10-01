<?php
require_once './vendor/autoload.php';

use MiladRahimi\PhpRouter\Router;
use Laminas\Diactoros\Response\JsonResponse;

$router = Router::create();

$router->get('/', function () {
    return new JsonResponse(['message' => 'ok']);
});


$router->dispatch();
