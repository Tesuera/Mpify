var songLists = document.querySelector('#index_all_song_lists');
var current_addto_favorite = document.querySelector('#current_add_fav');

var toggleEachSetting = document.querySelector('.showEachSetting');
var eachSettingTitle = document.querySelector('.each_setting_song_title');

var bottom_container = document.querySelector('.bottom_con');
var upBtn = document.querySelector('.showAllSongs');


var nextBtns = document.querySelectorAll('#nextBtn');
var prevBtns = document.querySelectorAll('#prevBtn');
var playBtns = document.querySelectorAll('#playBtn');
var stopBtns = document.querySelectorAll('#stopBtn');
var onePlay = document.querySelector('#playBtn');
var trackRangeInput = document.getElementsByClassName('forInput');

upBtn.addEventListener('click', () => {
    bottom_container.classList.toggle('active');
});

document.querySelector('.showEachSetting').onclick = (e) => {
    if(e.target == toggleEachSetting) {
        toggleEachSetting.classList.remove('active');
    }
}


function getSongs () {
    let xml = new XMLHttpRequest();
    xml.open('get', './getters/getsonglists.php');
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            responseData = JSON.parse(this.response);
            if(responseData.length) {
                temp_trackList = responseData;
                playBtns.forEach((item, index) => {
                    item.classList.remove('disabledBtn');
                    stopBtns[index].classList.remove("disabledBtn");
                    nextBtns[index].classList.remove("disabledBtn");
                    prevBtns[index].classList.remove("disabledBtn");
                });
                renderAllSongs(responseData);
            } else {
                for(let i=0; i<document.getElementsByClassName('forInput').length; i++) {
                    document.getElementsByClassName('forInput')[i].classList.add('mute_input'); 
                }
                playBtns.forEach((item, index) => {
                    item.classList.add('disabledBtn');
                    stopBtns[index].classList.add("disabledBtn");
                    nextBtns[index].classList.add("disabledBtn");
                    prevBtns[index].classList.add("disabledBtn");
                });
                songLists.innerHTML = `
                <p class="text text-center d-block text-white-50">There is no song.</p>
                `;
            }
        }
    });
    xml.send();
}

function renderAllSongs (arrAll) {
    let inputText = '';
    arrAll.forEach((item,index) => {
        let now_on;
        if(currentIndex !== null) {
            let currentId = trackLists[currentIndex].id;
            now_on = (item.id == currentId)?'active' : '';
        } else {
            now_on = '';
        }
        inputText += `<div class='eachSong ${now_on}'>
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
            <i class='fa-solid fa-ellipsis-vertical eachSetting' onclick='showEachSetting(${index})'></i>
        </div>
    </div>`;
    });
    songLists.innerHTML = inputText;
}

function getNowPlaying () {
    if(currentIndex !== null) {
        let currentTrack = trackLists[currentIndex];
        console.log(currentTrack);
        document.querySelectorAll('#current_cover').forEach((item, index) => {
            item.setAttribute('src', './assets/covers/' + currentTrack.cover);
            document.querySelectorAll('#current_title')[index].textContent = currentTrack.title;
            document.querySelectorAll('#current_artist')[index].textContent = currentTrack.title;
        });
    }
}

function showEachSetting(indexId) {
    let songid = temp_trackList[indexId].id;
    let data = "id=" + songid;
    let xml = new XMLHttpRequest();
    xml.open('post', './getters/getspecificsong.php');
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            if(this.response != '') {
                let song = JSON.parse(this.response);
                eachSettingTitle.textContent = song.title;
                if(song.favorite) {
                    document.querySelector('#addToFavorite').innerHTML = `<i class="fa-regular fa-heart each_setting-link_emo favoriteBtn"></i> Remove from favorites`;
                    document.querySelector('.favoriteBtn').classList.remove('fa-regular');
                    document.querySelector('.favoriteBtn').classList.add('fa-solid');
                    document.querySelector('#addToFavorite').onclick = () => {
                        removeFavorite(song.id);
                    };
                } else {
                    document.querySelector('#addToFavorite').innerHTML = `<i class="fa-regular fa-heart each_setting-link_emo favoriteBtn"></i> Add to favorites`;
                    document.querySelector('.favoriteBtn').classList.remove('fa-solid');
                    document.querySelector('.favoriteBtn').classList.add('fa-regular');
                    document.querySelector('#addToFavorite').onclick = () => {
                        addFavorite(song.id);
                    };
                }

                document.querySelector('#addToPlaylist').href = "./add_to_playlist.php?id=" + song.id;
                document.querySelector('#viewByArtist').href = "./view_by_artist.php?artist=" + song.artist;
                document.querySelector('#addToPlaylist').onclick = () => {
                    addThisToPlaylist(song.id);
                };
            
                document.querySelector('#songInfo').onclick = () => {
                    songInformation(song.id);
                };
                document.querySelector('#deleteSong').onclick = () => {
                    songDelete(song.id);
                };

                document.querySelector('.eachSettingArtist').textContent = song.artist;
                toggleEachSetting.classList.add('active');
            } else {
                eachSettingTitle.textContent = "Something wrong";
                toggleEachSetting.classList.add('active');
            }
        }
    });
    xml.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xml.send(data);    
}

// setting function 
function addFavorite (id) {
    let data = "id=" + id;
    let xml = new XMLHttpRequest();
    xml.open("post", "./_actions/addToFavorites.php");
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            let response = JSON.parse(this.response);
            if(response.status == 200)  {
                toggleEachSetting.classList.remove('active');
            } else if (response.status == 420) {
                console.log(response);
            }
        }
    });
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send(data);
}

function removeFavorite (id) {
    let data = "id=" + id;
    let xml = new XMLHttpRequest();
    xml.open("post", "./_actions/removeFromFavorites.php");
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            let response = JSON.parse(this.response);
            if(response.status == 200)  {
                toggleEachSetting.classList.remove('active');
            } else if (response.status == 420) {
                console.log(response);
            }
        }
    });
    xml.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xml.send(data);
}

function addThisToPlaylist (id) {
    console.log(id);
}

function songInformation (id) {
    console.log(id);
}

function songDelete (id) {
    console.log(id);
}

var main_input_range = document.querySelector('.track_range');

function setValuetoMainTimeRange () {
    let maxValue = main_input_range.getAttribute('max');
    let track_duration = audioEle.duration; 
    let current_time = audioEle.currentTime;
    let current_value = (current_time / track_duration) * maxValue;
    main_input_range.value = current_value;
}

main_input_range.addEventListener('input', function () {
    // input value
    let current_range_value = main_input_range.value;
    let maxValue = main_input_range.getAttribute('max');
    let audio_duration = audioEle.duration;
    let current_duration = (current_range_value / maxValue) * audio_duration;
    audioEle.currentTime = current_duration;

    let mminute = Math.floor(current_duration / 60).toString().padStart(2, '0');
    let ssecond = Math.floor(current_duration % 60).toString().padStart(2, '0');
    minute.textContent = mminute;
    second.textContent = ssecond;
})

// setting functon end

function init () {
    getSongs();
    getNowPlaying();
}
init();