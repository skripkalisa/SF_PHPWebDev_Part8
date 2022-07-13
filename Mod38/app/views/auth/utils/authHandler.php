<?php
namespace App\views\auth\utils;

include_once VIEW.'auth/utils/formHandler.php';
include_once VIEW.'auth/utils/validate.php';


use App\models\entities\User;

if ($payload && $payload[1]) {
    switch ($payload[1]) {
        case 'register':
            handleRegistration();
            break;
        case 'login':
            handleLogin();
            break;

        default:
            // header('location: /');
            http_response_code(500);
            echo json_encode([
            'success' => false,
            'errors' => 'Something went wrong. Server or database error.',
        ]);
            exit();

            break;
    }
}


function handleRegistration()
{
    if (!empty($_POST)) {
        header('Content-Type: application/json');

        $errors = validateRegForm($_POST);
        // var_dump($errors);

        if (empty($errors)) {
            if (register($_POST)) {
                http_response_code(201);
                $userVM = register($_POST);
                $user = new User($userVM);
                // $user->dropTable('users');
                $userId = \App\data\create($user, 'users');
                
                echo json_encode([
                    'success' => true,
                    'status' => 'registered',
                ]);
                exit();
            }
            http_response_code(500);
            echo json_encode([
            'success' => false,
            'errors' => 'Something went wrong. Server or database error.',
        ]);
            exit();
        }
    
        http_response_code(422);
    
        echo json_encode([
        'success' => false,
        'errors' => $errors,
    ]);
        exit();
    }
}


function handleLogin()
{
    if (!empty($_POST)) {
        header('Content-Type: application/json');

        $errors = validateLoginForm($_POST);

        if (empty($errors)) {
            if (login($_POST)) {
                http_response_code(201);
                
                echo json_encode([
                    'success' => true,
                    'status' => 'logged in',
                ]);
                exit();
            }
            http_response_code(500);
            echo json_encode([
            'success' => false,
            'errors' => 'Something went wrong. Server or database error.',
        ]);
            exit();
        }
    
        http_response_code(422);
    
        echo json_encode([
        'success' => false,
        'errors' => $errors,
    ]);
        exit();
    }
}
