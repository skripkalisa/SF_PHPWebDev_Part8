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
function getByProp(string $table, string $prop, string $value)
{
    $obj = R::findOne($table, "$prop = ?", [$value]);

    return $obj;
}

function getUserByToken($token)
{
    $user = R::findOne('users', 'token = ?', [$token]);

    return $user;
}

function getBeanEntity(object $entity, object $bean)
{
    $reflection = new \ReflectionClass($entity);
    $props = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE | \ReflectionProperty::IS_PROTECTED | \ReflectionProperty::IS_PUBLIC);
    foreach ($props as $prop) {
        $prop->setAccessible(true);
        $propName = $prop->getName();
        $propValue = $prop->getValue($entity);
        $bean->$propName = $propValue;
    }

    return $bean;
}

function create(object $classEntity, string $table)
{
    $bean = R::dispense($table);
    $obj = getBeanEntity($classEntity, $bean);
    $id = R::store($obj);

    return $id;
}

function update(object $classEntity, string $table)
{
    $bean = R::load($table, $entity->id);
    $obj = getBeanEntity($classEntity, $bean);

    $id = R::store($obj);

    return $id;
}

function delete(int $id, string $table)
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
