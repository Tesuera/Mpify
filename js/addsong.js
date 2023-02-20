var instead_cover = document.querySelector('#instead_cover');
var add_cover_input = document.querySelector('#cover_input');
var addForm = document.querySelector('#addForm');
var addBtn = document.querySelector('#add_song_btn');
var instead_selectTrack = document.querySelector('#instead_select_track');
var selectTrack = document.querySelector('#select_track');

instead_cover.addEventListener('click', () => {
    add_cover_input.click();
});

instead_selectTrack.addEventListener('click', () => {
    selectTrack.click();
})

add_cover_input.addEventListener('change', (e) => {
    let xml = new XMLHttpRequest();
    xml.open("post", "./_actions/addtempphoto.php");
    xml.addEventListener('load', function() {
        if(this.readyState == this.DONE && this.status == 200) {
            let datas = JSON.parse(this.response)
            if(datas.status == 200) {
                instead_cover.style.backgroundImage = "url('./assets/before/" + datas.info + "')"
            } else if(datas.status == 420) {
                console.log(datas);
            }
        }
    });
    let data = new FormData(addForm);
    xml.send(data);
});

function getFirstTrackLists () {
    let xml = new XMLHttpRequest();
    xml.open('get', './getters/getsonglists.php');
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            responseData = JSON.parse(this.response);
            if(responseData.length) {
                trackLists  = responseData;
            } else {
                trackLists = [];
            }
        }
    });
    xml.send();
}

addBtn.addEventListener('click', function (e) {
    e.preventDefault();
    let xml = new XMLHttpRequest();
    xml.open('post', './_actions/addSong.php');
    xml.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            let datas = JSON.parse(this.response);
            if(datas.status == 200) {
                if(!trackLists.length) {
                    getFirstTrackLists();
                }
                document.querySelector('#land_sidebar').click();
                addForm.reset();
                instead_cover.style.backgroundImage = "url()";
            } else if(datas.status == 420) {
                console.log(datas);
            }
        }
    });
    let form = new FormData(addForm);
    xml.send(form);
});