<?php

namespace App\ViewModels;

class UserVM
{
    public $username;
    public $email;
    public $password;
    public $token;

    public function __construct(array $data)
    {
        $this->username = $data['username'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->token = $data['token'];
    }
}
