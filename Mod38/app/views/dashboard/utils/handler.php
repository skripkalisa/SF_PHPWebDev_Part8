<?php
namespace App\views\dashboard\utils;

// include_once VIEW.'auth/utils/formHandler.php';
// include_once VIEW.'auth/utils/validate.php';


use App\models\entities\User;

if ($payload && $payload[1]) {
    switch ($payload[1]) {
        case 'profile':

            handleProfile();
            break;
        case 'account':

            handleAccount();
            break;

        default:
            // header('location: /');
            http_response_code(500);
            echo json_encode([
            'success' => false,
            'errors' => 'Something went wrong. Server or database error.',
        ]);
            break;
    }
}


function handleProfile()
{
    if (!empty($_POST)) {
        header('Content-Type: application/json');

        $errors = validateProfileForm($_POST);
        // var_dump($errors);

        if (empty($errors)) {
            if (updateProfile($_POST)) {
                http_response_code(201);
                $profileVM = updateProfile($_POST);
                $user = new User($userVM);
                // $user->dropTable('users');
                $userId = \App\data\update($user, 'users');

                echo json_encode([
                    'success' => true,
                    'status' => 'updated',
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
    }
}

function handleAccount()
{
    if (!empty($_POST)) {
        header('Content-Type: application/json');

        $errors = validateAccountForm($_POST);
        // var_dump($errors);

        if (empty($errors)) {
            if (updateAccount($_POST)) {
                http_response_code(201);
                $userVM = updateAccount($_POST);
                $user = new User($userVM);
                // $user->dropTable('users');
                $userId = \App\data\update($user, 'users');

                echo json_encode([
                    'success' => true,
                    'status' => 'updated',
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
    }
}
