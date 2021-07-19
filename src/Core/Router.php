<?php

namespace App\Core;

class Router
{
    public Request $request;
    public Response $response;
    
    private array $routes;
    
    /**
     * Router constructor.
     * @param  Request  $request
     * @param  Response  $response
     */
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
        
        $this->routes = include ROOT . '/config/routes.php';
    }
    
    public function run() : Response
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
    
        $route = $this->routes[$method][$path] ?? $this->routes['notFound'];
        [$controller, $action] = $route;
    
        $controllerInstance = new $controller();
        
        return call_user_func([$controllerInstance, $action], $this->request , $this->response);
    }
}