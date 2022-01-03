<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Models\User;
use App\Models\User\UserLogin;
use App\Models\User\UserRegister;

class AuthController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login(Request $request): Response
    {
        $userLogin = new UserLogin();
        
        if ($request->isPost()) {
            $userLogin->loadFromRequest($request);
    
            if ($userLogin->validate() && $userLogin->login()) {
                redirect('/account');
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
                
                $user->id = $user->save();
                
                if ($user->id) {
                    session()->auth($user);
                    redirect('/account');
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