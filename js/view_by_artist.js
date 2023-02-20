var view_by_artist_container = document.querySelector('#view_by_artist');

var url = location.href;
var artist_splited = url.split('=');
var artist_name = artist_splited[artist_splited.length - 1];

function getArtistSongs () {
    let xml = new XMLHttpRequest();
    xml.open('post', './getters/getSongsByArtist.php');
    let data = "artist=" + artist_name;
    xml.addEventListener('load', function () {
        if(this.response != '') {
            temp_trackList = JSON.parse(this.response);
            renderArtistSongs(JSON.parse(this.response));
        } else {
            view_by_artist_container.innerHTML += `<p class="text text-center d-block text-white-50 my-4">There's no song in this playlist.</p>`;
        }
    });
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xml.send(data);
}

function renderArtistSongs (arrAll) {
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
    view_by_artist_container.innerHTML += inputText;
}

function init() {
    getArtistSongs();
}

init();