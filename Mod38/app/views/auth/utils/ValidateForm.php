<?php

namespace App\views\auth\utils;

class ValidateForm
{
    public static function register(array $request)
    {
        $errors = [];
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($request["token"]) && $request["token"] == $_SESSION["CSRF"]) {
            $errors[]['username'] =
                Validate::required($request["username"]) ??
                Validate::name($request["username"]) ??
                Validate::isUnique('users', 'username', $request["username"]);
                
            $errors[]['email'] =
                Validate::required($request["email"]) ??
                Validate::email($request["email"]) ??
                Validate::isUnique('users', 'email', $request["email"]);
    
            $errors[]['password'] =
                Validate::required($request["password"]) ??
                Validate::password($request["password"]);
    
            $errors[]['password2'] =
                Validate::required($request["password2"]) ??
                Validate::confirmPassword($request["password"], $request["password2"]);
        }
    
        return Validate::errors($errors);
    }
    
    public static function login(array $request)
    {
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($request["token"]) && $request["token"] == $_SESSION["CSRF"]) {
            $errors[]['email'] =
                Validate::required($request["email"]) ??
                Validate::email($request["email"]);
    
            $errors[]['password'] =
                Validate::required($request["password"]) ??
                Validate::password($request["password"]);
        }
        return Validate::errors($errors);
    }
    
    public static function profile(array $request)
    {
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($request["token"]) && $request["token"] == $_SESSION["CSRF"]) {
            $errors[]['firstname'] =
                Validate::required($request["firstname"]) ??
                Validate::name($request["firstname"]);
            $errors[]['lastname'] =
                Validate::required($request["lastname"]) ??
                Validate::name($request["lastname"]);
            $errors[]['role'] =
                Validate::required($request["role"]) ;
        }
    
        
        return Validate::errors($errors);
    }

    public static function account(array $request)
    {
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($request["token"]) && $request["token"] == $_SESSION["CSRF"]) {
            $errors[]['account_name'] =
                Validate::name($request["account_name"]);


            $errors[]['balance'] =
                Validate::number($request["balance"]) ;
        }
    
        return Validate::errors($errors);
    }

    public static function card(array $request)
    {
        $errors = [];
    
        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($request["token"]) && $request["token"] == $_SESSION["CSRF"]) {
            $errors[]['card_name'] =
                Validate::name($request["card_name"]);

            $errors[]['credit_card_number'] =
                Validate::required($request["credit_card_number"]) ??
                Validate::creditCardNumber($request["credit_card_number"]);

            $errors[]['limit'] =
                Validate::number($request["limit"]) ;
        }
    
        return Validate::errors($errors);
    }
}
