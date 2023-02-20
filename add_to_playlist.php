<?php

use Libs\Helpers\Auth;

    include('./vendor/autoload.php');

    $currentUser = Auth::check();

use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;
use Libs\Database\PlaylistsTable;

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
        <div class="contentArea"  data-barba="container" data-barba-namespace="add_songs_to_selected_playlist">
        <div class="transitions"></div>
            <nav class="music_nav_playlist">
                <div class="d-flex align-items-center">
                    <a href="./land.php" class="backbtn text-decoration-none back-to-playlist me-3"><i class="fa-solid fa-chevron-left text-light"></i></a>
                    <h5 class="text text-light mb-0">Select Playlists</h5>
                </div>
                
                <div class="nav_menus">
                    <button class="btn btn-primary btn-sm px-3" id="save_playlists">Save</button>
                </div>
            </nav>
            <div class="allplayLists">
                <div class="playLists" id="playlist_container">
                    <form action="" id="song_add_to_playlist" method="post">
                        <input type="hidden" name="music_id" value="<?=$_GET['id'] ?>">
                        <?php
                            include("./vendor/autoload.php");

                            $playlistTable = new PlaylistsTable(new MySQL());
                            $playlists =  $playlistTable->getPlaylists();

                            $countTable = new AddtoPlaylist(new MySQL());
                            $selectedPlaylists = array_column($playlistTable->getPlaylistFromMusicId($_GET['id']), 'playlist_id');
                        ?>
                        <?php if(count($playlists)): ?>
                            <?php foreach($playlists as $playlist): ?>
                                <div class="each_playLists_select text-decoration-none">
                                    <div class="playlist_spec">
                                        <div class="playLists_image">
                                            <img src="./assets/playlist_cover/<?=$playlist->playlist_cover ?>" class="playlist_cover" alt="">
                                        </div>
                                        <div class="playLists_info">
                                            <h5 class="playLists_title mb-0"><?=$playlist->playlist_name ?></h5>
                                            <p class="mb-0 text-white-50 playLists_song_count"><?= $countTable->songsCount($playlist->id)?> songs</p>
                                        </div>
                                    </div>
                                    <input type="checkbox" name="playlist_id[]" class="form-check-input" value="<?=$playlist->id ?>" <?php echo (in_array($playlist->id, $selectedPlaylists))? 'checked' : ''; ?>>
                                </div>
                            <?php endforeach ?>
                        <?php else: ?>
                            <p class="text text-center d-block text-white-50 mb-0">There's no playlists yet.</p>
                        <?php endif ?>
                    </form>
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