<?php

namespace App\Models;

use App\Core\Model;

class User extends Model
{
    public string $username;
    public string $email;
    public string $password;
    public int $status;
    
    protected static function table(): string
    {
        return 'users';
    }
    
    public function save()
    {
        $this->username = strtolower($this->username);
        $this->password = password_hash($this->password, PASSWORD_DEFAULT);
        return parent::save();
    }
}