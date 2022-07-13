<?php

namespace App\models\entities;

// include_once MODEL.'entities/role.php';
use App\models\entities\Role;
use \RedBeanPHP\R as R;

class User extends \RedBeanPHP\SimpleModel
{
    private $username;
    private $email;
    private $password;
    private $created;
    private $token;

    public function __construct($entity = null)
    {
        $this->username = $entity->username;
        $this->email = $entity->email;
        $this->password = $entity->password;
        $this->created = \DateTime::createFromFormat('U', time());
        $this->token = $entity->token;
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
