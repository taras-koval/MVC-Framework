<?php

namespace App\Controller;

use App\Core\App;
use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Model\User;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayout('main');
    }
    
    public function login(Request $request): Response
    {
        
        return $this->render('login', ['method' => $request->getMethod()]);
    }
    
    public function register(Request $request): Response
    {
        $user = new User();
        
        if ($request->isPost()) {
            $user->setData($request->GetBody());
    
            if ($user->validate() && $user->save()) {
                App::$session->setFlash('success', 'Register success');
                (new Response())->redirect('/register');
            }
    
            return $this->render('register', ['model' => $user]);
        }
        
        return $this->render('register', ['model' => $user]);
    }
}