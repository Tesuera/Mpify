var form = document.querySelector('#song_add_to_playlist');
var saveToPlaylistBtn = document.querySelector('#save_playlists');

saveToPlaylistBtn.addEventListener('click', function () {
    let data = new FormData(form);
    if(data.get('music_id') && data.get('playlist_id[]')) {
        let xml = new XMLHttpRequest();
        xml.open('post', './_actions/add_song_to_playlists.php');
        xml.addEventListener('load', function () {
            if(this.readyState == this.DONE && this.status == 200) {
                responseData = JSON.parse(this.response);
                if(responseData.status == 200) {
                    history.back();
                } else if(responseData.status == 420) {
                    console.log(responseData);
                }
            }
        });
        xml.send(data);
    } else {
        console.log('There is no selected playlist');
    }
});
