<?php

namespace App\views\auth\utils;

use App\models\entities;

class Handle
{
    public static function register()
    {
        if (HandleAuth::register($_POST)) {
            http_response_code(201);
            $resp = HandleAuth::register($_POST);
            $user = new entities\User($resp);
            // $user->dropTable('users');
            $userId = \App\data\create($user, 'users');
                
            echo json_encode([
                    'success' => true,
                    'status' => 'registered',
                ]);
            exit();
        }
    }

    public static function login()
    {
        if (HandleAuth::login($_POST)) {
            http_response_code(201);
                
            echo json_encode([
                    'success' => true,
                    'status' => 'logged in',
                ]);
            exit();
        }
    }
    public static function profile()
    {
        if (HandleData::createProfile($_POST)) {
            http_response_code(201);
            $resp = HandleData::createProfile($_POST);
            $profile = new entities\Profile($resp);
            // \App\data\dropTable('profiles');
            $profileId = \App\data\create($profile, 'profiles');
            $_SESSION["profileId"] = $profileId;
            echo json_encode([
                    'success' => true,
                    'status' => 'profile created',
                ]);
            exit();
        }
    }
    public static function account()
    {
        if (HandleData::createAccount($_POST)) {
            http_response_code(201);
            $resp = HandleData::createAccount($_POST);
            $account = new entities\Account($resp);
            // \App\data\dropTable('accounts');

            $accountId = \App\data\create($account, 'accounts');
            $_SESSION["accountId"] = $accountId;

            echo json_encode([
                    'success' => true,
                    'status' => 'account created',
                ]);
            exit();
        }
    }
}
