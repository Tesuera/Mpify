<?php

use Libs\Database\AddtoPlaylist;
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

include('../vendor/autoload.php');

$listData = $_POST['data'];
$musicTable = new MusicsTable(new MySQL());
$addPlaylistTable = new AddtoPlaylist(new MySQL());
$output = '';

if($listData == 'all') {
    $output = $musicTable->getAllSongs();
} elseif($listData == 'favorite') {
    $output = $musicTable->getFavorite();
} elseif(str_contains($listData, 'playlist')) {
    $playlistIdArr = explode("=", $listData);
    $playlist_id = $playlistIdArr[count($playlistIdArr) - 1];
    $output = $addPlaylistTable->getSongsbyPlaylistId($playlist_id);
}

echo json_encode($output);
