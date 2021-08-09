<?php

namespace App\Core;

class App
{
    private Request $request;
    private Response $response;
    private Router $router;
    
    public static Database $database;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
        
        self::$database = new Database();
    }
    
    public function run()
    {
        $this->response = $this->router->run();
        $this->response->send();
    }
}
