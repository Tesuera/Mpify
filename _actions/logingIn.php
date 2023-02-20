<?php 
    use Libs\Database\UsersTable;
    use Libs\Database\MySQL;
    use Libs\Helpers\Auth;
    use Libs\Helpers\HTTP;


    $userTable = new UsersTable(new MySQL());

    $error_status = 0;
    $errors = [];


    if(isset($_POST['username_or_email'])) {
        $username_or_email = '';
        $password = '';

        $temp_username_or_email = trim($_POST['username_or_email']);
        $temp_password = trim($_POST['password']);

        if(empty($temp_username_or_email)) {
            $error_status = 1;
            $errors['username_or_email'] = 'Required username or email';
        } else {
            $username_or_email = $temp_username_or_email;
        }

        if(empty($temp_password)) {
            $error_status = 1;
            $errors['password'] = 'Password is required';
        } else if(strlen($temp_password) < 8) {
            $error_status = 1;
            $errors['password'] = 'Password must be at least 8 characters';
        } else {
            $password = $temp_password;
        }

        if(!$error_status) {
            $userTable = new UsersTable(new MySQL());
            $result = $userTable->login($username_or_email, $password);
            if(isset($result->name)) {
                Auth::attempt([
                    'id' => $result->id,
                    'name' => $result->name,
                    'email' => $result->email,
                    'role' => $result->role
                ]);
                HTTP::redirect('land.php');
            } else {
                $error_status = 1;
                $errors['password'] = 'incorrect username, email or password';
            }
        }
    }
?>