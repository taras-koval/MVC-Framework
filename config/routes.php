<?php

use App\Controllers\Auth\AccountController;
use App\Controllers\Auth\LoginController;
use App\Controllers\Auth\RegisterController;
use App\Controllers\MainController;

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
$routes['get']['/contact'] = [MainController::class, 'showContact'];
$routes['post']['/contact'] = [MainController::class, 'contact'];

$routes['get']['/login'] = [LoginController::class, 'showLogin'];
$routes['post']['/login'] = [LoginController::class, 'login'];
$routes['get']['/signup'] = [RegisterController::class, 'showRegister'];
$routes['post']['/signup'] = [RegisterController::class, 'register'];
$routes['get']['/logout'] = [AccountController::class, 'logout'];

$routes['get']['/account'] = [AccountController::class, 'account'];

return $routes;