<?php

use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

session_start();
include ('../vendor/autoload.php');

$music_id = $_POST['music_id'];

$musicTable = new MusicsTable(new MySQL());
$result = $musicTable->nowPlaying($music_id);

$_SESSION['now_playing'] = $music_id;

echo json_encode($result);