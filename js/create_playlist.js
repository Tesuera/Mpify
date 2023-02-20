var container = document.querySelector('.select_music_container');
var playList_cover_btn = document.querySelector('#playlist_cover');
var instead_playlist = document.querySelector('#instead_playlist_cover');
var createBtn = document.querySelector('.create_playlist_btn');
var playlistForm = document.querySelector('#playlistForm');

instead_playlist.addEventListener('click', function () {
    playList_cover_btn.click();
});

playList_cover_btn.addEventListener('change', (e) => {
    let xml = new XMLHttpRequest();
    xml.open("post", "./_actions/addtempphoto.php");
    xml.addEventListener('load', function() {
        if(this.readyState == this.DONE && this.status == 200) {
            let datas = JSON.parse(this.response)
            if(datas.status == 200) {
                instead_playlist.style.backgroundImage = "url('./assets/before/" + datas.info + "')"
            } else if(datas.status == 420) {
                console.log(datas);
            }
        }
    });
    let data = new FormData(playlistForm);
    xml.send(data);
});

createBtn.addEventListener('click', function (e) {
    e.preventDefault();
    let xml = new XMLHttpRequest();
    xml.open("post", "./_actions/addplaylists.php");
    xml.addEventListener('load', function () {
        if (this.readyState == this.DONE && this.status == 200) {
            let responsedata = JSON.parse(this.response);
            if(responsedata.status == 200) {
                playlistForm.reset();
                document.querySelector('#playlist_sidebar').click();
            } else if(responsedata.status == 420) {
                console.log(responsedata);
            }
        }
    });
    let data = new FormData(playlistForm);
    xml.send(data);
})

function init() {
}

init();