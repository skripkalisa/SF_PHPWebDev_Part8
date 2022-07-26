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

    public function __construct(object $entity = null)
    {
        $this->firstName = $entity->firstName;
        $this->lastName = $entity->lastName;
        $this->role = $entity->role;
        $this->created = \DateTime::createFromFormat('U', time());

        $this->updated = \DateTime::createFromFormat('U', time());

        $this->userId = $entity->userId;
    }
}
