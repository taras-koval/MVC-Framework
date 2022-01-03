<?php

namespace App\Models\User;

use App\Core\Model;
use App\Core\Validator;
use App\Models\User;

class UserRegister extends Model
{
    public string $email = '';
    public string $username = '';
    public string $password = '';
    public string $confirmPassword = '';
    
    public function getInputsInfo(): array
    {
        return [
            'email' => [
                'value' => $this->email,
                'label' => 'Email',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_EMAIL,
                    Validator::RULE_UNIQUE => User::getDBTableName()
                ]
            ],
            'username' => [
                'value' => $this->username,
                'label' => 'Username',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_ALPHANUMERIC,
                    Validator::RULE_UNIQUE => User::getDBTableName()
                ]
            ],
            'password' => [
                'value' => $this->password,
                'label' => 'Password',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_ALPHANUMERIC,
                    Validator::RULE_MIN => 4,
                    Validator::RULE_MAX => 8
                ]
            ],
            'confirmPassword' => [
                'value' => $this->confirmPassword,
                'label' => 'Confirm password',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_MATCH => 'password'
                ]
            ]
        ];
    }
    
    
}