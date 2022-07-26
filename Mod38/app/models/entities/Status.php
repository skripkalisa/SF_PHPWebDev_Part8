<?php

namespace App\models\entities;

// require_once CORE.'enum.php';
use App\core\BasicEnum;

interface IStatus
{
    public function setStatus($status);
}

abstract class Status extends BasicEnum implements IStatus
{
    public const ACTIVE = 'active';
    public const SUSPENDED = 'suspended';
    public const DELETED = 'deleted';

    protected $_status;

    public function __construct()
    {
        $this->_status = Status::ACTIVE;
    }

    public function setStatus($status)
    {
        if (Status::isValidValue($status)) {
            $this->_status = $status;
        }

        return $this->_status;
    }
}
