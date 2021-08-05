<?php

use App\Controller\AuthController;
use App\Controller\MainController;

$routes['get']['/'] = [MainController::class, 'index'];
$routes['get']['/contact'] = [MainController::class, 'contact'];
$routes['post']['/contact'] = [MainController::class, 'contact'];
$routes['get']['/articles/{slug}/comments/{id<\d+>}'] = [MainController::class, 'test'];

$routes['get']['/login'] = [AuthController::class, 'login'];
$routes['post']['/login'] = [AuthController::class, 'loginHandler'];

$routes['get']['/register'] = [AuthController::class, 'register'];
$routes['post']['/register'] = [AuthController::class, 'registerHandler'];

$routes['notFound'] = [MainController::class, 'notFound'];

return $routes;