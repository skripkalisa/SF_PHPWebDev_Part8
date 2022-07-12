<?php

namespace App\data;

use RedBeanPHP\R as R;

try {
    R::setup('sqlite:'.DATA.'db/db.sqlite');
    if (!R::testConnection()) {
        throw new \Exception('No database connection.');
    }
} catch (\RedBeanPHP\RedException $e) {
    throw new \Exception($e);
    exit(var_dump($e));
}

function getAll(string $table)
{
    return R::getAll("SELECT * FROM $table");
}

function getById(string $table, int $id)
{
    $obj = R::load($table, $id);

    return $obj;
}

function getUserByToken($token)
{
    $user = R::findOne('users', 'token = ?', [$token]);
    // var_dump($user);

    return $user;
}

function getEntity(object $entity, object $bean)
{
    $values = array_values(get_object_vars($entity));
    $keys = array_keys(get_class_vars(get_class($entity)));
    foreach ($keys as $key => $value) {
        if ($value == 'bean') {
            break;
        }
        $bean->$value = $values[$key];
    }

    return $bean;
}

function create(object $entity, string $table)
{
    $bean = R::dispense($table);
    // foreach ($entity as $key => $value) {
    //     $bean->$key = $value;
    // }
    $obj = getEntity($entity, $bean);
    $id = R::store($obj);

    return $id;
}

function update(object $entity, string $table)
{
    $bean = R::load($table, $entity->id);
    foreach ($entity as $key => $value) {
        $bean->$key = $value;
    }
    $id = R::store($bean);

    return $id;
}

function delete(int $entity, string $table)
{
    $bean = R::load($table, $id);
    R::trash($bean);
}

function getConnection()
{
    // require CORE . '/config/credentials.php';

    // return new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
}
/*
function insert(array $data)
{
    $query = 'INSERT INTO users (name, email, password, date_created, token) VALUES(?, ?, ?, ?, ?)';
    $db = get_connection();
    $stmt = $db->prepare($query);
    return $stmt->execute($data);
}

function getUserByEmail(string $email)
{
    $query = 'SELECT * FROM users WHERE email = ?';
    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$email]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}
function getUserByName(string $name)
{
    $query = 'SELECT * FROM users WHERE name = ?';
    $db = get_connection();
    $stmt = $db->prepare($query);
    $stmt->execute([$name]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($result) {
        return $result;
    }
    return false;
}


function getUsersList()
{
    $query = 'SELECT * FROM users ORDER BY id DESC';
    $db = get_connection();
    return $db->query($query, PDO::FETCH_ASSOC);
}
*/
