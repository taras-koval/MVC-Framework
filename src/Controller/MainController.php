<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class MainController extends Controller
{
    
    public function index(): Response
    {
        return $this->render('home');
    }
    
    public function contact(): Response
    {
        $this->setLayout('test');
        return $this->render('contact');
    }
    
    public function notFound(Request $request, Response $response): Response
    {
        $response->setStatusCode('404');
        return $this->render('404', ['path' => $request->getPath()]);
    }
    
}