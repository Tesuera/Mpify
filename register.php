<?php
    include('./config_register.php');
    use Libs\Helpers\Auth;
    include('./_actions/registering.php');

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
    <div class="register_container">
        <?php if(isset($_GET['email_exist'])): ?>
            <div class="email_exist_info">
                <p class="email_exist_content mb-0">this email already exists.</p>
            </div>
        <?php endif ?>
        <div class="register_logo">
            <a href="" class="text-decoration-none"><h2 class="register_logo_content">Mpify</h2></a>
        </div>
        <div class="register_left">
            <div class="signup_form">
                <a href="<?php echo $google_client->createAuthUrl() ?>" class="text-decoration-none"><h2 class="text-light mb-4">Sign up <small class="with_google text-primary">with google</small></h2></a>
                <form action="./register.php" method="post" class="w-100">
                    <div class="position-relative w-100">
                        <input type="text" class="input_auth" name="name" placeholder="Username" value="<?php echo ($error_status)? $_POST['name'] : '' ?>">
                        <?php if(isset($errors['name'])): ?>
                            <div class="error_container position-absolute">
                                <small class="error_message text-danger mb-0 text-light">- <span class="text-danger"><?= $errors['name'] ?></span></small>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="position-relative w-100">
                        <input type="text" class="input_auth" name="email" placeholder="Email"  value="<?php echo ($error_status)? $_POST['email'] : '' ?>">
                        <?php if(isset($errors['email'])): ?>
                            <div class="error_container position-absolute">
                                <small class="error_message text-danger mb-0 text-light">- <span class="text-danger"><?= $errors['email'] ?></span></small>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="position-relative w-100">
                        <input type="text" class="input_auth" name="password" placeholder="Password">
                        <?php if(isset($errors['password'])): ?>
                            <div class="error_container position-absolute">
                                <small class="error_message text-danger mb-0 text-light">- <span class="text-danger"><?= $errors['password'] ?></span></small>
                            </div>
                        <?php endif ?>
                    </div>
                    <div class="position-relative w-100">
                        <input type="text" class="input_auth" name="password_confirmation" placeholder="Confirm password">
                        <?php if(isset($errors['password_confirmation'])): ?>
                            <div class="error_container position-absolute">
                                <small class="error_message text-danger mb-0 text-light">- <span class="text-danger"><?= $errors['password_confirmation'] ?></span></small>
                            </div>
                        <?php endif ?>
                    </div>
                    <a class="redirect_to_login " href="./login.php">Aready have an account?</a>
                    <button class="auth_btn mx-auto d-block btn btn-primary btn-sm w-50 mt-3 rounded-pill">Create</button>
                </form>
            </div>
        </div>

        <div class="register_right">
            <img src="./assets/defaults/headphones.jpg" class="register_png" alt="">
            <div class="register_overlay"></div>
            <div class="right_overlay_trans"></div>
            <div class="register_left_content">
               <h1 class="intro_header text-light mb-4 display-4">LISTEN TO YOUR MUSIC THEN RELAX IN PEACE ...</h1>
               <a href="./" class="btn btn-outline-primary">Land</a>
            </div>
        </div>
    </div>

<script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>