<?php

namespace App\Core;

class Router
{
    public Request $request;
    
    private array $routes;
    
    /**
     * Router constructor.
     * @param  Request  $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        
        $this->routes = include ROOT . '/config/routes.php';
    }
    
    public function run() : Response
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $params = [];
    
        $route = $this->routes[$method][$path] ?? false;
    
        if (!$route) {
            $route = $this->findUnstatic($this->routes[$method], $path, $params);
        }
        
        if (!$route) {
            $route = $this->routes['notFound'];
        }
        
        [$controller, $action] = $route;
        $controllerInstance = new $controller();
        
        return call_user_func([$controllerInstance, $action], $this->request , ...$params);
    }
    
    private function compileRoutes(&$routes)
    {
        $processedRoutes = [];
        $pattern = '~{[a-z][A-Za-z0-9]+}~';
        $replacement = '([A-Za-z0-9_-]+)';
        
        foreach ($routes as $key => $val) {
            $processedRoutes['~^' . preg_replace($pattern, $replacement, $key) . '$~'] = $val;
        }
        
        $routes = $processedRoutes;
    }
    
    private function findUnstatic($routes, $path, &$params)
    {
        $this->compileRoutes($routes);
    
        foreach ($routes as $pattern => $callback) {
            if (preg_match($pattern, $path, $params)) {
                array_shift($params);
                return $callback;
            }
        }
        
        return false;
    }
    
}
