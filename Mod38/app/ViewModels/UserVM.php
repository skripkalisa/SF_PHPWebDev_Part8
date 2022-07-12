<?php

namespace App\ViewModels;

class UserVM
{
    public $firstname;
    public $lastname;
    public $email;
    public $password;
    public $role;
    public $token;

    public function __construct(array $data)
    {
        $this->firstname = $data['firstname'];
        $this->lastname = $data['lastname'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->role = $data['role'];
        $this->token = $data['token'];
    }
}
