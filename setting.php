<!-- <?php

// use Libs\Helpers\Auth;

//     include('./vendor/autoload.php');

//     $currentUser = Auth::check();
?> -->
<?php 
    include("./templates/head.php");
?>
<title>Register</title>
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
                <a href="./setting.php" class="text-decoration-none text-secondary sidebar-link active" id="setting_sidebar"><i class="fa-solid fa-gear me-2"></i>Settings</a>
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
        <div class="contentArea"  data-barba="container" data-barba-namespace="allsongs">
            <div class="transitions"></div>
            <nav class="music_nav">
                <div class="nav_menus">
                    <p class="profile text-white mb-0">Initiate</p>
                </div>
            </nav>
            <div class="setting_container">
                <div class="setting_menu">
                    <div class="each_setting">
                        <div class="theme_left">
                            <i class="fa-solid fa-palette text-white"></i>
                            <span class="text-white-50">Theme Color</span>
                        </div>
                        <div class="theme_color_container">
                            <div class="theme_color_each selected"></div>
                            <div class="theme_color_each"></div>
                            <div class="theme_color_each"></div>
                            <div class="theme_color_each"></div>
                            <div class="theme_color_each"></div>
                        </div>
                    </div>
                    <div class="each_setting">
                        <div class="theme_left">
                            <i class="fa-solid fa-moon text-white"></i>
                            <span class="text-white-50">Dark Mode</span>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" checked type="checkbox" role="switch" id="flexSwitchCheckDefault">
                        </div>
                    </div>
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