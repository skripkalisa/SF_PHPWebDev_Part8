<?php
namespace App\views\auth\utils;

use App\models\entities\User;

if ($payload && $payload[1]) {
    switch ($payload[1]) {
        case 'register':
            handler('register');
            break;
        case 'login':
            handler('login');
            break;
        case 'profile':
            handler('profile');
            break;
        case 'account':
            handler('account');
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


function handler(string $action)
{
    if (!empty($_POST)) {
        header('Content-Type: application/json');

        $errors = ValidateForm::$action($_POST);

        if (empty($errors)) {
            Handle::$action();
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
