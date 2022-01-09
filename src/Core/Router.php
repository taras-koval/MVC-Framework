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
    
    /**
     * @return Response
     */
    public function run() : Response
    {
        $method = $this->request->getMethod();
        $path = $this->request->getPath();
        $params = [];
    
        $route = $this->routes[$method][$path] ?? false;
    
        if (!$route) {
            $route = $this->findUnstaticRoute($this->routes[$method], $path, $params);
        }
        
        if (!$route) {
            return view('main/errors/404.php')->setStatusCode(404);
        }
        
        [$controller, $action] = $route;
        $controllerInstance = new $controller();
        
        foreach ($controllerInstance->getMiddlewares() as $middleware) {
            $middleware->handle();
        }
        
        return call_user_func([$controllerInstance, $action], $this->request , ...$params);
    }
    
    /**
     * @param $routes
     * @param $urlPath
     * @param $params
     * @return false|string
     */
    private function findUnstaticRoute($routes, $urlPath, &$params)
    {
        foreach ($routes as $route => $handler) {
            if (preg_match($this->routeCompile($route), $urlPath, $params)) {
                array_shift($params);
                return $handler;
            }
        }
        
        return false;
    }
    
    /**
     * @param $route
     * @return string
     */
    private function routeCompile($route): string
    {
        $defaultPattern = '([a-zA-Z0-9_]+)';
        
        return preg_replace_callback(
            '~{(.+?)}~',
            function ($match) use ($defaultPattern) {
                return preg_match('~<(.+?)>~', $match[1], $regex) ? "($regex[1])" : $defaultPattern;
            },
            "~^$route$~"
        );
    }
    
    private function findUnstaticRouteSimple($routes, $path, &$params)
    {
        foreach ($routes as $route => $handler) {
            $routePattern = preg_replace('~{(.+?)}~', '([a-zA-Z0-9_]+)', "~^$route$~");
            
            if (preg_match($routePattern, $path, $params)) {
                array_shift($params);
                return $handler;
            }
        }
        
        return false;
    }
    
}
