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
    
    public function test(Request $request, $slug, $id): Response
    {
        dump($slug, $id);
        dump($request->GetBody());
        
        return new Response();
    }
    
    public function notFound(Request $request): Response
    {
        return $this->render('404', ['path' => $request->getPath()])->setStatusCode('404');
    }
}