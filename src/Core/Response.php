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
    
    public function setStatusCode(int $statusCode): Response
    {
        http_response_code($statusCode);
        return $this;
    }
    
    public function redirect($url, $code = 302)
    {
        header("Location: $url", true, $code);
        exit();
    }
    
    public function back()
    {
        $url = $_SERVER["HTTP_REFERER"] ?? $_SERVER["REQUEST_URI"];
        header("Location: $url");
        exit();
    }
}