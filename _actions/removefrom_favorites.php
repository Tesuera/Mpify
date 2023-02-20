<?php
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

include("../vendor/autoload.php");

$id = $_POST['id'];
$user = Auth::check();

$musicTable = new MusicsTable(new MySQL());
$count = $musicTable->removeFromFavorite($id);

$input= '';
$favorites = $musicTable->getFavorite();

if(count($favorites)) {
    $input = json_encode($favorites);
} else {
    $input = '';
}

echo $input;