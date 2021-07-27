<?php

namespace App\Core;

abstract class Controller
{
    protected View $view;
    
    public function __construct()
    {
        $this->view = new View();
    }
    
    protected function renderView(string $path, array $data = []) : Response
    {
        return new Response($this->view->make(ROOT . "/views/$path", $data));
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
        $controller = substr(strrchr(get_class($this), '\\'), 1);
    
        // Directory with views of the current controller
        return str_replace('Controller', '', lcfirst($controller));
    }
}