<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\Response;
use App\Middlewares\Authenticate;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->registerMiddleware(new Authenticate(['account']));
    }
    
    public function account(): Response
    {
        
        return $this->render('account');
    }
}