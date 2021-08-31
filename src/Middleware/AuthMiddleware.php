<?php

namespace App\Middleware;

use App\Core\Middleware;

class AuthMiddleware extends Middleware
{
    public array $actions = [];
    
    public function __construct(array $actions = [])
    {
        $this->actions = $actions;
    }
    
    public function execute(array $params = [])
    {
        if (session()->isGuest()) {
            if (empty($this->actions) || in_array($params['action'], $this->actions)) {
                redirect('/login');
            }
        }
    }
}