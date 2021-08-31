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
        
        return $this->render('contact');
    }
}