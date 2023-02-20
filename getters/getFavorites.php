<?php
session_start();
use Libs\Database\MusicsTable;
use Libs\Database\MySQL;

include("../vendor/autoload.php");

$input = '';

$musicTable = new MusicsTable(new MySQL());
$favorites = $musicTable->getFavorite();

if(count($favorites)) {
    // foreach($favorites as $key=>$favorite) {
        // $now_playing = ($favorite->now_playing)?'active' : '';
        // $now_playing;
        // if(isset($_SESSION['now_playing'])) {
        //     $now_playing = ($_SESSION['now_playing'] == $favorite->id)? 'active': '';
        // } else {
        //     $now_playing = '';
        // }
        // $input .= "
        // <div class='eachSong $now_playing' id='favorite_each'>
        //     <div class='each_left' onclick='eachSong(event, $favorite->id)' data-index=$key data-id=$favorite->id>
        //         <div class='nowPlaying'>
        //             <div class='aniNote'></div>
        //             <div class='aniNote'></div>
        //             <div class='aniNote'></div>
        //         </div>
        //         <img src='./assets/covers/$favorite->cover' alt='' class='cover_track_photo'>
        //         <div class='track_infomation'>
        //             <h5 class='each_track_title mb-0'>$favorite->title</h5>
        //             <small class='each_artist'>$favorite->artist</small>
        //         </div>
        //     </div>
        //     <div class='track_actions'>
        //         <i class='fa-solid fa-heart text-danger' id='undo_favorite' onclick='remove_from_favorite($favorite->id)'></i>
        //     </div>
        // </div>
        // ";
    // }
    $input = json_encode($favorites);
} else {
    $input = '';
}

echo $input;