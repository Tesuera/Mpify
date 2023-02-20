<?php
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

    require_once("../vendor/autoload.php");

    $user = Auth::check();
    $artist = $_POST['artist'];
    $table = new MusicsTable(new MySQL());
    $songs = $table->getMusicByArtistName($artist);

    echo json_encode($songs);
?>