<?php
// namespace App;

include_once MODEL . 'entities/role.php';

// password_hash($data['password'], PASSWORD_ARGON2ID);
use App\Models\Entities\Roles;
// use App\Models\Entities\User;
use App\ViewModels\UserVM;

function regForm(array $request)
{
    $entity = new stdClass();
    $errors = [];
    $passwordRegExp = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["token"]) && $_POST["token"] == $_SESSION["CSRF"]) {
        if (empty($_POST["firstname"])) {
            $errors[]['firstname'] = "First Name Field is required";
        } else {
            $entity->firstname = test_input($_POST["firstname"]);
            if (!preg_match("/^[a-zA-Zа-яА-ЯЁё]*$/u", $entity->firstname)) {
                $errors[]['firstname'] = "Only letters allowed";
            }
        }

        if (empty($_POST["lastname"])) {
            $errors[]['lastname'] = "Last Name Field is required";
        } else {
            $entity->lastname = test_input($_POST["lastname"]);
            if (!preg_match("/^[a-zA-Zа-яА-ЯЁё]*$/u", $entity->lastname)) {
                $errors[]['lastname'] = "Only letters allowed";
            }
        }
        if (empty($_POST["email"])) {
            $errors[]['email'] = "Email field is required";
        } else {
            $entity->email = test_input($_POST["email"]);
            if (!filter_var($entity->email, FILTER_VALIDATE_EMAIL)) {
                $errors[]['email'] = "Invalid email format";
            }
            if (App\data\getUserByToken(md5($entity->email. SECRET_WORD))) {
                $errors[]['email'] = "Email already exists";
            }
        }
    
        if (empty($_POST["password"])) {
            $errors[]['password'] = "Password field is required";
        } else {
            $entity->password = test_input($_POST["password"]);
            if (!preg_match($passwordRegExp, $entity->password)) {
                $errors[]['password'] = "Password must be at least 8 characters long, contain at least one lowercase letter, one uppercase letter, one number and one special character";
            }
        }
    
        if (empty($_POST["password2"]) || $_POST["password"] != $_POST["password2"]) {
            $errors[]['password2'] = "Passwords do not match";
        } else {
            $password2 = test_input($_POST["password2"]);
            // if (!preg_match($passwordRegExp, $password2)) {
            //     $pass2Err = "Password must be at least 8 characters long, contain at least one lowercase letter, one uppercase letter, one number and one special character";
            // }
        }
        
        if (empty($_POST["role"])) {
            $errors[]['role'] = "Role field is required";
        } else {
            $entity->role = test_input($_POST["role"]);
            // (var_dump($_POST["role"]));
            if (!Roles::isValidValue($entity->role)) {
                $errors[]['role'] = "Invalid role";
            }
        }
    }
    return $errors;
}


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
    // $userVM->firstname = $data['firstname'];
    // $userVM->lastname = $data['lastname'];
    // $userVM->email = $data['email'];
    // $userVM->password = password_hash($data['password'], PASSWORD_ARGON2ID);
    // $userVM->role = $data['role'];
    // $userVM->token = md5($data['email'].SECRET_WORD);

    $values = [
        'firstname'=> $data['firstname'],
        'lastname'=> $data['lastname'],
        'email'=>$data['email'],
        'password'=>password_hash($data['password'], PASSWORD_ARGON2ID),
        'token'=> md5($data['email']. SECRET_WORD),
        'role'=> $data['role'],
    ];
    $userVM = new UserVM($values);
    // $user = new User($userVM);
    return $userVM;
    // return insert($values);
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

function isEmailAlreadyExists(string $email)
{
    if (getUserByEmail($email)) {
        return true;
    }
    return false;
}


// ==================================================


// Define variables and initialize with empty values
// $_SESSION["email_err"] = '';
// $_SESSION["password_err"] = '';


// if (isset($_COOKIE["login"])) {
//     $email_cookie = explode(',', $_COOKIE["login"])[0];
//     $stmt = getUserByEmail($email_cookie);
//     setLoginStatus($stmt);
// }
// if (isset($_COOKIE["vk"])) {
    //     checkCookieVk();
// }
    
    

function login()
{
    $email = $password = "";
    $email_err = $password_err = '';
    // global $email_err , $password_err ;


    if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST["token"]) && $_POST["token"] == $_SESSION["CSRF"]) {
        // Check if email is empty
        if (empty(trim($_POST["email"]))) {
            $email_err = "Please enter email.";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $_SESSION["email_err"] = "Please enter a valid email.";
        } else {
            $email = trim($_POST["email"]);
        }
        // Check if password is empty
        if (empty(trim($_POST["password"]))) {
            $password_err = "Please enter your password.";
        } else {
            $password = trim($_POST["password"]);
            // echo "Password: " . $password ."<br />";
        }
        $_SESSION["email_err"] = $email_err;
        $_SESSION["password_err"] = $password_err;
        // Validate credentials
        if (empty($email_err) && empty($password_err)) {
            // Prepare a select statement
            $stmt = getUserByEmail($email);
            if (!empty($stmt)) {
                setLoginStatus($stmt);
                setUserCookie();
            }
        }
    }
}



function setUserCookie()
{
    if (isset($_POST["remember"])) {
        setcookie(
            'login',
            $_SESSION['email'].','.md5($_SESSION['email'].SECRET_WORD),
            strtotime('+30 days')
        );
    }
}

function setLoginStatus($stmt)
{
    $_SESSION['loggedin'] = true;
    $_SESSION['username'] = $stmt['name'];
    $_SESSION['email'] = $stmt['email'];
    $_SESSION['id'] = $stmt['id'];
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
