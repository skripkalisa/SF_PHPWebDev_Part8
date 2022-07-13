<?php

namespace App\views\dashboard\utils;

function validateProfileForm(array $request)
{
    $entity = new \stdClass();
    $errors = [];


    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"]) && $_POST["token"] == $_SESSION["CSRF"]) {
        if (empty($_POST["firstname"])) {
            $errors[]['firstname'] = "First Name Field is required";
        } else {
            $entity->username = test_input($_POST["firstname"]);
            if (!preg_match(NAME_REGEXP, $entity->firstname)) {
                $errors[]['firstname'] = "Only letters allowed";
            }
        }

        if (empty($_POST["lastname"])) {
            $errors[]['lastname'] = "Last Name Field is required";
        } else {
            $entity->lastname = test_input($_POST["lastname"]);
            if (!preg_match(NAME_REGEXP, $entity->lastname)) {
                $errors[]['lastname'] = "Only letters allowed";
            }
        }

        if (empty($_POST["role"])) {
            $errors[]['role'] = "Role field is required";
        } else {
            $entity->role = test_input($_POST["role"]);

            if (!Roles::isValidValue($entity->role)) {
                $errors[]['role'] = "Invalid role";
            }
        }
    }
    return $errors;
}
