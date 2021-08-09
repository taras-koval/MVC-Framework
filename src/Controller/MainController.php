<?php

namespace App\Controller;

use App\Core\App;
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
        $this->setLayout('main');
        return $this->render('404', ['path' => $request->getPath()])->setStatusCode('404');
    }
}