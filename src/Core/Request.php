<?php

namespace App\Core;

class Request
{
    private array $body = [];
    
    public function __construct()
    {
        $this->body = $this->extractBody();
    }
    
    public function getPath(): string
    {
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        // $path = urldecode($path);
        
        return (strlen($path) > 1) ? rtrim($path, '/') : $path;
    }
    
    public function getMethod(): string
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }
    
    public function isPost(): bool
    {
        return $this->getMethod() === 'post';
    }
    
    private function extractBody(): array
    {
        $body = [];
        
        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                $body[$key] = trim($body[$key]);
            }
        }
    
        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                $body[$key] = trim($body[$key]);
            }
        }
        
        return $body;
    }
    
    public function body(): array
    {
        return $this->body;
    }
    
    public function get($key)
    {
        return $this->body()[$key];
    }
    
    public function validate(array $rules): bool
    {
        session()->setRequestDataFlash($this->body());
        
        $errors = (new Validator())->validate($rules, $this->body());
        
        if (!empty($errors)) {
            session()->setFormErrorsFlash($errors);
            back();
            return false;
        }
        
        return !session()->hasFormErrors();
    }
    
    public function old($key, $default = '')
    {
        if (session()->getRequestDataFlash($key)) {
            return session()->getRequestDataFlash($key);
        }
        
        return $default;
    }
    
}