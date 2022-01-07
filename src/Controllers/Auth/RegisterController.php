<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Request;
use App\Core\Response;
use App\Middlewares\Guest;
use App\Models\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware(Guest::class);
    }
    
    public function showRegister(): Response
    {
        return $this->view('auth/register.php');
    }
    
    public function register(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'unique' => 'users'],
            'username' => ['required', 'alphanumeric', 'unique' => 'users', 'min' => 2, 'max' => 32],
            'password' => ['required', 'alphanumeric', 'min' => 4, 'max' => 32],
            'confirmPassword' => ['required', 'match' => 'password']
        ]);
        
        $user = new User($request->body());
        $user->save();
    
        session()->authorize($user);
    
        redirect('/account');
    }
}