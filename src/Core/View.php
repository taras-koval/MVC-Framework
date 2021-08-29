<?php

namespace App\Core;

class View
{
    private string $layout;
    private string $layoutsPath;
    private string $viewsPath;
    
    public function __construct()
    {
        $config = require ROOT.'/config/view.php';
        
        $this->layout = $config['defalultLayout'];
        $this->layoutsPath = $config['layoutsPath'];
        $this->viewsPath = $config['viewsPath'];
    }
    
    public function getViewsPath()
    {
        return $this->viewsPath;
    }
    
    public function make(string $path, array $data)
    {
        $layoutContent = $this->getLayoutContent();
        $viewContent = $this->getViewContent($path, $data);
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
}
