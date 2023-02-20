<?php 
include('../vendor/autoload.php');

use Libs\Database\UsersTable;
use Libs\Database\MySQL;

$error_status = 0;
$errors = [];

if(isset($_POST['name'])) {
    $userTable = new UsersTable(new MySQL());

    $name = '';
    $email = '';

    $temp_name = trim($_POST['name']);
    $temp_email = trim($_POST['email']);

    if(empty($temp_name)) {
        $error_status = 1;
        $errors['name'] = 'Username is required';
    } else if(strlen($temp_name) < 3) {
        $error_status = 1;
        $errors['name'] = 'Username must be at least 3 letters';
    } else if(strlen($temp_name) > 20) {
        $error_status = 1;
        $errors['name'] = 'Username must not be longer than 20 letters';
    } else if(!preg_match("/^[a-zA-Z ]*$/", $temp_name)) {
        $error_status = 1;
        $errors['name'] = 'Username can\'t contain numeric characters';
    } else {
        $name = $temp_name;
    }

    if(empty($temp_email)) {
        $error_status = 1;
        $errors['email'] = 'Email is empty';
    } else if(!filter_var($temp_email, FILTER_VALIDATE_EMAIL)) {
        $error_status = 1;
        $errors['email'] = 'Email must be a valid value';
    } else if ($userTable->validateEmail($temp_email)) {
        $error_status = 1;
        $errors['email'] = 'This email is alreay exist';
    }else {
        $email = $temp_email;
    }

    if(!$error_status) {
        $result = $userTable->changeProfile([
            'name' => $name,
            'email' => $email
        ]);
        if($result) {
            $_SESSION['auth']['name'] = $name; 
            $_SESSION['auth']['email'] = $email;
            echo json_encode([
                'status' => 200,
                'message' => 'Profile updated successfully'
            ]);
        } else {
            echo json_encode([
                'status' => 500,
                'message' => 'Something went wrong. try again',
                'data' => $result
            ]);
        }
    } else {
        echo json_encode([
            'status' => 400,
            'message' => 'Validation error',
            'errors' => $errors
        ]);
    }
}
