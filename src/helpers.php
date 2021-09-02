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

function view(string $path, array $data = [], ?string $title = null, ?string $layout = null) : Response
{
    $view = new View();
    $viewsPath = $view->getViewsPath();
    
    if (isset($title)) {
        $view->setTitle($title);
    }
    
    if (isset($layout)) {
        $view->setLayout($layout);
    }
    
    $renderedView = $view->make("$viewsPath/$path", $data);
    return new Response($renderedView);
}

function redirect($url)
{
    (new Response())->redirect($url);
}

