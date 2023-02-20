<?php

use Libs\Helpers\Auth;

    include('./vendor/autoload.php');

    $currentUser = Auth::check();

?>
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
        <div class="contentArea"  data-barba="container" data-barba-namespace="songs">
        <div class="showEachSetting">
            <div class="eachmenus">
                <p class="each_setting_song_title"></p>
                <button class="each_setting_link" id="addToFavorite"><i class="fa-regular fa-heart each_setting-link_emo favoriteBtn"></i> Add to favorites</button>
                <a class="text-decoration-none each_setting_link" id="addToPlaylist"><i class="fas fa-list each_setting-link_emo"></i> Add to playlist </a>
                <a class="text-decoration-none each_setting_link" id="viewByArtist"><i class="fas fa-user each_setting-link_emo"></i> View artist: <span class="eachSettingArtist">Justin Bieber</span> </a>
                <button class="each_setting_link" id="songInfo"><i class="fa-solid fa-circle-info each_setting-link_emo"></i> Song info </button>
                <button class="each_setting_link" id="deleteSong"><i class="fa-solid fa-trash each_setting-link_emo"></i> Delete </button>
            </div>
        </div>
        <div class="transitions"></div>
            <nav class="music_nav">
                <div class="nav_menus">
                    <p class="profile text-white mb-0 dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Initiate</p>
                    <ul class="dropdown-menu dropdown-menu-dark">
                        <li><a class="dropdown-item" href="./profile.php">Profile</a></li>
                        <li><a class="dropdown-item" href="./change_password.php">Change password</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="event.preventDefault(); document.querySelector('#logoutform').submit()">Log out</a></li>
                        <form action="./logout.php" method="post" id="logoutform"></form>
                    </ul>
                </div>
            </nav>
            <div class="currentPlayingTrack">
                <img src="./assets/covers/default.jpg" alt="" class="currentPlayTrack_main" id="current_cover">
                <div class="bg-overley"></div>
                
                <div class="current_track_info">
                    <h1 class="ctrack_title" id="current_title">Tap to play</h1>
                    <small class="mb-0 cartist text-primary" id="current_artist">Mpify</small>
                    <div class="cbtngp">
                        <a href="#" class="caddFavorite btn btn-primary me-2 rounded-1 d-none" id="current_add_fav"><i class="fa-regular fa-heart me-2"></i>Add to Favorites</a>
                    </div>
                </div>
                
                <input type="range" class="track_range forInput" id="trackRangeInput" min="0" max="3200" value="0">
            </div>
           <div class="bottom_con">
            <div class="showSongsLists">
                    <i class="fa-solid fa-chevron-up showAllSongs"></i>
                </div>
                <div class="songlists" id="index_all_song_lists">
                    
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