<?php

use App\Controller\MainController;

$routes['get']['/'] = [MainController::class, 'index'];

$routes['get']['/contact'] = [MainController::class, 'contact'];
$routes['post']['/contact'] = [MainController::class, 'contact'];

$routes['get']['/post/{id}'] = [MainController::class, 'post'];
$routes['get']['/articles/{slug}/comments/{id}'] = [MainController::class, 'test'];

$routes['notFound'] = [MainController::class, 'notFound'];

return $routes;