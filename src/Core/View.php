<?php

namespace App\Core;

class View
{
    private string $layout;
    private string $layouts = ROOT . '/views/_layouts';
    
    public function __construct(string $layout = 'test')
    {
        $this->layout = $layout;
    }
    
    public function make(string $path, array $data)
    {
        $layoutContent = $this->getLayoutContent();
        $viewContent = $this->getViewContent($path, $data);
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }
    
    private function getViewContent(string $viewFilePath, array $data)
    {
        /*foreach ($data as $key => $value) {
            $$key = $value;
        }*/
        
        extract($data);
        
        ob_start();
        include_once $viewFilePath;
        return ob_get_clean();
    }
    
    private function getLayoutContent()
    {
        ob_start();
        include_once "$this->layouts/$this->layout.php";
        return ob_get_clean();
    }
    
    public function setLayout(string $layout)
    {
        if (file_exists("$this->layouts/$layout.php")) {
            $this->layout = $layout;
        }
    }
}
