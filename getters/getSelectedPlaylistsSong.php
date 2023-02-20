<?php

use Libs\Database\AddtoPlaylist;
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

include('../vendor/autoload.php');

$playlist_id = $_POST['playlist_id'];
$input = '';

$user = Auth::check();
$musictable = new MusicsTable(new MySQL());
$musics = $musictable->getAllSongs();

$playlistTable = new AddtoPlaylist(new MySQL());
$selectedPlaylists = array_column($playlistTable->getSongsbyPlaylistId($playlist_id), 'id');

if(count($musics)) {
    foreach($musics as $music) {
        $inarr = in_array($music->id, $selectedPlaylists)? "checked" : "";
        $input .= "
            <div class='each_select_track mb-1'>
                <div class='select_left'>
                    <img class='select_image' src='./assets/covers/$music->cover' alt=''>
                    <div class='select_info'>
                        <h5 class='each_select_title'>$music->title</h5>
                        <small class='each_select_artist text-white-50 mb-0'>$music->artist</small>
                    </div>
                </div>
                <div class='select_right'>
                    <input type='checkbox' name='add_to_playlist[]' class='form-check-input' id='$music->id' value='$music->id' $inarr>
                </div>
            </div>
        ";
    }
} else {
    $input = '';
}

echo $input;