<?php

namespace App\Core\Exception;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Forbidden';
    protected $code = 403;
}