const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))

function checkUser(){
    let username = document.getElementById('username');
    let feedback = document.getElementById('feedback');
    let uname = username.value;
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        let x = this.responseText;
        console.log(uname);
        if(uname.length==0){
            feedback.className = 'invalid-feedback';
            feedback.innerText = 'Please enter username';
        }else{
            if(x==1){
            username.className = 'form-control is-invalid';
            feedback.className = 'invalid-feedback';
            feedback.innerText = 'Username is taken';
            }else{
            username.className = 'form-control is-valid';
            feedback.className = 'valid-feedback';
            feedback.innerText = 'Username is free';
            }
        }
        }
    };
    xmlhttp.open("GET","function/findUser.php?uname="+uname,true);
    xmlhttp.send();
}
function toggleBookmark(writing){
    var xmlhttp = new XMLHttpRequest();
    let bookmark = document.getElementById("bookmark").classList.contains('fa-solid');
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        document.getElementById("bookmark").classList.toggle('fa-regular');
        document.getElementById("bookmark").classList.toggle('fa-solid');
        }
    };
    if(bookmark){
        xmlhttp.open("GET","function/removeBookmark.php?writeid="+writing,true);
    }else{
        xmlhttp.open("GET","function/addBookmark.php?writeid="+writing,true);
    }
    xmlhttp.send();
}

function deleteWriting(id){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
        }
    };
    xmlhttp.open("GET","function/deleteWriting.php?writeid="+id,true);
    xmlhttp.send();
}

function imgChange(){
    let img = document.getElementById("imgurl").value;
    let button = document.getElementsByClassName("fa-plus")[0];
    let photo = document.getElementsByClassName("registration-profile")[0];
    photo.src = img;
    if(img){
        //hide the icon unless its hovered over.
        button.classList.add("hoverhidden");
        img.classList.add("hoverhidden");
    }
}

function toggleImgInput(){
    let button = document.getElementsByClassName("fa-plus")[0];
    button.classList.toggle("rotated");
    let img = document.getElementById("imgurl");
	img.classList.toggle("hidden");
}

async function copyToClipboard() {
    let url = window.location.href;
    await navigator.clipboard.writeText(url);
}

function addContact(writer){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
        console.log(this.responseText);
        }
    };
    xmlhttp.open("GET","function/addContact.php?writer="+writer,true);
    xmlhttp.send();
}