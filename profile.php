<?php

use Libs\Helpers\Auth;

    include('./vendor/autoload.php');

    $currentUser = Auth::check();

?>
<?php 
    include("./templates/head.php");
?>
<title>Profile</title>
<?php
    include("./templates/header.php");
?>
     
    <?php
        include("./components/sidebarexpand.php");
    ?>
    <section class="concon">
        <div class="sidebar bg-dark">
            <ul class="sidebar-lists ps-0">
                <li class="sidebar-item">
                    <a href="./land.php" class="text-decoration-none text-secondary sidebar-link" id="land_sidebar"><i class="fas fa-music me-2"></i> All songs</a>
                </li>
                <li class="sidebar-item">
                    <a href="./playlist.php" class="text-decoration-none text-secondary sidebar-link" id="playlist_sidebar"><i class="fa-solid fa-list me-2"></i> Playlists</a>
                </li>
                <li class="sidebar-item">
                    <a href="./favorites.php" class="text-decoration-none text-secondary sidebar-link" id="favorites_sidebar"><i class="fa-regular fa-heart me-2"></i> Favorites</a>
                </li>
                <li class="sidebar-item">
                    <a href="./new_song.php" class="text-decoration-none text-secondary sidebar-link" id="new_song_sidebar"><i class="fa-solid fa-compact-disc me-2"></i>Add new</a>
                </li>
                <li class="sidebar-item">
                    <a href="./setting.php" class="text-decoration-none text-secondary sidebar-link" id="setting_sidebar"><i class="fa-solid fa-gear me-2"></i>Settings</a>
                </li>
                <li class="sidebar-item">
                    <a href="./recent.php" class="text-decoration-none text-secondary sidebar-link" id="recent_sidebar"><i class="fa-regular fa-clock me-2"></i>Recently Played</a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="text-decoration-none text-secondary sidebar-link" id="feedback_sidebar"><i class="fa-regular fa-comment-dots me-2"></i>Feedback</a>
                </li>
            </ul>
        </div>
        <?php
            include("./components/audioelement.php");
        ?>
        <div class="contentArea"  data-barba="container" data-barba-namespace="profile">
            <div class="transitions"></div>
            <nav class="music_nav_playlist">
                <div class="d-flex align-items-center">
                    <h5 class="ms-2 text text-light mb-0">Personal infomation</h5>
                </div>
                <div class="nav_menus">
                    <p class="profile text-white mb-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><?= $_SESSION['auth']['name'] ?></p>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="./change_password.php">Change password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.querySelector('#logoutform').submit()">Log out</a></li>
                        <form action="./logout.php" method="post" id="logoutform"></form>
                    </ul>
                </div>
            </nav>
            <div class="profile_container">
                <ul class="list-group my-3">
                    <li class="list-group-item list_personal">
                        <span>Name</span>
                        <span><?= $_SESSION['auth']['name'] ?></span>
                    </li>
                    <li class="list-group-item list_personal">
                        <span>Email</span>
                        <span><?= $_SESSION['auth']['email'] ?></span>
                    </li>
                </ul>
                <ul class="list-group mb-3">
                    <li class="list-group-item list_personal">
                        <span>Role</span>
                        <span><?= $_SESSION['auth']['role'] ?></span>
                    </li>
                </ul>
                <?php if(!isset($_SESSION['auth']['google_id'])): ?>
                    <div class="d-flex justify-content-end">
                        <a href="./edit_personal_info.php" class="btn btn-primary btn-sm">Change info</a>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </section>
<?php 
    include("./templates/footer.php");
?>
<?php 
    include("./templates/foot.php");
?>