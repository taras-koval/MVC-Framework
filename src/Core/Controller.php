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
    
        if (isset($this->title)) {
            $this->view->setTitle($this->title);
        }
        
        if (isset($this->layout)) {
            $this->view->setLayout($this->layout);
        }
        
        return new Response($this->view->render($view, $data));
    }
    
    protected function setLayout(string $layout)
    {
        $this->view->setLayout($layout);
    }
    
    protected function setTitle(string $title)
    {
        $this->view->setTitle($title);
    }
    
    // If using namespace is App\Controllers\AuthController returns 'auth'
    /*private function getControllerViewsDir() : string
    {
        // Controller name without namespace
        $controller = substr(strrchr(get_class($this), '\\'), 1);
    
        // Directory with views of the current controller
        return str_replace('Controller', '', lcfirst($controller));
    }*/
    
    // '/auth/login.php' returns 'F:/domains/localhost/views/contents/auth/login.php'
    // 'login' returns 'F:/domains/localhost/views/contents/auth/login.php'
    /*private function getFullPath($view): string
    {
        $view = ltrim($view, '\\/');
        $viewsPath = $this->view->getViewsRoot();
    
        if (preg_match('~[\W]+~', $view)) {
            return "$viewsPath/$view";
        }
        
        $controllerViewsDir = $this->getControllerViewsDir();
        return "$viewsPath/$controllerViewsDir/$view.php";
    }*/
    
    /**
     * @param  string|null  $middleware (example - Authenticate::class)
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