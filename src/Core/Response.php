<?php

namespace App\Core;

class Response
{
    private string $body;
    private array $headers = [];
    
    public function __construct(string $body = '')
    {
        $this->body = $body;
    }
    
    public function withHeader(string $header, string $value) : Response
    {
        $copy = new self($this->body);
        $copy->headers[$header] = $value;
        
        return $copy;
    }
    
    public function send()
    {
        foreach ($this->headers as $header => $value) {
            header("$header: $value");
        }
        
        echo $this->body;
    }
    
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }
    
    public function redirect($url)
    {
        header("Location: $url");
        exit();
    }
    
}