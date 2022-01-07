<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\Contact;

class MainController extends Controller
{
    public function index(): Response
    {
        
        return $this->render('home');
    }
    
    public function contact(Request $request): Response
    {
        dump($request->body());
        
        return $this->view('/main/contact.php');
    }
}