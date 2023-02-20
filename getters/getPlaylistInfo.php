<?php

use Libs\Helpers\Auth;
use Libs\Database\MySQL;
use Libs\Database\PlaylistsTable;

include ("../vendor/autoload.php");

$user = Auth::check();
$playlist_id = $_POST['playlist_id'];

$table = new PlaylistsTable(new MySQL());
$playlistProfile = $table->getPlaylistInfo($playlist_id);

if($playlistProfile) {
    echo json_encode($playlistProfile);
} else {
    echo "";
}