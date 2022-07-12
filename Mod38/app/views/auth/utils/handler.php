<?php

include_once VIEW.'auth/utils/formHandler.php';
// include_once MODEL . 'entities/User.php';

use App\models\entities\User;

if (!empty($_POST)) {
    header('Content-Type: application/json');

    $errors = regForm($_POST);
    // var_dump($errors);

    if (empty($errors)) {
        if (register($_POST)) {
            http_response_code(201);
            $userVM = register($_POST);
            
          
            $user = new User($userVM);
            $user->dropTable('users');
            // $user->save();
            $userId = App\data\create($user, 'users');
            // $user->getThisUser();
            echo json_encode([
                'success' => true,
                'userId'    => $userId,
                // 'entity' => $userVM,
                // 'values' => $user->getClassValues(),
                // 'keys' => $user->getClassKeys(),
            ]);
            exit();
        }
        http_response_code(500);
        echo json_encode([
            'success' => false,
            // 'success' => false,
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
