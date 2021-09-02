<?php

namespace App\Core;

class View
{
    private string $layout;
    private string $layoutsPath;
    private string $viewsPath;
    
    private string $title;
    
    public function __construct()
    {
        $config = require ROOT.'/config/view.php';
        
        $this->layout = $config['defaultLayout'];
        $this->layoutsPath = $config['layoutsPath'];
        $this->viewsPath = $config['viewsPath'];
        
        $this->title = $config['defaultTitle'];
    }
    
    public function getViewsPath()
    {
        return $this->viewsPath;
    }
    
    public function make(string $path, array $data)
    {
        $viewContent = $this->getViewContent($path, $data);
        $layoutContent = $this->getLayoutContent();
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    public function getViewContent(string $viewPath, array $data)
    {
        extract($data);
        
        ob_start();
        require $viewPath;
        return ob_get_clean();
    }
    
    private function getLayoutContent()
    {
        ob_start();
        require "$this->layoutsPath/$this->layout.php";
        return ob_get_clean();
    }
    
    public function setLayout(string $layout)
    {
        if (file_exists("$this->layoutsPath/$layout.php")) {
            $this->layout = $layout;
        }
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
}
