<?php
namespace App\views\auth\utils;

use App\ViewModels\UserVM;
use App\data;

function test_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}



// ##################################################`


function register(array $data)
{
    $values = [
        'username'=> $data['username'],
        'email'=>$data['email'],
        'password'=>password_hash($data['password'], PASSWORD_ARGON2ID),
        'token'=> md5($data['email']. SECRET_WORD),

    ];
    $userVM = new UserVM($values);
    return $userVM;
}



function getToken(string $email)
{
    return md5($email.SECRET_WORD);
}

function isEmailAlreadyExists(string $email)
{
    $token = getToken($email);

    if (data\getUserByToken($token)) {
        return true;
    }
    return false;
}


// ==================================================


    

function login(array $data)
{
    $user = data\getUserByToken(getToken($data['email']));

    if (!empty($user)) {
        setLoginStatus($user->export());
        setUserCookie();
    }
    return $user;
}



function setUserCookie()
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

function setLoginStatus(array $data)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $data['username'];
    $_SESSION['token'] = $data['token'];
    $_SESSION['id'] = $data['id'];
}


function getLoginStatus()
{
    if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
        return true;
    }
    return false;
}


function isAdmin()
{
    if (getLoginStatus() && $_SESSION["id"]<=2) {
        return true;
    }
    return false;
}
