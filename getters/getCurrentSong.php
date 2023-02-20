<?php

use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

session_start();
include('../vendor/autoload.php');

$song = '';

if(isset($_SESSION['now_playing'])) {
    $current_id = $_SESSION['now_playing'];
    $musicTable = new MusicsTable(new MySQL());
    $current_info = $musicTable->getSpecificMusic($current_id);

    if($current_info) {
        $song = json_encode($current_info);
    } else {
        $song = '';
    }
} else {
    $song = '';
}

echo $song;