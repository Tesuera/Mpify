<?php
use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;
use Libs\Database\PlaylistsTable;
use Libs\Helpers\Auth;

include("../vendor/autoload.php");

$user = Auth::check();
$table = new PlaylistsTable(new MySQL());
$playlists = $table->getPlaylists();

$countTable = new AddtoPlaylist(new MySQL());
$input = '';

if(count($playlists)) {
    foreach($playlists as $playlist) {
        $songs = $countTable->songsCount($playlist->id);
        $input .= "
        <a href='playlist_detail.php?id=$playlist->id' class='each_playLists text-decoration-none'>
            <div class='playlist_spec'>
                <div class='playLists_image'>
                    <img src='./assets/playlist_cover/$playlist->playlist_cover' class='playlist_cover' alt=''>
                </div>
                <div class='playLists_info'>
                    <h5 class='playLists_title mb-0'>$playlist->playlist_name</h5>
                    <p class='mb-0 text-white-50 playLists_song_count'>$songs songs</p>
                </div>
            </div>
            <i class='fa-solid fa-chevron-right playLists_into text-white-50'></i>
        </a>
        ";
    }
} else {
    $input = "";
}

echo $input;