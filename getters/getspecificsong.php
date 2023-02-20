<?php

use Libs\Database\MusicsTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

include("../vendor/autoload.php");
$id = $_POST['id'];

$user = Auth::check();
$musicTable = new MusicsTable(new MySQL());
$song = $musicTable->getSpecificMusic($id);

if(!empty($song)) {
    echo json_encode($song);
} else {
    echo "";
}
