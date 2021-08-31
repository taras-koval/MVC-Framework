<?php

use App\Controller\AuthController;
use App\Controller\MainController;

/**
 * Example route:
 * $routes['get']['/foo/{bar}'] = [FooController::class, 'action'];
 *
 * Unstatic part of route during parsing:
 * {example}            ([a-zA-Z][a-zA-Z0-9-_]*)
 * {example<[a-z]+>}    ([a-z]+)
 * {example<\w+>}       ([a-zA-Z0-9_]+)
 * {example<\d+>}       ([0-9]+)
 */

$routes['get']['/'] = [MainController::class, 'index'];
$routes['get']['/contact'] = [MainController::class, 'contact'];
$routes['post']['/contact'] = [MainController::class, 'contact'];

$routes['get']['/login'] = [AuthController::class, 'login'];
$routes['post']['/login'] = [AuthController::class, 'login'];
$routes['get']['/register'] = [AuthController::class, 'register'];
$routes['post']['/register'] = [AuthController::class, 'register'];
$routes['get']['/logout'] = [AuthController::class, 'logout'];
$routes['get']['/profile'] = [AuthController::class, 'profile'];

return $routes;