<?php

namespace App\views\auth\utils;

use App\data;

class Validate
{
    private static $errors = [];

    public static function required(?string $val)
    {
        if (empty($val)) {
            return 'This field is required.';
        }
        return ;
    }

    public static function name(string $name)
    {
        if (!preg_match("/^[a-zA-Zа-яА-ЯЁё]*$/u", self::testInput($name))) {
            return  "Only letters allowed";
        }
        return ;
    }

    public static function email(string $email)
    {
        if (!filter_var(self::testInput($email), FILTER_VALIDATE_EMAIL)) {
            return 'Invalid email format';
        }
        return ;
    }

    public static function password(string $password)
    {
        if (!preg_match(PASSWORD_REGEXP, self::testInput($password))) {
            return "Password must be at least 8 characters long, contain at least one lowercase letter, one uppercase letter, one number and one special character";
        }
        return ;
    }
    

    public static function confirmPassword(string $password, string $confirmPassword)
    {
        if (self::testInput($password) !== self::testInput($confirmPassword)) {
            return 'Passwords do not match.';
        }
        return ;
    }
    public static function isUnique(string $table, string $field, string $value)
    {
        if (data\getByProp($table, $field, self::testInput($value))) {
            return 'This ' . $field . ' is already taken.';
        }
        return;
    }

    public static function role(string $role)
    {
        if (!in_array($role, ['merchant', 'webmaster'])) {
            return 'Invalid role';
        }
        return ;
    }


    public static function number(string $val)
    {
        if (!is_numeric($val)) {
            return 'This field must be a number.';
        }
        return ;
    }


    public static function creditCardNumber(string $number)
    {
        if (!preg_match("/^[0-9]{16}$/", self::testInput($number))) {
            return 'Invalid credit card number';
        }
        // elseif (!self::luhn(self::testInput($number))) {
        //     return 'Invalid credit card number';
        // }
        return ;
    }


    public static function errors(array $errors)
    {
        foreach ($errors as $key => $error) {
            $error = array_filter($error);
            if (empty(array_values($error))) {
                unset($errors[$key]);
            }
        }
        return array_values($errors);
    }

    private static function luhn(string $number)
    {
        $sum = 0;
        $numLength = strlen($number);
        for ($i = 0; $i < $numLength; $i++) {
            $digit = $number[$i];
            if ($i % 2 == 1) {
                $digit *= 2;
                if ($digit > 9) {
                    $digit -= 9;
                }
            }
            $sum += $digit;
        }
        return ($sum % 10 == 0);
    }


    private static function testInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
