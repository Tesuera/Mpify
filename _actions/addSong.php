<?php

include("../vendor/autoload.php");
use Libs\Helpers\Auth;
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

$auth = Auth::check();
$error = [];
$errorstatus = 0;

$title = $_POST['track_title'];
$artist = $_POST['artist'];
$lyrics = $_POST['lyrics'];


$tmp = $_FILES['cover']['tmp_name'];
$type = $_FILES['cover']['type'];

$track_name = $_FILES['track']['name'];
$track_tmp = $_FILES['track']['tmp_name'];
$track_type = $_FILES['track']['type'];
$textension = pathinfo($track_name, PATHINFO_EXTENSION);

$getEx = explode("/", $type);
$extension = end($getEx);
$newcover = '';

if(empty($title)) {
    $error['title'] = "track title is required";
    $errorstatus = 1;
}

if(empty($artist)) {
    $artist = "Unknown artist";
}
if(empty($lyrics)) {
    $lyrics = null;
}

if($tmp) {
    if(!($extension == "jpg" || $extension == "png" || $extension == "jpeg")) {
        $error['cover'] = "cover photo must be type of png,jpg.";
        $errorstatus = 1;
    }
}

if(empty($track_tmp)) {
    $error['track'] = "track is required";
    $errorstatus = 1;
} elseif (! ($track_type == "audio/x-m4a" || $track_type == "audio/mpeg")) {
    $error['track'] = "track must be type of m4a, mp3";
    $errorstatus = 1;
}

if(!$errorstatus) {
    $newaudio = uniqid() . "__track." . $textension;
    if($tmp) {
        $newcover = uniqid() . "__cover." . $extension;
        move_uploaded_file($tmp, "../assets/covers/" . $newcover);
    } else {
        $newcover = "default.jpg";
    }
    move_uploaded_file($track_tmp, "../tracks/" . $newaudio);

    $db = new MusicsTable(new MySQL());
    $data = [
        "title" => $title,
        "cover" => $newcover,
        "audio_url" => $newaudio,
        "artist" =>$artist,
        "lyrics" => $lyrics,
        "user_id" => $auth['id']
    ];
    $db->addMusic($data);
    echo json_encode([
        "status" => 200,
        "message" => "upload successfully"
    ]);
} else {
    echo json_encode([
        "status" => 420,
        "error" => $error,
        "old" => $_POST
    ]);
}