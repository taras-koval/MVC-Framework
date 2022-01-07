<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Core\Validator;
use App\Middlewares\Guest;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware(Guest::class);
    }
    
    public function showLogin(): Response
    {
        return $this->view('auth/login.php');
    }
    
    public function login(Request $request)
    {
        $request->validate([
            'email' => [Validator::REQUIRED, Validator::EMAIL],
            'password' => [Validator::REQUIRED, Validator::ALPHANUMERIC]
        ]);
        
        $user = $this->authentication($request->get('email'), $request->get('password'));
        session()->authorize($user);
        
        redirect('/account');
    }
    
    private function authentication(string $login, string $password) : ?User
    {
        $user = User::find(['email' => $login]);
    
        if (!$user) {
            session()->setDangerFlash('Incorrect login or password.');
            back();
        }
    
        if (!password_verify($password, $user->password)) {
            session()->setDangerFlash('Incorrect login or password.');
            back();
        }
        
        return $user;
    }
}