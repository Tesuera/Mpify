var btn = document.querySelector('#saveChangeBtn');

btn.addEventListener('click', function () {
    let formData = new FormData(document.querySelector('#changeform'));
    let xhr = new XMLHttpRequest();
    xhr.open('post', './_actions/changeProfile.php');
    xhr.addEventListener('load', function () {
        if(this.readyState == this.DONE && this.status == 200) {
            console.log(this.response);
            let responseData = JSON.parse(this.response);
            if(responseData.status === 200) {
                document.querySelector('#redirect_to_profile').click();
                document.querySelector('#error_email').textContent = '';
                document.querySelector('#error_name').textContent = '';
            } else if(responseData.status === 400) {
            if(responseData.errors.email) {
                document.querySelector('#error_email').textContent = responseData.errors.email;
            } else {
                document.querySelector('#error_email').textContent = '';
            }
            if(responseData.errors.name) {
                document.querySelector('#error_name').textContent = responseData.errors.name;
            } else {
                document.querySelector('#error_name').textContent = '';
            }
            }
        }
    });
    xhr.send(formData);
});