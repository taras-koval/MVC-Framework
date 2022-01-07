<?php

namespace App\Middlewares;

use App\Core\Middleware;

class Guest extends Middleware
{
    public function handle()
    {
        if (!session()->isGuest()) {
            redirect('/account');
        }
    }
}