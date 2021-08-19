<?php

namespace App\Core;

abstract class Controller
{
    protected View $view;
    
    public function __construct()
    {
        $this->view = new View();
    }
    
    protected function render(string $view, array $data = []) : Response
    {
        $viewsPath = $this->view->getViewsPath();
        $controllerViewsDir = $this->getControllerViewsDir();
        $renderedView = $this->view->make("$viewsPath/$controllerViewsDir/$view.php", $data);
        return new Response($renderedView);
    }
    
    protected function setLayout(string $layout)
    {
        $this->view->setLayout($layout);
    }
    
    private function getControllerViewsDir() : string
    {
        // Controller name without namespace
        $controller = substr(strrchr(get_class($this), '\\'), 1);
    
        // Directory with views of the current controller
        return str_replace('Controller', '', lcfirst($controller));
    }
    
}