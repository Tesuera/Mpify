<?php
session_start();
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

include("../vendor/autoload.php");

$input = '';
$table = new MusicsTable(new MySQL());
$songs =$table->getAllSongs();

if(count($songs)) {
    $input = json_encode($songs);
} else {
    $input = json_encode([]);
}

echo $input;
