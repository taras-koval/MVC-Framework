<?php

namespace App\Core;

abstract class Middleware
{
    protected ?array $params = null;
    
    public function __construct(array $params = null)
    {
        if (isset($params)) {
            $this->params = $params;
        }
    }
    
    abstract public function handle();
}