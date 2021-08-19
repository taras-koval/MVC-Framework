<?php

namespace App\Core\Exception;

use Exception;

class FileNotExistsException extends Exception
{
    public function __construct(string $path = null)
    {
        $message = ($path)? "File '$path' doesn't exist." : null;
        
        if (!$message) {
            throw new $this('Unknown '. get_class($this));
        }
        parent::__construct($message);
    }
}