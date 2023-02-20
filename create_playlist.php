<?php

use Libs\Helpers\Auth;

    include('./vendor/autoload.php');

    $currentUser = Auth::check();

use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

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
                    <a href="./home.php" class="text-decoration-none text-secondary sidebar-link" id="land_sidebar"><i class="fas fa-music me-2"></i> All songs</a>
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
                    <a href="#" class="text-decoration-none text-secondary sidebar-link" id="feedback_sidebar"><i class="fa-regular fa-comment-dots me-2"></i>Feedback</a>
                </li>
            </ul>
        </div>
        <?php
            include("./components/audioelement.php");
        ?>
        <div class="contentArea"  data-barba="container" data-barba-namespace="createPlaylist">
        <div class="transitions"></div>
            <nav class="music_nav">
                <div class="nav_menus">
                    <p class="profile text-white mb-0">Initiate</p>
                </div>
            </nav>
            <div class="add_new_song">
                <h1 class="add_title mb-3">New playlist</h1>
                <form action="" method="post" class="add_song_form" id="playlistForm" enctype="multipart/form-data">
                    <div class="add_top d-flex align-items-center">
                        <div class="top_left">
                            <input type="file" name="cover" class="add_song_input d-none" id="playlist_cover">
                            <div class="add_song_cover" id="instead_playlist_cover"><i class="fas fa-plus"></i></div>
                        </div>
                        <div class="top_right">
                            <div class="input_form">
                                <label>Playlist title</label>
                                <input type="text" name="playlist_title" class="add_song_input">
                            </div>
                        </div>
                        <button class="create_playlist_btn">Create</button>
                    </div>
                    <div class="select_music_container">                       
                        <?php 
                            include('./vendor/autoload.php');

                            $musicTable = new MusicsTable(new MySQL());
                            $musics = $musicTable->getAllSongs();

                        ?>
                        <?php if(count($musics)): ?>
                            <?php foreach($musics as $music): ?>
                                <div class="each_select_track mb-1">
                                    <div class="select_left">
                                        <img class="select_image" src="./assets/covers/<?=$music->cover ?>" alt="">
                                        <div class="select_info">
                                            <h5 class="each_select_title"><?=$music->title ?></h5>
                                            <small class="each_select_artist text-white-50 mb-0"><?=$music->artist ?></small>
                                        </div>
                                    </div>
                                    <div class="select_right">
                                        <input type="checkbox" name="add_to_playlist[]" class="form-check-input" id="<?=$music->id ?>" value="<?=$music->id ?>">
                                    </div>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                        <?php endif ?>
                    </div>
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