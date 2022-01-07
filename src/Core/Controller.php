<?php

namespace App\Core;

abstract class Controller
{
    private View $view;
    private string $layout;
    private string $title;
    
    /** @var Middleware[] $middlewares */
    private array $middlewares = [];
    
    protected function view(string $view, array $data = []): Response
    {
        $this->view = new View();
        
        if (isset($this->layout)) {
            $this->view->setLayout($this->layout);
        }
    
        if (isset($this->title)) {
            $this->view->setTitle($this->title);
        }
        
        $path = $this->getFullPath($view);
        return new Response($this->view->make($path, $data));
    }
    
    // If using namespace is App\Controllers\AuthController returns 'auth'
    private function getControllerViewsDir() : string
    {
        // Controller name without namespace
        $controller = substr(strrchr(get_class($this), '\\'), 1);
    
        // Directory with views of the current controller
        return str_replace('Controller', '', lcfirst($controller));
    }
    
    // 'auth/login.php' returns 'F:/domains/localhost/views/contents/auth/login.php'
    // 'login' returns 'F:/domains/localhost/views/contents/auth/login.php'
    private function getFullPath($view): string
    {
        $view = ltrim($view, '\\/');
        $viewsPath = $this->view->getViewsPath();
    
        if (preg_match('~[\W]+~', $view)) {
            return "$viewsPath/$view";
        }
        
        $controllerViewsDir = $this->getControllerViewsDir();
        return "$viewsPath/$controllerViewsDir/$view.php";
    }
    
    protected function setLayout(string $layout)
    {
        $this->view->setLayout($layout);
    }
    
    protected function setTitle(string $title)
    {
        $this->view->setTitle($title);
    }
    
    /**
     * @param  string|null  $middleware
     * You need set middleware class path (ex. Authenticate::class)
     */
    public function middleware(string $middleware = null, array $params = null)
    {
        if (isset($middleware)) {
            $this->middlewares[] = new $middleware($params);
        }
    }
    
    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}