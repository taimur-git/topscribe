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
    let confirm = window.confirm("Do you wish to delete this writing?");
    if(confirm){
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            //location.reload();
            window.location.href = "index.php";
            }
        };
        xmlhttp.open("GET","function/deleteWriting.php?writeid="+id,true);
        xmlhttp.send();
    }
    
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
        location.reload();
        }
    };
    xmlhttp.open("GET","function/addContact.php?writer="+writer,true);
    xmlhttp.send();
}

function removeContact(writer){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
        console.log(this.responseText);
        location.reload();
        }
    };
    xmlhttp.open("GET","function/removeContact.php?writer="+writer,true);
    xmlhttp.send();
}


var items = document.getElementsByClassName("fade-item");
for (let i = 0; i < items.length; ++i) {
fadeIn(items[i], i * 1000)
}
function fadeIn (item, delay) {
setTimeout(() => {
item.classList.add('fadein')
}, delay)
}


function slideInTopWritings(){
    let writing = document.getElementsByClassName('top-article');
    console.log('hovering')
    for(let i =0;i<writing.length;i++){
        writing[i].classList.remove('hidden');
        writing[i].classList.add('animate__animated');
        writing[i].classList.add('animate__fadeIn');
        writing[i].classList.add('animate__slideInDown');
        
    }
    //remove classes: hidden
    //add classes: animate__animated animate__slideInDown
    
/*
function renderView(val){
    let val2 = document.getElementById("searchTerm").value;
    //console.log(val);
    let change = document.getElementById("touchThis");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
        change.innerHTML = this.responseText;
        //location.reload();
        }
    };
    xmlhttp.open("GET","function/searchWriting.php?search="+val2,true);
    xmlhttp.send();
}
*/

    
    
function renderView(){
    const orderElement = document.getElementById("orderSelect");
    const sortElement = document.getElementById("sortSelect");
    const searchElement = document.getElementById("searchTerm");
    let val = searchElement.value;
    let order = orderElement.value;
    let sort = sortElement.value;
    if(order=="0"){
        sortElement.classList.add("hidden");
    }else{
        sortElement.classList.remove("hidden");
    }
    
    let change = document.getElementById("touchThis");
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200){
        change.innerHTML = this.responseText;
        //location.reload();
        }
    };
    xmlhttp.open("GET","function/searchWriting.php?search="+val+"&order="+order+"&sort="+sort,true);
    xmlhttp.send();

    //renderView(val);
}