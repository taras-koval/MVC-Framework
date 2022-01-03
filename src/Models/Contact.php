<?php

namespace App\Models;

use App\Core\Model;
use App\Core\Validator;

class Contact extends Model
{
    public string $name = '';
    public string $email = '';
    public string $message = '';
    
    public function send(): bool
    {
        return true;
    }
    
    public function getInputsInfo(): array
    {
        return [
            'name' => [
                'value' => $this->name,
                'label' => 'Name',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_WORDS,
                ]
            ],
            'email' => [
                'value' => $this->email,
                'label' => 'Email',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_EMAIL
                ]
            ],
            'message' => [
                'value' => $this->message,
                'label' => 'Password',
                'rules' => [
                    Validator::RULE_REQUIRED,
                    Validator::RULE_MIN => 10
                ]
            ],
        ];
    }
}