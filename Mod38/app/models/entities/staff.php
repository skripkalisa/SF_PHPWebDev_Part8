<?php

namespace App\models;

class Staff extends Role
{
    private $_role;

    public function __construct($userId, $accountId)
    {
        parent::__construct($userId, $accountId);
        $this->_role = Role::STAFF;
    }
}
