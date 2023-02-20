<?php

use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

include('../vendor/autoload.php');

$user = Auth::check();
$playlist_id = $_POST['playlist_id'];
$input = '';

$table = new AddtoPlaylist(new MySQL());
$songs = $table->getSongsbyPlaylistId($playlist_id);

if(count($songs)) {
    $input = json_encode($songs);
} else {
    $input = '';
}

echo $input;