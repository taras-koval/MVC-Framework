<?php

namespace App\Controllers\Auth;

use App\Core\Controller;
use App\Core\Response;
use App\Middlewares\Authenticate;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware(Authenticate::class);
    }
    
    public function account(): Response
    {
        
        return $this->render('account');
    }
}