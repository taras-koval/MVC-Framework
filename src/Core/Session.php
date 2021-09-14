<?php

namespace App\Core;

class Session
{
    public ?ModelAR $user = null;
    public string $userClass;
    
    public function __construct()
    {
        session_start();
    
        $_SESSION['flash'] = $_SESSION['flash'] ?? [];
        foreach ($_SESSION['flash'] as &$flashMessage) {
            $flashMessage['remove'] = true;
        }
    
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
    
    public function setSuccessFlash($message)
    {
        $_SESSION['flash']['success'] = [
            'remove' => false,
            'value' => $message
        ];
    }
    
    public function setDangerFlash($message)
    {
        $_SESSION['flash']['danger'] = [
            'remove' => false,
            'value' => $message
        ];
    }
    
    public function getSuccessFlash()
    {
        return $_SESSION['flash']['success']['value'] ?? '';
    }
    
    public function getDangerFlash()
    {
        return $_SESSION['flash']['danger']['value'] ?? '';
    }
    
    public function __destruct()
    {
        foreach ($_SESSION['flash'] as $key => $flashMessage) {
            if ($flashMessage['remove']) {
                unset($_SESSION['flash'][$key]);
            }
        }
    }
}