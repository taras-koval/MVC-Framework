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
    
    protected function renderByPath(string $path, array $data = []) : Response
    {
        return new Response($this->view->make(ROOT . "/views/$path", $data));
    }
    
    protected function setLayout(string $layout)
    {
        $this->view->setLayout($layout);
    }
    
    private function getViewsDir() : string
    {
        // Controller name without namespace
        $controller = substr(strrchr(get_class($this), '\\'), 1);
    
        // Directory with views of the current controller
        return str_replace('Controller', '', lcfirst($controller));
    }
}