<?php

use Libs\Database\MusicsTable;
use Libs\Database\MySQL;
use Libs\Helpers\Auth;

include("../vendor/autoload.php");

$user = Auth::check();
$input = '';
$table = new MusicsTable(new MySQL());
$songs =$table->getAllSongs();

if(count($songs)) {
    foreach($songs as $song) {
        $input .= "
        <div class='each_select_track mb-1'>
            <div class='select_left'>
                <img class='select_image' src='./assets/covers/$song->cover' alt=''>
                <div class='select_info'>
                    <h5 class='each_select_title'>$song->title</h5>
                    <small class='each_select_artist text-white-50 mb-0'>$song->artist</small>
                </div>
            </div>
            <div class='select_right'>
                <input type='checkbox' name='add_to_playlist[]' class='form-check-input' id='$song->id' value='$song->id'>
            </div>
        </div>
        ";
    }
} else {
    $input = "";
}

echo $input;