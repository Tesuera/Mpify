var songs_form = document.querySelector('#add_song_to_playlist');
var save_btn = document.querySelector('#save_song_to_playlist');

var selectedPlaylistUrl = location.href;
var playlistUrlArr = selectedPlaylistUrl.split('=');
var selectedPlaylist_id = playlistUrlArr[playlistUrlArr.length - 1];

save_btn.addEventListener('click', function (e) {
    let xml = new XMLHttpRequest();
    let formdata = new FormData(songs_form);
    let playlist_id = formdata.get('playlist_id');
    if (formdata.get("add_to_playlist[]")) {
        xml.open('post', './_actions/add_songs_to_playlist.php');
        xml.addEventListener('load', function() {
            if(this.readyState == this.DONE && this.status == 200) {
                let responseData = JSON.parse(this.response);
                if(responseData.status == 200) {
                    let btn = document.querySelector('#loadToBack');
                    btn.setAttribute("href", './playlist_detail.php?id=' + selectedPlaylist_id);
                    btn.click();
                } else if(responseData.status == 500) {
                    console.log(responseData);
                }
            }
        });
        xml.send(formdata);
    } else {
        console.log('Select songs first');
    }
});

function getSelectedSongsByPlaylist () {
    let xml = new XMLHttpRequest();
    xml.open('post', './getters/getSelectedPlaylistsSong.php');
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            console.log(this.response);
            if(this.response != "") {
                songs_form.innerHTML += this.response;
            } else {
                songs_form.innerHTML = `<p class="text text-white-50 d-block text-center">There's no songs to add. <a href="./new_song.php" class="text text-decoration-none text-primary">Create song.</a></p>`
            }
        }
    });
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xml.send("playlist_id=" + selectedPlaylist_id);
}

function init() {
    getSelectedSongsByPlaylist();
}

init();