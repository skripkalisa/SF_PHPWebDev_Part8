<?php

namespace App\models;

class Account implements IStatus
{
    private $_userId;
    private $_balance;
    private $_entityRole;
    private $_entityRoleId;
    private $_created;

    public function __construct($userId, $balance, $entityRole, $entityRoleId)
    {
        $this->_userId = $userId;
        $this->_balance = $balance;
        $this->_entityRole = $entityRole;
        $this->_entityRoleId = $entityRoleId;
        $this->_created = DateTime::createFromFormat('U', time());
    }
}
