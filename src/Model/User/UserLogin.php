<?php

namespace App\Model\User;

use App\Core\Model;
use App\Core\Validator;

class UserLogin extends Model
{
    public string $email = '';
    public string $password = '';
    
    public function getInputsInfo(): array
    {
        return [
            'email' => [
                'value' => $this->email,
                'label' => 'Email',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_EMAIL,
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
        $user = User::find(['email' => $this->email]);
        
        if (!$user) {
            session()->setDangerFlash('Incorrect email or password.');
            return false;
        }
        
        if (!password_verify($this->password, $user->password)) {
            session()->setDangerFlash('Incorrect email or password.');
            return false;
        }
        
        return session()->auth($user);
    }
}