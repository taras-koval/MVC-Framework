<?php

namespace App\Core;

class View
{
    private string $title;
    private string $layout;
    private string $layoutsRoot;
    private string $viewsRoot;
    
    public function __construct()
    {
        $config = require ROOT . '/config/view.php';
    
        $this->title = $config['defaultTitle'];
        $this->layout = $config['defaultLayout'];
        $this->layoutsRoot = $config['layoutsRoot'];
        $this->viewsRoot = $config['viewsRoot'];
    }
    
    /**
     * @param  string  $viewPath (example - 'main/home.php')
     * @param  array  $data
     * @return string
     */
    public function render(string $viewPath, array $data): string
    {
        $viewContent = $this->getViewContent($viewPath, $data);
        $layoutContent = $this->getLayoutContent();
        
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    public function getViewContent(string $viewPath, array $data)
    {
        extract($data);
        
        ob_start();
        include $this->viewsRoot . '/' . ltrim($viewPath, '/');
        return ob_get_clean();
    }
    
    private function getLayoutContent()
    {
        ob_start();
        include $this->layoutsRoot . '/' . ltrim($this->layout, '/');
        return ob_get_clean();
    }
    
    public function setLayout(string $layout)
    {
        if (file_exists($this->layoutsRoot . '/' . ltrim($layout, '/'))) {
            $this->layout = $layout;
        }
    }
    
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }
    
    public function getTitle(): string
    {
        return $this->title;
    }
    
}
