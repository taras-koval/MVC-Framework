<?php

namespace App\Core;

class App
{
    private Request $request;
    private Response $response;
    private Router $router;
    
    public function __construct()
    {
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request);
    }
    
    public function run()
    {
        /*$response = $this->router->run();
        
        if (!$response instanceof Response) {
            $this->response = new Response($response);
        } else {
            $this->response = $response;
        }*/
        
        $this->response = $this->router->run();
        $this->response->send();
    }
}
