var playlists_container = document.querySelector('#playlist_container');

function getPlaylists () {
    let xml = new XMLHttpRequest();
    xml.open('get', "./getters/getplaylists.php");
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            if(this.response != "") {
                playlists_container.innerHTML = this.response;
            } else {
                playlists_container.innerHTML = `<p class="text text-center d-block text-white-50 mb-0">There's no playlists yet.</p>`;
            }
        }
    });
    xml.send();
}

function init() {
    getPlaylists();
}

init();