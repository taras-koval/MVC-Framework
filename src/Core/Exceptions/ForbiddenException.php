<?php

namespace App\Core\Exceptions;

use Exception;

class ForbiddenException extends Exception
{
    protected $message = 'Forbidden';
    protected $code = 403;
}