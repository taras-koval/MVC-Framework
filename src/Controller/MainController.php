<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Model\Contact;

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
                session()->setFlash('success', 'Thanks for contacting us.');
                redirect('/contact');
            }
        }
        
        return $this->render('contact');
    }
}