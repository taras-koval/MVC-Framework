<?php

use App\Controller\MainController;

$routes['get']['/'] = [MainController::class, 'index'];

$routes['get']['/contact'] = [MainController::class, 'contact'];
$routes['post']['/contact'] = [MainController::class, 'contact'];

$routes['notFound'] = [MainController::class, 'notFound'];

return $routes;