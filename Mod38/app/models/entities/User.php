<?php

namespace App\models\entities;

// include_once MODEL.'entities/role.php';
use App\models\entities\Role;
use \RedBeanPHP\R as R;

class User extends \RedBeanPHP\SimpleModel
{
    protected $firstName;
    protected $lastName;
    protected $email;
    protected $password;
    protected $role;
    protected $created;
    protected $token;

    public function __construct($entity = null)
    {
        $this->firstName = $entity->firstname;
        $this->lastName = $entity->lastname;
        $this->email = $entity->email;
        $this->password = $entity->password;
        if (Roles::isValidValue($entity->role)) {
            $this->role = $entity->role;
        } else {
            $this->role = Roles::UNSET;
        }
        $this->token = $entity->token;

        $this->created = \DateTime::createFromFormat('U', time());
    }

    public function getClassValues()
    {
        return array_values(get_object_vars($this));
    }

    public function getClassKeys()
    {
        return array_keys(get_class_vars(get_class($this))); // $this
    }

    public function getThisUser()
    {
        return [get_object_vars($this)];
    }

    public function save()
    {
        $this->bean = R::dispense('users');
        $values = $this->getClassValues();
        $keys = $this->getClassKeys();
        foreach ($keys as $key => $value) {
            if ($value == 'bean') {
                break;
            }
            $this->bean->$value = $values[$key];
        }

        $userId = R::store($this->bean);

        // return $this->bean;
    }

    public function dropTable(string $table)
    {
        \RedBeanPHP\R::exec("DROP TABLE IF EXISTS $table");
    }
}
