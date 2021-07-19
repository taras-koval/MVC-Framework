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
        $dir = $this->getViewsDir();
        $renderedView = $this->view->make(ROOT . "/views/$dir/$view.php", $data);
        return new Response($renderedView);
    }
    
    protected function setLayout(string $layout)
    {
        if (file_exists(ROOT . "/views/layouts/$layout.php")) {
            $this->view->layout = $layout;
        }
    }
    
    private function getViewsDir() : string
    {
        // Controller name without namespace
        // $controller = str_replace('App\\Controller\\', '', get_class($this));
        $controller = substr(strrchr(get_class($this), '\\'), 1);
    
        // Directory with views of the current controller
        return str_replace('Controller', '', lcfirst($controller));
    }
}