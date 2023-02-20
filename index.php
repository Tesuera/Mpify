<?php
    session_start();
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
    <div class="index_logo">
        <a href="" class="text-decoration-none"><h2 class="index_logo_content">mpify</h2></a>
        <?php if(isset($_SESSION['auth'])): ?>
            <p class="profile text-white mb-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['auth']['name'] ?></p>
            <ul class="dropdown-menu dropdown-menu-dark opacity-75 bg-dark">
                <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                <li><a class="dropdown-item" href="./change_password.php">Change password</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.querySelector('#logoutform').submit()">Log out</a></li>
                <form action="./logout.php" method="post" id="logoutform"></form>
            </ul>
        <?php else: ?>
            <a href="./login.php" class="text-decoration-none text-light">Log in</a>
        <?php endif ?>
    </div>
    <div class="land_container">
        <div class="land_top">
            <img src="./assets/defaults/indexpng.jpg" class="land_bg" alt="">
            <div class="index_gradient"></div>
            <div class="index_trans"></div>
            <div class="land_top_content">
                <h1 class="index_header">Stream your Music</h1>
                <p class="index_para">Music is the divine way to tell beautiful, poetic things to the heart. Where words fail, music speaks. Music is forever; music should grow and mature with you, following you right on up until you die.</p>
                <?php if(isset($_SESSION['auth'])): ?>
                    <a href="./land.php" class="index_signup">Feel the tunes</a>
                <?php else: ?>
                    <a href="./register.php" class="index_signup">Become a member</a>
                <?php endif ?>
            </div>
        </div>
    </div>
    <script src="./node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>