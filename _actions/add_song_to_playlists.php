<?php

use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;

include("../vendor/autoload.php");

$music_id = $_POST['music_id'];
$playlists_id = $_POST['playlist_id'];

$addPlaylist = new AddtoPlaylist(new MySQL());
$addPlaylist->deletePlaylistDatabyMusicId($music_id);

$playlistsArr = [];

foreach($playlists_id as $playlist) {
    $playlistsArr[] = "($music_id, $playlist)";
}

$playlistsArr = implode(",", $playlistsArr);

$result = $addPlaylist->insertToPlaylist($playlistsArr);
if($result) {
    echo json_encode([
        "status" => 200,
        "message" => "success",
    ]);
} else {
    echo json_encode([
        "status" => 420,
        "message" => "something went wrong",
    ]);
}