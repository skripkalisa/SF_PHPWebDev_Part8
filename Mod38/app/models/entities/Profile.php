<?php

namespace App\models\entities;

use App\models\entities\Role;
use \RedBeanPHP\R as R;

class Profile extends \RedBeanPHP\SimpleModel
{
    private $firstName;
    private $lastName;
    private $role;
    private $created;
    private $updated;
    private $userId;
    private $accountId;
    public function __construct(object $entity = null)
    {
        $this->firstName = $entity->firstName;
        $this->lastName = $entity->lastName;
        $this->role = $entity->role;
        $this->created = $entity->created;
        $this->updated = $entity->updated;
        $this->userId = $entity->userId;
        $this->accountId = $entity->accountId;
    }
}
