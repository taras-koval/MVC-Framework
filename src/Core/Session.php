<?php

namespace App\Core;

use App\Models\User;

class Session
{
    public ?User $user = null;
    
    public function __construct()
    {
        session_start();
    
        $_SESSION['flash'] = $_SESSION['flash'] ?? [];
        
        foreach ($_SESSION['flash'] as &$flashMessage) {
            $flashMessage['remove'] = true;
        }
        
        $userId = $this->get('user');
        
        if ($userId) {
            $user = User::find(['id' => $userId]);
        
            if ($user) {
                $this->user = $user;
            } else {
                $this->logout();
            }
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
    
    public function authorize(User $user)
    {
        $this->user = $user;
        $this->set('user', $user->{'id'});
    }
    
    public function logout()
    {
        $this->user = null;
        $this->remove('user');
    }
    
    public function isGuest(): bool
    {
        return is_null($this->user);
    }
    
    public function setSuccessFlash($message)
    {
        $_SESSION['flash']['success'] = [
            'value' => $message,
            'remove' => false
        ];
    }
    
    public function getSuccessFlash()
    {
        return $_SESSION['flash']['success']['value'] ?? '';
    }
    
    public function setDangerFlash($message)
    {
        $_SESSION['flash']['danger'] = [
            'value' => $message,
            'remove' => false
        ];
    }
    
    public function getDangerFlash()
    {
        return $_SESSION['flash']['danger']['value'] ?? '';
    }
    
    public function setFormErrorsFlash(array $errors)
    {
        $_SESSION['flash']['formErrors'] = [
            'value' => $errors,
            'remove' => false
        ];
    }
    
    public function getFormErrorFlash($key)
    {
        return $_SESSION['flash']['formErrors']['value'][$key] ?? [];
    }
    
    public function hasFormErrors(): bool
    {
        return isset($_SESSION['flash']['formErrors']);
    }
    
    public function setRequestDataFlash(array $body)
    {
        $_SESSION['flash']['requestData'] = [
            'value' => $body,
            'remove' => false
        ];
    }
    
    public function getRequestDataFlash($key)
    {
        return $_SESSION['flash']['requestData']['value'][$key] ?? [];
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