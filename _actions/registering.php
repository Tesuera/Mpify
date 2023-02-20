<?php
    use Libs\Database\UsersTable;
    use Libs\Database\MySQL;
    use Libs\Helpers\Auth;
    use Libs\Helpers\HTTP;


    $userTable = new UsersTable(new MySQL());

    $error_status = 0;
    $errors = [];

    if(isset($_POST['name'])) {
        $name = '';
        $email = '';
        $password = '';
        $role = '';

        $temp_name = trim($_POST['name']);
        $temp_email = trim($_POST['email']);
        $temp_password = trim($_POST['password']);
        $temp_password_confirmation = trim($_POST['password_confirmation']);


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
            $errors['email'] = 'Email is required';
        } else if(!filter_var($temp_email, FILTER_VALIDATE_EMAIL)) {
            $error_status = 1;
            $errors['email'] = 'Email must be a valid value';
        } else if ($userTable->checkEmailExists($temp_email)) {
            $error_status = 1;
            $errors['email'] = 'This email is alreay exist';
        }else {
            $email = $temp_email;
        }

        if(empty($temp_password)) {
            $error_status = 1;
            $errors['password'] = 'Password is required';
        } else if(strlen($temp_password) < 8) {
            $error_status = 1;
            $errors['password'] = 'Password must be at least 8 characters';
        } else if(strlen($temp_password) > 20) {
            $error_status = 1;
            $errors['password'] = 'Password must not be longer than 20 characters';
        } else if(!preg_match('/^[a-zA-Z0-9 ]*$/', $temp_password)) {
            $error_status = 1;
            $errors['password'] = 'Password must be character numeric';
        } else {
            $password = $temp_password;
        }

        if(empty($temp_password_confirmation)) {
            $error_status = 1;
            $errors['password_confirmation'] = 'Confirm password is required';
        } else if($temp_password_confirmation !== $temp_password) {
            $error_status = 1;
            $errors['password_confirmation'] = 'Password confirmation doesn\'t match';
        }

        if(!$error_status) {
            $role = 'member';
            $user = $userTable->register([
                'name' => $name,
                'email' => $email,
                'password' => password_hash($password, PASSWORD_DEFAULT),
                'role' => $role
            ]);

            Auth::attempt([
                'id' => $user,
                'name' => $name,
                'email' => $email,
                'role' => $role
            ]);
            HTTP::redirect('land.php');
        }

    }
?>