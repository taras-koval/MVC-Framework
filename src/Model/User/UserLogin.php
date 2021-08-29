<?php

namespace App\Model\User;

use App\Core\Model;
use App\Core\Validator;

class UserLogin extends Model
{
    public string $username = '';
    public string $password = '';
    
    public function getInputsInfo(): array
    {
        return [
            'username' => [
                'value' => $this->username,
                'label' => 'Username',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_ALPHANUMERIC,
                ]
            ],
            'password' => [
                'value' => $this->password,
                'label' => 'Password',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_ALPHANUMERIC,
                ]
            ]
        ];
    }
    
    public function login(): bool
    {
        $user = User::find(['username' => $this->username]);
        
        if (!$user) {
            $this->addError('username', 'User does not exist');
            return false;
        }
        
        if (!password_verify($this->password, $user->password)) {
            $this->addError('password', 'Password is incorrect');
            return false;
        }
        
        return session()->auth($user);
    }
}