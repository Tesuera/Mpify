var favorite_container = document.querySelector('#favorite_lists');

function getFavorites () {
    let xml = new XMLHttpRequest();
    xml.open("get","./getters/getFavorites.php");
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            if(this.response == '') {
                favorite_container.innerHTML = `
                <p class="mb-0 text-white-50 text-center d-block">There is no favorite songs.</p>
                `;
            } else {
                temp_trackList = JSON.parse(this.response);
                renderSongs(temp_trackList);
            }
        }
    });
    xml.send();
}

function renderSongs (arrAll) {
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
        <div class='track_actions'>
            <i class='fa-solid fa-heart text-danger' id='undo_favorite' onclick='remove_from_favorite(${item.id})'></i>
        </div>
    </div>`;
    });
    favorite_container.innerHTML = inputText;
}

function remove_from_favorite (id) {
   if(confirm('Are you sure to remove this song from favorites')) {
    let  songId = id;
    let data = "id=" + songId;
    let xml = new XMLHttpRequest();
    xml.open('post', './_actions/removefrom_favorites.php');
    xml.addEventListener('load', function () {
        if (this.readyState == this.DONE && this.status == 200) {
            if(this.response != '') {
                temp_trackList = JSON.parse(this.response);
                renderSongs(temp_trackList);
            } else {
                favorite_container.innerHTML = `
                <p class="mb-0 text-white-50 text-center d-block">There is no favorite songs.</p>
                `;
            }
        }
    });
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send(data);
   }
}


function init() {
    getFavorites();
}

init();