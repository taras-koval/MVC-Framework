<?php

namespace App\Model;

use App\Core\Model;

class Register extends Model
{
    public string $username = '';
    public string $email = '';
    public string $password = '';
    public string $confirmPassword = '';
    
    public function register(): bool
    {
        return true;
    }
    
    public function rules(): array
    {
        return [
            'username' => [self::RULE_REQUIRED],
            'email' => [self::RULE_REQUIRED, self::RULE_EMAIL],
            'password' => [self::RULE_REQUIRED, [self::RULE_MIN, 'min' => 4], [self::RULE_MAX, 'max' => 20]],
            'confirmPassword' => [self::RULE_REQUIRED, [self::RULE_MATCH, 'match' => 'password']]
        ];
    }
}