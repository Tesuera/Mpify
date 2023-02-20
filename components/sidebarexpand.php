<div class="playing_song_container">
        <div class="expandtop">
            <div class="d-flex align-items-center justify-content-start unexpanded_cur">
                <img src="./assets/covers/default.jpg" alt="" class="unexpand_cover" id="current_cover">
                <div class="curtrackInfo">
                    <p class="curtrackTitle" id="current_title">Mpify</p>
                    <small class="curtrackArtist text-light" id="current_artist">no track</small>
                </div>
                <div class="controller_con ms-auto me-3">
                    <i class="fa-solid fa-backward-step curControl" id="prevBtn"></i>
                    <i class="fa-solid fa-play curControl" id="playBtn" data-current ="stop"></i>
                    <i class="fa-solid fa-pause curControl d-none" id="stopBtn"></i>
                    <i class="fa-solid fa-forward-step curControl" id="nextBtn"></i>
                </div>
            </div>
            <div class="expanded_cur d-flex align-items-center justify-content-between flex-grow-1 me-3">
                <p class="mb-0 text-light expanded_title" id="current_title">Mpify.</p>
                <i class="fa-solid fa-ellipsis-vertical text-white-50"></i>
            </div>
            <i class="fas fa-chevron-up curtoexpand"></i>
        </div>
        <div class="expanded_bottom">
            <p class="text-white-50 text-center expanded_cur_artist" id="current_artist">no track</p>
            <div class=" volume_container">
                <i class="fa-solid volume_controller muteBtn fa-volume-high text-white-50 fa-fw"></i>
                <input type="range" min="0" max="100" class="volume_controller_range" value="25">
            </div>
            <img src="./assets/covers/default.jpg" class="expanded_cover" id="current_cover" alt="">
            <div class="expanded_cur_title_container">
                <h5 class="cur_expanded_title">Tap to play</h5>
            </div>
            <div class="expanded_cur_track_length">
                <p class="track_from text-white-50"><span class="minute">00</span>:<span class="second">00</span></p>
                <input type="range" id="trackRangeInput" min="0" max="1200" value="0" class="cur_track_range forInput">
                <p class="track_remain text-white-50">00:00</p>
            </div>
            <div class="expanded_curr_track_info">
                <i class="player_controller_rid fa-solid fa-shuffle" id="shuffleBtn"></i>
                <i class="player_controller fa-solid fa-backward-step" id="prevBtn"></i>
                <i class="player_controller fa-solid fa-play" id="playBtn" data-current ="stop"></i>
                <i class="player_controller fa-solid fa-pause d-none" id="stopBtn"></i>
                <i class="player_controller fa-solid fa-forward-step" id="nextBtn"></i>
                <i class="player_controller_rid fa-solid fa-list-ul" id="allLists"></i>
            </div>
        </div>
    </div>