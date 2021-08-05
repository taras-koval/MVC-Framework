<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Model\Register;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayout('main');
    }
    
    public function loginHandler(Request $request): Response
    {
        
        return $this->render('login', ['method' => $request->getMethod()]);
    }
    
    public function login(Request $request): Response
    {
        
        return $this->render('login', ['method' => $request->getMethod()]);
    }
    
    public function registerHandler(Request $request): Response
    {
        $model = new Register();
        $model->setData($request->GetBody());
    
        if ($model->validate() && $model->register()) {
            echo 'Success';
        }
    
        // dump($model);
    
        return $this->render('register', ['model' => $model]);
    }
    
    public function register(): Response
    {
        $model = new Register();
        return $this->render('register', ['model' => $model]);
    }
}