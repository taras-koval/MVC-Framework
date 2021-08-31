<?php

namespace App\Core;

class Session
{
    public ?ModelAR $user = null;
    public string $userClass;
    
    public function __construct()
    {
        session_start();
    
        $flashMessages = $_SESSION['flash'] ?? [];
        
        foreach ($flashMessages as &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        
        $_SESSION['flash'] = $flashMessages;
    
        $this->userClass = (require ROOT.'/config/app.php')['userClass'];
        
        $userId = $this->get('user');
        if ($userId) {
            $primaryKey = $this->userClass::getDBPrimaryKey();
            $this->user = $this->userClass::find([$primaryKey => $userId]);
        }
    }
    
    public function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    
    public function get($key)
    {
        return $_SESSION[$key] ?? false;
    }
    
    public function remove($key)
    {
        unset($_SESSION[$key]);
    }
    
    public function auth(ModelAR $user): bool
    {
        $this->user = $user;
        $primaryKey = $user::getDBPrimaryKey();
        $this->set('user', $user->{$primaryKey});
        return true;
    }
    
    public function logout()
    {
        $this->user = null;
        $this->remove('user');
    }
    
    public function isGuest(): bool
    {
        return !$this->user;
    }
    
    public function setFlash($key, $message)
    {
        $_SESSION['flash'][$key] = [
            'remove' => false,
            'value' => $message
        ];
    }
    
    public function getFlash($key)
    {
        return $_SESSION['flash'][$key]['value'] ?? '';
    }
    
    public function __destruct()
    {
        $flashMessages = $_SESSION['flash'] ?? [];
        
        foreach ($flashMessages as $key => &$flashMessage) {
            if ($flashMessage['remove']) {
                unset($flashMessages[$key]);
            }
        }
        
        $_SESSION['flash'] = $flashMessages;
    }
}