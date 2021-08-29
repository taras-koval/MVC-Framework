<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Model\User\User;
use App\Model\User\UserLogin;
use App\Model\User\UserRegister;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->setLayout('bootstrap');
    }
    
    public function login(Request $request): Response
    {
        $userLogin = new UserLogin();
        
        if ($request->isPost()) {
            $userLogin->loadFromRequest($request);
    
            if ($userLogin->validate() && $userLogin->login()) {
                session()->setFlash('success', 'Login success');
                redirect('/login');
            }
        }
        
        return $this->render('auth/login.php', ['model' => $userLogin]);
    }
    
    public function register(Request $request): Response
    {
        $userRegister = new UserRegister();
        
        if ($request->isPost()) {
            $userRegister->loadFromRequest($request);
    
            if ($userRegister->validate()) {
                $user = (new User())->load($userRegister);
                
                if ($user->save()) {
                    session()->setFlash('success', 'Register success');
                    redirect('/register');
                }
            }
        }
        
        return $this->render('register', ['model' => $userRegister]);
    }
    
    public function logout()
    {
        session()->logout();
        redirect('/login');
    }
}