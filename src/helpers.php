<?php

use App\Core\App;
use App\Core\Database;
use App\Core\Response;
use App\Core\Session;
use App\Core\View;

function db(): Database
{
    return App::$database;
}

function session(): Session
{
    return App::$session;
}

function view(string $path, array $data = []) : Response
{
    $view = new View();
    $views = $view->getViewsPath();
    $renderedView = $view->make("$views/$path", $data);
    return new Response($renderedView);
}

function redirect($url)
{
    (new Response())->redirect($url);
}

