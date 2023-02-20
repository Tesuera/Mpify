<?php

use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;

include("../vendor/autoload.php");

$playlist_id = $_POST['playlist_id'];
$selected_musics = $_POST['add_to_playlist'];
$add_to_playlist = [];

//delete songs from playlist
$addPlaylistTable = new AddtoPlaylist(new MySQL());
$addPlaylistTable->deleteAllSongsFromSpecificPlaylist($playlist_id);

foreach($selected_musics as $music) {
    $add_to_playlist[] = "($music, $playlist_id)";
}
$datastring = implode(",", $add_to_playlist);
$result = $addPlaylistTable->insertToPlaylist($datastring);

if($result) {
    echo json_encode([
        "status" => 200,
        "message" => "songs added successfully"
    ]);
} else {
    echo json_encode([
        "status" => 500,
        "message" => "something wrong with the server"
    ]);
}