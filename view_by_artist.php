<?php

use Libs\Helpers\Auth;

    include('./vendor/autoload.php');

    $currentUser = Auth::check();

?>
<?php 
    include("./templates/head.php");
?>
<title><?= $_GET['artist'] ?></title>
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
                <a href="./land.php" class="text-decoration-none text-secondary sidebar-link active" id="land_sidebar"><i class="fas fa-music me-2"></i> All songs</a>
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
        <div class="contentArea"  data-barba="container" data-barba-namespace="view_by_artist">
        <div class="transitions"></div>
            <nav class="music_nav_playlist">
                <div class="d-flex align-items-center">
                    <a href="./land.php" class="backbtn text-decoration-none back-to-playlist me-3"><i class="fa-solid fa-chevron-left text-light"></i></a>
                    <h5 class="text text-light mb-0"><?=$_GET['artist'] ?></h5>
                </div>
                <div class="nav_menus">
                    <p class="profile text-white mb-0">Initiate</p>
                </div>
            </nav>
            <div class="favorites_song_container">
                <div class="favorite_lists" id="view_by_artist">
                
                </div>
            </div>
        </div>
    </section>

<?php 
    include("./templates/footer.php");
?>
<?php 
    include("./templates/foot.php");
?>