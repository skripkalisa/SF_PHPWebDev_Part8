<?php
namespace App\views\auth\utils;

use App\ViewModels\UserVM;
use App\data;

class HandleAuth
{
    public static function register(array $data)
    {
        $entity = new \stdClass();

        $entity->username = self::testInput($data['username']);
        $entity->email = self::testInput($data['email']);
        $entity->password = password_hash(self::testInput($data['password']), PASSWORD_ARGON2ID);
        $entity->token = md5(self::testInput($data['email']). SECRET_WORD);

        return $entity;
    }
    
    public static function login(array $data)
    {
        $user = data\getUserByToken(self::getToken(self::testInput($data['email'])));
        
        if (!empty($user)) {
            self::setLoginStatus($user->export());
            self::setUserCookie();
        }
        return $user;
    }
    
    public static function getLoginStatus()
    {
        if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
            return true;
        }
        return false;
    }
    
    public static function isAdmin()
    {
        if (self::getLoginStatus() && $_SESSION["id"]<=2) {
            return true;
        }
        return false;
    }
    
    private static function getToken(string $email)
    {
        return md5(self::testInput($email).SECRET_WORD);
    }
    
    private static function isEmailAlreadyExists(string $email)
    {
        $token = self::getToken(self::testInput($email));
        
        if (data\getUserByToken($token)) {
            return true;
        }
        return false;
    }
    
    private function setLoginStatus(array $data)
    {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = self::testInput($data['username']);
        $_SESSION['token'] = self::testInput($data['token']);
        $_SESSION['id'] = self::testInput($data['id']);
    }
    
    private static function setUserCookie()
    {
        if (isset($_POST["remember"])) {
            setcookie(
                'login',
                $_SESSION['token'],
                [
                    'expires' => time() + 60*60*24*30,
                    'SameSite'=>'Lax']
            );
        }
    }
    
    private static function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
