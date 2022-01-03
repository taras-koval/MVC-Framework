<?php

namespace App\Core;

abstract class Controller
{
    protected View $view;
    
    /** @var Middleware[] $middlewares */
    protected array $middlewares = [];
    
    public function __construct()
    {
        $this->view = new View();
    }
    
    // Render view with layout
    protected function render(string $view, array $data = []): Response
    {
        $path = $this->getFullPath($view);
        return new Response($this->view->make($path, $data));
    }
    
    // Render view without layout
    protected function renderOnlyView(string $view, array $data = []): Response
    {
        $path = $this->getFullPath($view);
        return new Response($this->view->getViewContent($path, $data));
    }
    
    protected function setLayout(string $layout)
    {
        $this->view->setLayout($layout);
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
    
    public function setTitle(string $title)
    {
        $this->view->setTitle($title);
    }
    
    
    /**
     * @param  Middleware  $middleware
     */
    public function registerMiddleware(Middleware $middleware)
    {
        $this->middlewares[] = $middleware;
    }
    
    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}