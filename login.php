<?php
    include('./config_login.php');
    use Libs\Helpers\Auth;
    include('./_actions/logingIn.php');

    Auth::issetAuth();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="scss/style.css" />
    <link rel="stylesheet" href="scss/app.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>
<body class="bg-dark">
    <div class="login_logo">
        <a href="" class="text-decoration-none"><h2 class="register_logo_content">Mpify</h2></a>
    </div>
    <div class="register_container">
        <?php if(isset($_GET['user_not_found'])): ?>
            <div class="email_exist_info">
                <p class="email_exist_content mb-0">User not found.</p>
            </div>
        <?php endif ?>
        <div class="login_left">
            <img src="./assets/defaults/login.jpg" class="register_png" alt="">
            <div class="register_overlay"></div>
            <div class="left_overlay_trans"></div>
            <div class="login_left_content">
                <h1 class="intro_header text-light mb-4 display-4">SPREAD THE TUNES WITH SOME BRILLIANT QUALITY ...</h1>
                <a href="./" class="btn btn-outline-primary">Land</a>
            </div>
        </div>
           
        <div class="login_right">
            <div class="login_form">
                <a href="<?php echo $google_client->createAuthUrl() ?>" class="text-decoration-none"><h2 class="text-light mb-4">Log In <small class="with_google text-primary">with google</small></h2></a>
                <form action="./login.php" method="post" class="w-100">
                    <div class="position-relative w-100">
                        <input type="text" class="input_auth" name="username_or_email" placeholder="Username or email" value="<?php echo ($error_status)? $_POST['username_or_email'] : '' ?>">
                        <?php if(isset($errors['username_or_email'])): ?>
                            <div class="error_container_login position-absolute">
                                <small class="error_message text-danger mb-0 text-light"><span class="text-danger"><?= $errors['username_or_email'] ?></span> -</small>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="position-relative w-100">
                        <input type="text" class="input_auth" name="password" placeholder="Password">
                        <?php if(isset($errors['password'])): ?>
                            <div class="error_container_login position-absolute">
                                <small class="error_message text-danger mb-0 text-light"><span class="text-danger"><?= $errors['password'] ?></span> -</small>
                            </div>
                        <?php endif ?>
                    </div>
                    <a class="redirect_to_login " href="./register.php">Don't have an account?</a>
                    <button class="auth_btn mx-auto d-block btn btn-primary btn-sm w-50 mt-3 rounded-pill">Log In</button>
                </form>
            </div>
        </div>
    </div>

<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>