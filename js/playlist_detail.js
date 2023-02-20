var playlist_profile_cover = document.querySelector('#playlist_profile_cover');
var playlist_title = document.querySelector('#playlist_title');
var playAllBtn = document.querySelector('#playAllBtn');

var playlist_container = document.querySelector('#playlist_detail_container');

var url = location.href;
var playlist_splited = url.split('=');
var playlist_id = playlist_splited[playlist_splited.length - 1];


var temp_trackList;
function getPlaylistInfo() {
    let xml = new XMLHttpRequest();
    xml.open('post', './getters/getPlaylistInfo.php');
    xml.addEventListener('load', function () {
        if( this.readyState == this.DONE && this.status == 200 ) {
            if(this.response != "") {
                let responseData = JSON.parse(this.response);
                playlist_title.textContent = responseData.playlist_name;
                playlist_profile_cover.setAttribute("src","./assets/playlist_cover/" + responseData.playlist_cover);
                getPlaylistSongs();
                console.log(playlist_profile_cover);
            } else {
                console.log(this.response);
            }
        }
    });
    xml.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    xml.send("playlist_id=" + playlist_id);
}

function getPlaylistSongs() {
    let xml = new XMLHttpRequest();
    xml.open('post', "./getters/getSpecPlaylistSongs.php");
    xml.addEventListener('load', function () {
        if( this.readyState == this.DONE && this.status == 200 ) {
            if(this.response != '') {
                temp_trackList = JSON.parse(this.response);
                renderPlaylistSongs(JSON.parse(this.response));
            } else {
                playAllBtn.classList.add('disabled');
                playlist_container.innerHTML += `<p class="text text-center d-block text-white-50 my-4">There's no song in this playlist.</p>`;
            }
        }
    });
    xml.setRequestHeader('Content-Type', "application/x-www-form-urlencoded");
    xml.send("playlist_id=" + playlist_id);
}

function renderPlaylistSongs (arrAll) {
    let inputText = '';
    arrAll.forEach((item,index) => {
        let now_on;
        if(currentIndex !== null) {
            let currentId = trackLists[currentIndex].id;
            now_on = (item.id == currentId)?'active' : '';
        } else {
            now_on = '';
        }
        inputText += `<div class='eachSong ${now_on}' id='favorite_each'>
        <div class='each_left' onclick='eachSong(event, ${index})' data-index=${index} data-id=${item.id}>
            <div class='nowPlaying'>
                <div class='aniNote'></div>
                <div class='aniNote'></div>
                <div class='aniNote'></div>
            </div>
            <img src='./assets/covers/${item.cover}' alt='' class='cover_track_photo'>
            <div class='track_infomation'>
                <h5 class='each_track_title mb-0'>${item.title}</h5>
                <small class='each_artist'>${item.artist}</small>
            </div>
        </div>
    </div>`;
    });
    playlist_container.innerHTML += inputText;
}

function init() {
    getPlaylistInfo();
}

init();