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
                    <a href="./new_song.php" class="text-decoration-none text-secondary sidebar-link active" id="new_song_sidebar"><i class="fa-solid fa-compact-disc me-2"></i>Add new</a>
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
        <div class="contentArea"  data-barba="container" data-barba-namespace="createSong">
        <div class="transitions"></div>
            <nav class="music_nav">
                <div class="nav_menus">
                    <p class="profile text-white mb-0">Initiate</p>
                </div>
            </nav>
            <div class="add_new_song">
                <h1 class="add_title mb-3">Add new song</h1>
                <form action="" method="post" class="add_song_form" id="addForm" enctype="multipart/form-data">
                    <div class="add_top d-flex align-items-center">
                        <div class="top_left">
                            <input type="file" name="cover" class="add_song_input d-none" id="cover_input">
                            <div class="add_song_cover" id="instead_cover"><i class="fas fa-plus"></i></div>
                        </div>
                        <div class="top_right">
                            <div class="input_form">
                                <label>Track</label>
                                <i class="fa-solid fa-headphones text-white-50 track_add" id="instead_select_track"></i>
                                <input type="file" name="track" class="d-none" id="select_track">
                            </div>
                            <div class="input_form">
                                <label>Track title</label>
                                <input type="text" name="track_title" class="add_song_input">
                            </div>
                            <div class="input_form">
                                <label>Artist</label>
                                <input type="text" name="artist" class="add_song_input">
                            </div>
                        </div>
                    </div>
                    <div class="add_bottom">
                        <div class="lyric_area">
                            <label>Lyrics</label>
                            <textarea type="text" name="lyrics" class="lyric_input" rows="8"></textarea>
                        </div>
                    </div>
                    <button class="add_song_btn" id="add_song_btn">Add</button>
                </form>
            </div>
        </div>
    </section>

<?php 
    include("./templates/footer.php");
?>
<?php 
    include("./templates/foot.php");
?>