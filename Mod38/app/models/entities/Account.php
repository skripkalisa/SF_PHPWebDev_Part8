<?php

namespace App\models;

class Account implements IStatus
{
    private $_userId;
    private $_balance;
    private $_created;
    private $_updated;
    private $_status;

    public function __construct(object $entity = null)
    {
        $this->_userId = $entity->userId;
        $this->_balance = $entity->balance;
        $this->_created = \DateTime::createFromFormat('U', $entity->created);
        $this->_updated = \DateTime::createFromFormat('U', $entity->updated);
        $this->_status = $entity->status;
    }
}
