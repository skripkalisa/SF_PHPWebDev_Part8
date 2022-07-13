<?php

namespace App\views\auth\utils;

function validateRegForm(array $request)
{
    $entity = new \stdClass();
    $errors = [];


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"]) && $_POST["token"] == $_SESSION["CSRF"]) {
        if (empty($_POST["username"])) {
            $errors[]['username'] = "First Name Field is required";
        } else {
            $entity->username = test_input($_POST["username"]);
            if (!preg_match("/^[a-zA-Zа-яА-ЯЁё]*$/u", $entity->username)) {
                $errors[]['username'] = "Only letters allowed";
            }
        }

        // if (empty($_POST["lastname"])) {
        //     $errors[]['lastname'] = "Last Name Field is required";
        // } else {
        //     $entity->lastname = test_input($_POST["lastname"]);
        //     if (!preg_match("/^[a-zA-Zа-яА-ЯЁё]*$/u", $entity->lastname)) {
        //         $errors[]['lastname'] = "Only letters allowed";
        //     }
        // }
        if (empty($_POST["email"])) {
            $errors[]['email'] = "Email field is required";
        } else {
            $entity->email = test_input($_POST["email"]);
            if (!filter_var($entity->email, FILTER_VALIDATE_EMAIL)) {
                $errors[]['email'] = "Invalid email format";
            }
            if (isEmailAlreadyExists($entity->email)) {
                $errors[]['email'] = "Email already exists";
            }
        }
    
        if (empty($_POST["password"])) {
            $errors[]['password'] = "Password field is required";
        } else {
            $entity->password = test_input($_POST["password"]);
            if (!preg_match(PASSWORD_REGEXP, $entity->password)) {
                $errors[]['password'] = "Password must be at least 8 characters long, contain at least one lowercase letter, one uppercase letter, one number and one special character";
            }
        }
    
        if (empty($_POST["password2"]) || $_POST["password"] != $_POST["password2"]) {
            $errors[]['password2'] = "Passwords do not match";
        } else {
            $password2 = test_input($_POST["password2"]);
        }
        
        // if (empty($_POST["role"])) {
        //     $errors[]['role'] = "Role field is required";
        // } else {
        //     $entity->role = test_input($_POST["role"]);

        //     if (!Roles::isValidValue($entity->role)) {
        //         $errors[]['role'] = "Invalid role";
        //     }
        // }
    }
    return $errors;
}

function validateLoginForm(array $request)
{
    $entity = new \stdClass();
    $errors = [];


    if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["token"]) && $_POST["token"] == $_SESSION["CSRF"]) {

        // Check if email is empty
        if (empty(test_input($_POST["email"]))) {
            $errors[]['email'] = "Please enter email";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $errors[]['email'] = "Please enter a valid email";
        } else {
            $entity->email = test_input($_POST["email"]);
        }
        // Check if password is empty
        if (empty(test_input($_POST["password"]))) {
            $errors[]['password'] = "Please enter your password.";
        } else {
            $entity->password = test_input($_POST["password"]);
        }
    }
    return $errors;
}

function validate(array $request)
{
    $errors = [];
    // global $errors;
    if (!isset($request['email']) || strlen($request['email']) == 0) {
        $errors[]['email'] = 'Email не указан';
    } elseif (!filter_var($request['email'], FILTER_VALIDATE_EMAIL)) {
        $errors[]['email'] = 'Неправильный формат email';
    } elseif (strlen($request['email']) < 4) {
        $errors[]['email'] = 'Email должен быть больше 4х символов';
    } elseif (isEmailAlreadyExists($request['email'])) {
        $errors[]['email'] = 'Email уже используется';
    }
    if (!isset($request['firstname']) || empty($request['firstname'])) {
        $errors[]['firstname'] = 'Имя не указано';
    }
    if (!isset($request['lastname']) || empty($request['lastname'])) {
        $errors[]['lastname'] = 'Lastname не указано';
    }
    if (!isset($request['password']) || empty($request['password'])) {
        $errors[]['password'] = 'Пароль не указан';
    }
    if (!isset($request['password2']) || empty($request['password2'])) {
        $errors[]['password2'] = 'Нужно повторить пароль';
    } elseif ((isset($request['password']) && isset($request['password2'])) && ($request['password'] != $request['password2'])) {
        $errors[]['password2'] = 'Пароли не совпадают';
    }
    if (!isset($request['role']) || empty($request['role'])) {
        $errors[]['role'] = 'Role не указан';
    }

    return $errors;
}
