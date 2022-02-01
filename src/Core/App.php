<?php

namespace App\Core;

class App
{
    private Request $request;
    private Router $router;
    
    public static Database $database;
    public static Session $session;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->router = new Router($this->request);
        
        self::$database = new Database();
        self::$session = new Session();
    }
    
    public function run()
    {
        $response = $this->router->run();
        $response->send();
    }
}
