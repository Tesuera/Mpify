<!-- <?php

// use Libs\Helpers\Auth;

//     include('./vendor/autoload.php');

//     $currentUser = Auth::check();

use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;
use Libs\Database\PlaylistsTable;

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
                <a href="./playlist.php" class="text-decoration-none text-secondary sidebar-link active" id="playlist_sidebar"><i class="fa-solid fa-list me-2"></i> Playlists</a>
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
                <a href="#" class="text-decoration-none text-secondary sidebar-link" id="land_sidebar"><i class="fa-regular fa-comment-dots me-2"></i>Feedback</a>
            </li>
        </ul>
    </div>
        <?php
            include("./components/audioelement.php");
        ?>
        <div class="contentArea"  data-barba="container" data-barba-namespace="playlists">
        <div class="transitions"></div>
            <nav class="music_nav_playlist">
                <div class="d-flex align-items-center">
                    <h5 class="text text-light mb-0">Playlists</h5>
                </div>
                
                <div class="nav_menus">
                    <p class="profile text-white mb-0">Initiate</p>
                </div>
            </nav>
            <div class="allplayLists">
                <a href="./create_playlist.php" class="createplaylists text-decoration-none">
                    <div class="plus_playlists">
                        <i class="fas fa-plus"></i>
                    </div>
                    <p class="playlists_create mb-0">Create new</p>
                </a>
                <div class="playLists" id="playlist_container">
            
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