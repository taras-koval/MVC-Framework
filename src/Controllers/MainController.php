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
        $contact = new Contact();
        
        if ($request->isPost()) {
            $contact->loadFromRequest($request);
            
            if ($contact->validate() && $contact->send()) {
                session()->setSuccessFlash('Thanks for contacting us.');
                redirect('/contact');
            }
        }
        
        return $this->render('contact', ['model' => $contact]);
    }
}