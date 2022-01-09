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
    
    if (isset($title)) {
        $view->setTitle($title);
    }
    
    if (isset($layout)) {
        $view->setLayout($layout);
    }
    
    return new Response($view->render($path, $data));
}

function redirect($url, $code = 302)
{
    (new Response())->redirect($url, $code);
}

function back()
{
    (new Response())->back();
}

function error($key)
{
    return App::$session->getFormErrorFlash($key)[0] ?? '';
}

function old($key, $default = '')
{
    if (session()->getRequestDataFlash($key)) {
        return session()->getRequestDataFlash($key);
    }
    
    return $default;
}

function camelCaseToSnakeCase($str): string
{
    return strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($str)));
}

function camelCaseToSnakeCaseArrayKeys(&$arr)
{
    $temp = [];
    foreach ($arr as $key => $value) {
        $temp[camelCaseToSnakeCase($key)] = $value;
    }
    $arr = $temp;
}

function snakeCaseToCamelCase($str): string
{
    $camelCased = preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
        return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
    }, $str);
    
    return lcfirst($camelCased);
}

function snakeCaseToCamelCaseArrayKeys(&$arr)
{
    $temp = [];
    foreach ($arr as $key => $value) {
        $temp[snakeCaseToCamelCase($key)] = $value;
    }
    $arr = $temp;
}

function setObjectFromArray(&$obj, $arr)
{
    foreach ($arr as $field => $value) {
        if (property_exists($obj, $field)) {
            $obj->{$field} = $value;
        }
    }
    
    return $obj;
}