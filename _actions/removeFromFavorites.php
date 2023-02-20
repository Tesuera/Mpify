<?php

use Libs\Database\MusicsTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

include("../vendor/autoload.php");

$user = Auth::check();
$id = $_POST['id'];
$musicTable = new MusicsTable(new MySQL());
$result = $musicTable->removeFromFavorite($id);

if($result) {
    echo json_encode([
        "status" => 200,
        "message" => "Added to favorites"
    ]);
} else {
    echo json_encode([
        "status" => 420,
        "message" => "Can't added to favorites"
    ]);
}