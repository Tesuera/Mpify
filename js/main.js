function delay (n) {
    n = n || 2000;
    return new Promise((done) => {
        setTimeout(() => {
            done();
        }, n)
    })
}

function pageTransitionOut() {
    var tl = gsap.timeline();

    tl.to(".transitions", { duration: 0.5, scaleX : 1, transformOrigin : "left", ease: Power1.easeInOut});
}

function pageTransitionIn() {
    var tl = gsap.timeline();

    tl.fromTo(".transitions", { scaleX : 1, transformOrigin: "right"}, { duration: 0.5, scaleX : 0, transformOrigin: "right", ease: Power1.easeInOut});
}

barba.init({
    sync: true,
    transitions : [{
        async leave(data){
            var done = this.async();

            pageTransitionOut();
            await delay(1200);
            done();
        },

        async enter (data) {
            pageTransitionIn()
        }
    }],

    views : [{
        namespace: 'songs',
        async beforeEnter({next}) {
            let script = document.createElement('script');
            script.src = "./js/index.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : 'playlists',
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/playlist.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : "add_songs_to_selected_playlist",
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/add_song_to_playlists.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : "favorites",
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/favorite.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : 'playlist_add_song',
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/add_songs_to_playlist.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : "playlist_detail",
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/playlist_detail.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : 'view_by_artist',
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/view_by_artist.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : 'createPlaylist',
        async beforeEnter ({next}) {
            let script = document.createElement('script');
            script.src = "./js/create_playlist.js";
            next.container.appendChild(script);
        }
    },
    {
        namespace : 'createSong',
        async beforeEnter({next}) {
            let script = document.createElement('script');
            script.src = './js/addsong.js';
            next.container.appendChild(script);
        }
    }
    ]
});



var nav_menus = document.querySelectorAll('.sidebar-link');
var audioEle = document.querySelector('#audio');
var is_done_track = false;
var temp_trackList;
var trackLists;
var currentIndex = null;


nav_menus.forEach(menu => {
    menu.addEventListener('click', function() {
        nav_menus.forEach(item => {
            item.classList.remove('active');
        });
        menu.classList.add('active');
    });
});

function eachSong(event , songIndex) {
    is_done_track = false;
    trackLists = temp_trackList;
    currentIndex = songIndex;
    saveCurrentIndexToSession(Number(currentIndex));
    saveTracklistsToSession(trackLists);
    let songs = document.querySelectorAll('.eachSong');
    songs.forEach(item => item.classList.remove('active'));
    event.target.parentElement.classList.add('active');
    let responseData = trackLists[songIndex];
    var current_title = document.querySelectorAll('#current_title');
    var current_artist = document.querySelectorAll('#current_artist');
    var current_cover = document.querySelectorAll('#current_cover');
    var last_title = document.querySelector('.cur_expanded_title');

    current_title.forEach((item, index) => {
        item.textContent = responseData.title;
        current_artist[index].textContent = responseData.artist;
        current_cover[index].src = "./assets/covers/" + responseData.cover;
    });
    last_title.textContent= responseData.title;
            audioEle.src = "./tracks/" + responseData.audio_url;
            setStartTime(0, 0);
            song_length_input.value = 0;
            if(main_input_range) {
                main_input_range.value = 0;
            }
            setTimeout(()=> {
                audioEle.play();
                is_playing = true;
                onePlay.click();
            }, 100);
};

function beforeGetAll () {
    currentIndex = null;
   
    let xml = new XMLHttpRequest();
    xml.open('get', './getters/getsonglists.php');
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            responseData = JSON.parse(this.response);
            if(responseData.length) {
                trackLists  = responseData;
            } else {
                trackLists = [];
                console.log();
                for(let i=0; i<document.getElementsByClassName('forInput').length; i++) {
                    document.getElementsByClassName('forInput')[i].classList.add('mute_input'); 
                }
                playBtns.forEach((item, index) => {
                    item.classList.add('disabledBtn');
                    stopBtns[index].classList.add("disabledBtn");
                    nextBtns[index].classList.add("disabledBtn");
                    prevBtns[index].classList.add("disabledBtn");
                });
            }
        }
    });
    xml.send();

    if(currentIndex == null) {
        for(let i=0; i<document.getElementsByClassName('forInput').length; i++) {
            document.getElementsByClassName('forInput')[i].classList.add('mute_input'); 
        }
    }
}

function saveTracklistsToSession (objj) {
    sessionStorage.setItem('trackLists', JSON.stringify(objj));
}

function saveCurrentIndexToSession (curind) {
    sessionStorage.setItem('currentIndex', curind);
}

var expandBtn = document.querySelector('.curtoexpand');
var unexpand_current_container = document.querySelector('.playing_song_container');

var unexpanded_left_con = document.querySelector('.unexpanded_cur');
var expanded_left_con = document.querySelector('.expanded_cur');
var expanded_bottom = document.querySelector('.expanded_bottom');

expandBtn.addEventListener('click', function() {
    unexpand_current_container.classList.toggle('active');
    expandBtn.classList.toggle('active');
    unexpanded_left_con.classList.toggle('hide');
    expanded_left_con.classList.toggle('show');
    expanded_bottom.classList.toggle('active');
});


// music player
var volume_input = document.querySelector('.volume_controller_range');
var mute_btn = document.querySelector('.muteBtn');
var song_length_input = document.querySelector('.cur_track_range');

var minute = document.querySelector('.minute'); 
var second = document.querySelector('.second');
var full_time = document.querySelector('.track_remain');
var is_playing = false;

var playBtns = document.querySelectorAll('#playBtn');
var stopBtns = document.querySelectorAll('#stopBtn');
var nextBtns = document.querySelectorAll('#nextBtn');
var prevBtns = document.querySelectorAll('#prevBtn');

var onePlay = document.querySelector('#playBtn');
var oneStop = document.querySelector('#stopBtn');
var main_input_range = document.querySelector('.track_range');



mute_btn.addEventListener('click', function () {
    if(audioEle.volume != 0) {
        mute_btn.classList.remove('fa-volume-high');
        mute_btn.classList.add('fa-volume-xmark');
        audioEle.volume = 0;
        volume_input.value = 0;
    } else {
        mute_btn.classList.remove('fa-volume-xmark');
        mute_btn.classList.add('fa-volume-high');
        audioEle.volume = 0.02;
        volume_input.value = 2;
    }
});

function setNowPlaying(index_id) {
    let currentTrackLists = document.querySelectorAll('.each_left');
    currentTrackLists.forEach(each => each.parentElement.classList.remove('active'));
    currentTrackLists.forEach(item => {
        if(item.getAttribute('data-id') == index_id) {
            item.parentElement.classList.add('active');
        }
    })
}

// audio start
function setMusic (ele) {
    let music_length = ele.duration;
    let full_minute = Math.floor(music_length / 60);
    let full_sec = Math.floor(music_length % 60);
    setFullTime(full_minute, full_sec);
}

function setFullTime(mmi, ssi) {
    let mminute = mmi.toString().padStart(2, '0');
    let ssecond = ssi.toString().padStart(2, '0');
    full_time.textContent = mminute + ":" + ssecond;
}

function setStartTime (mmi, ssi) {
    let mminute = mmi.toString().padStart(2, '0');
    let ssecond = ssi.toString().padStart(2, '0');
    minute.textContent = mminute;
    second.textContent = ssecond;
}

function setValuetoTimeRange () {
    let maxValue = song_length_input.getAttribute('max');
    let track_duration = audioEle.duration; 
    let current_time = audioEle.currentTime;
    let current_value = (current_time / track_duration) * maxValue;
    song_length_input.value = current_value;
}

if(main_input_range) {
    function setValuetoMainTimeRange () {
        let maxValue = main_input_range.getAttribute('max');
        let track_duration = audioEle.duration; 
        let current_time = audioEle.currentTime;
        let current_value = (current_time / track_duration) * maxValue;
        main_input_range.value = current_value;
    }
}
// audio end

// inputs range start

// sidebar input start
song_length_input.addEventListener('input', function () {
    // input value
    let current_range_value = song_length_input.value;
    let maxValue = song_length_input.getAttribute('max');
    let audio_duration = audioEle.duration;
    let current_duration = (current_range_value / maxValue) * audio_duration;
    audioEle.currentTime = current_duration;

    let mminute = Math.floor(current_duration / 60).toString().padStart(2, '0');
    let ssecond = Math.floor(current_duration % 60).toString().padStart(2, '0');
    minute.textContent = mminute;
    second.textContent = ssecond;
})
// sidebar input end


// main input start
if(main_input_range) {
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
}
// main input end

// volume controller start
volume_input.addEventListener('input', function () {
    audioEle.volume = volume_input.value / 100;
    if(audioEle.volume == 0) {
        mute_btn.classList.remove('fa-volume-high');
        mute_btn.classList.add('fa-volume-xmark');
    }else {
        mute_btn.classList.remove('fa-volume-xmark');
        mute_btn.classList.add('fa-volume-high');
    }
});
//volume controller end
// inputs range end

// audio player timeout start
var myInterval = setInterval(() => {
    if(is_playing) {
        if(audioEle.currentTime == audioEle.duration) {
            is_playing = false; 
            autoPlay();
        };
        let currentMinute = Math.floor(audioEle.currentTime / 60);
        let currentSecond = Math.floor(audioEle.currentTime % 60); 
        setStartTime(currentMinute, currentSecond);
        setValuetoTimeRange();
        if(main_input_range) {
            setValuetoMainTimeRange();
        }
    }
}, 1000);
// audio player timeout end

// buttons actions start
playBtns.forEach(playBtn => {
    playBtn.addEventListener('click', function () {
        for(let i=0; i<document.getElementsByClassName('forInput').length; i++) {
            document.getElementsByClassName('forInput')[i].classList.remove('mute_input'); 
        }
        if(is_done_track) {
            currentIndex = 0;
            playByOwn(currentIndex);
            is_done_track = false;
        }
        if(currentIndex === null) {
            currentIndex = 0;
            playByOwn(currentIndex);
        }
        setMusic(audioEle);

        playBtns.forEach((item, index) => {
            item.classList.add("d-none");
            stopBtns[index].classList.remove("d-none");
        });
        is_playing = true;
        audioEle.play();
    })
});

stopBtns.forEach(stopBtn => {
    stopBtn.addEventListener('click', function () {
        stopBtns.forEach((item, index) => {
            item.classList.add("d-none");
            playBtns[index].classList.remove("d-none");
        });
        is_playing = false;
        audioEle.pause();
    })
});

nextBtns.forEach(nextBtn => {
    nextBtn.addEventListener('click', function () {
        if(is_done_track) {
            currentIndex = 0;
        } else if(currentIndex === null) {
            currentIndex = 0;
        } else{
            currentIndex = currentIndex + 1;
        }
        
        if(currentIndex > trackLists.length - 1) {
            currentIndex = 0;
        }
        playByOwn(currentIndex);
    })
})

prevBtns.forEach(prevBtn => {
    prevBtn.addEventListener('click', function () {
        
        currentIndex = currentIndex - 1;
        if(currentIndex < 0) {
            currentIndex = trackLists.length - 1;
            playByOwn(currentIndex);
        } else {
            playByOwn(currentIndex);
        }
    })
})
// button actions end

function playlistPlay() {
    currentIndex = 0;
    trackLists = temp_trackList;
    playByOwn(currentIndex);
}

// auto play start
function autoPlay () {
    currentIndex = currentIndex + 1;
    if(trackLists.length - 1 >= currentIndex) {
        playByOwn(currentIndex);
    } else {
        currentIndex = trackLists.length - 1;
        is_done_track = true;
        oneStop.click();
    }
}

function playByOwn (songIndex) {
    song_length_input.value = 0;
    saveCurrentIndexToSession(songIndex);
    let currentId = trackLists[Number(currentIndex)].id;
    saveTracklistsToSession(trackLists);
    setNowPlaying(currentId);
    let responseData = trackLists[songIndex];
    var current_title = document.querySelectorAll('#current_title');
    var current_artist = document.querySelectorAll('#current_artist');
    var current_cover = document.querySelectorAll('#current_cover');
    var last_title = document.querySelector('.cur_expanded_title');
    current_title.forEach((item, index) => {
        item.textContent = responseData.title;
        current_artist[index].textContent = responseData.artist;
        current_cover[index].src = "./assets/covers/" + responseData.cover;
    });
    last_title.textContent= responseData.title;
    audioEle.src = "./tracks/" + responseData.audio_url;
        setStartTime(0, 0);
        if(main_input_range) {
            main_input_range.value = 0;
        }
        setTimeout(()=> {
            audioEle.play();
            is_playing = true;
            onePlay.click();
        }, 100);
}
// auto play end

function init() {
    beforeGetAll();
    audioEle.volume = 0.25;
}

init();