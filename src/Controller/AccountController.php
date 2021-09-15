<?php

namespace App\Controller;

use App\Core\Controller;
use App\Core\Response;
use App\Middleware\AuthRequireMiddleware;

class AccountController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->registerMiddleware(new AuthRequireMiddleware(['account']));
    }
    
    public function account(): Response
    {
        
        return $this->render('account');
    }
}