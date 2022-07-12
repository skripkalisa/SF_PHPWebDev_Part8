<?php

namespace App\models;

class Merchant extends Role
{
    private $role;

    public function __construct($userId, $accountId = null)
    {
        parent::__construct($userId, $accountId);
        $this->role = Role::MERCHANT;
    }
}
