<?php

namespace App\Core;

class View
{
    private string $title;
    private string $layout;
    private string $layoutsRoot;
    private string $viewsRoot;
    
    public function __construct(string $title = null, string $layout = null)
    {
        $config = config('view');
        
        $this->title = $title ?? $config['defaultTitle'];
        $this->layout = $layout ?? $config['defaultLayout'];
        $this->layoutsRoot = $config['layoutsRoot'];
        $this->viewsRoot = $config['viewsRoot'];
    }
    
    /**
     * @param  string  $path (example - 'main/home.php')
     * @param  array  $data
     * @return string
     */
    public function render(string $path, array $data = []): string
    {
        $viewContent = $this->getViewContent($path);
        $layoutContent = $this->getLayoutContent($data);
        
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    public function getViewContent(string $viewPath)
    {
        ob_start();
        include $this->viewsRoot . '/' . ltrim($viewPath, '/');
        return ob_get_clean();
    }
    
    private function getLayoutContent(array $data)
    {
        $data['title'] = $this->title;
        
        extract($data);
        
        ob_start();
        include $this->layoutsRoot . '/' . ltrim($this->layout, '/');
        return ob_get_clean();
    }
    
}
