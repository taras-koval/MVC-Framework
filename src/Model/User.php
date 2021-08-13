<?php

namespace App\Model;

use App\Core\Model;

class User extends Model
{
    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    public int $status = self::STATUS_INACTIVE;
    
    public function save(): bool
    {
        $this->status = self::STATUS_ACTIVE;
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
    
    public function table(): string
    {
        return 'users';
    }
    
    public function fields(): array
    {
        return ['username', 'email', 'password', 'status'];
    }
    
    public function labels(): array
    {
        return [
            'username' => 'Username',
            'email' => 'Email',
            'password' => 'Password',
            'confirmPassword' => 'Confirm password'
        ];
    }
    
    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED,
                self::RULE_ALPHANUMERIC,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'email' => [self::RULE_REQUIRED,
                self::RULE_EMAIL,
                [self::RULE_UNIQUE, 'class' => self::class]
            ],
            'password' => [self::RULE_REQUIRED,
                self::RULE_ALPHANUMERIC,
                [self::RULE_MIN, 'min' => 4],
                [self::RULE_MAX, 'max' => 20]
            ],
            'confirmPassword' => [self::RULE_REQUIRED,
                [self::RULE_MATCH, 'match' => 'password']
            ]
        ];
    }
    
}