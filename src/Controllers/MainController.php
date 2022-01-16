<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;

class MainController extends Controller
{
    public function __construct()
    {
        $this->title = 'Home';
    }
    
    public function index(): Response
    {
        
        return $this->view('/main/home.php');
    }
    
    public function showContact(): Response
    {
        
        return $this->view('/main/contact.php');
    }
    
    public function contact(Request $request): Response
    {
        dump($request->body());
        
        return $this->view('/main/contact.php');
    }
}