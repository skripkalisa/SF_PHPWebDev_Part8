<?php

namespace App\views\auth\utils;

use App\data;

class HandleData
{
    public static function createProfile(array $data)
    {
        $entity = new \stdClass();
        $entity->userId = $_SESSION["id"];
        $entity->firstName = self::testInput($data['firstname']);
        $entity->lastName = self::testInput($data['lastname']);
        $entity->role = self::testInput($data['role']);

        return $entity;
    }
    public static function editProfile(array $data)
    {
    }
    public static function deleteProfile(array $data)
    {
    }
    public static function createAccount(array $data)
    {
        $entity = new \stdClass();

        $entity->name = self::testInput($data['account_name']);
        $entity->balance = self::testInput($data['balance']);
        $entity->userId = $_SESSION["id"];
        $entity->profileId = HandleData::getProfile()->id;

        return $entity;
    }
    public static function editAccount(array $data)
    {
    }
    public static function deleteAccount(array $data)
    {
    }

    public static function createCard(array $data)
    {
        $entity = new \stdClass();

        $entity->name = self::testInput($data['account_name']);
        $entity->card = self::testInput($data['credit_card_number']);
        $entity->limit = self::testInput($data['limit']);

        return $entity;
    }
    public static function editCard(array $data)
    {
    }
    public static function deleteCard(array $data)
    {
    }
    public static function getProfile()
    {
        return data\getByProp('profiles', 'user_id', $_SESSION["id"]);
    }
    public static function getAccount()
    {
        return data\getByProp('accounts', 'user_id', $_SESSION["id"]);
    }

    private static function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
