<?php
use Libs\Helpers\Auth;
use Libs\Database\AddtoPlaylist;
use Libs\Database\MySQL;
use Libs\Database\PlaylistsTable;

include("../vendor/autoload.php");


$user = Auth::check();
$playlist_title = $_POST['playlist_title'];
$add_to_playlist;

$playlist_cover_tmp = $_FILES['cover']['tmp_name'];
$playlist_cover_name = $_FILES['cover']['name'];
$playlist_cover_type = $_FILES['cover']['type'];
$extension = pathinfo($playlist_cover_name, PATHINFO_EXTENSION);

$error = [];
$errorStatus = 0;

if(array_key_exists("add_to_playlist", $_POST)) {
    $add_to_playlist = $_POST['add_to_playlist']; 
}

if($playlist_cover_tmp) {
    if(!($extension == "jpg" || $extension == "png" || $extension == "jpeg")) {
        $error['cover'] = "playlist cover photo must be type of png,jpg.";
        $errorstatus = 1;
    }
}



if(empty($playlist_title)) {
    $errorStatus = 1;
    $error['title'] = "playlist title is required";
} else if(strlen($playlist_title) > 20) {
    $errorStatus = 1;
    $error['title'] = "playlist title must not be longer than 20 characters";
}

if(!$error) {
    if($playlist_cover_tmp) {
        $newname = uniqid() . "__cover." . $extension;
        move_uploaded_file($playlist_cover_tmp, "../assets/playlist_cover/" . $newname);
    } else {
        $newname = "default.jpg";
    }
    $data = [
        'playlist_name' => $playlist_title,
        'playlist_cover' => $newname,
        'user_id' => $user['id']
    ];
    $playlistTable = new PlaylistsTable(new MySQL());
    $playlistId = $playlistTable->createPlaylists($data);

    if(!empty($add_to_playlist)) {
        $songs_add_to = [];
        $addPlaylistTable = new AddtoPlaylist(new MySQL()); 
        foreach ($add_to_playlist as $track_id) {
            $songs_add_to[] = "($track_id, $playlistId)";
        }
        $data_string = implode(",", $songs_add_to);
        $addPlaylistTable->insertToPlaylist($data_string);
    } 
    echo json_encode([
        'status' => 200,
        'message' => "playlist created successfully"
    ]);
} else {
    echo json_encode([
        'status' => 420,
        'errors' => $error,
    ]);
}
