<?php

// namespace App;

namespace App\models\entities;

// require_once CORE.'Enum.php';

use App\core\BasicEnum;

abstract class Roles extends BasicEnum
{
    public const STAFF = 'staff';
    public const MERCHANT = 'merchant';
    public const WEBMASTER = 'webmaster';
    public const UNSET = 'unset';
}

abstract class Role
{
    protected $_userId;
    protected $_accountId;

    public function __construct($userId, $accountId)
    {
        $this->_userId = $userId;
        $this->_accountId = $accountId;
    }

    public function getUserId()
    {
        return $this->_userId;
    }

    public function getAccountId()
    {
        return $this->_userId;
    }
}
