<?php

namespace App\Core;

class Session
{
    protected const FLASH_KEY = 'flashMessages';
    
    public function __construct()
    {
        session_start();
    
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
    
        foreach ($flashMessages as &$flashMessage) {
            $flashMessage['remove'] = true;
        }
    
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
    
    public function setFlash($key, $message)
    {
        $_SESSION[self::FLASH_KEY][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }
    
    public function getFlash($key)
    {
        return $_SESSION[self::FLASH_KEY][$key]['value'] ?? '';
    }
    
    public function __destruct()
    {
        $flashMessages = $_SESSION[self::FLASH_KEY] ?? [];
        
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        
        $_SESSION[self::FLASH_KEY] = $flashMessages;
    }
}