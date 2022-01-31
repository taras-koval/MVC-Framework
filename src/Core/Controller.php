<?php

namespace App\Core;

abstract class Controller
{
    protected ?string $layout = null;
    protected ?string $title = null;
    
    /** @var Middleware[] $middlewares */
    private array $middlewares = [];
    
    protected function view(string $path, array $data = []): Response
    {
        return view($path, $data, $this->title, $this->layout);
    }
    
    /**
     * @param  string|null  $middleware (example - Authenticate::class)
     */
    public function middleware(string $middleware = null, array $params = null)
    {
        if (isset($middleware)) {
            $this->middlewares[] = new $middleware($params);
        }
    }
    
    /**
     * @return Middleware[]
     */
    public function getMiddlewares(): array
    {
        return $this->middlewares;
    }
}