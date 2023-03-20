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
/*
function addBookmark(writing){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
//tcp added to bookmark!
//console.log(this.responseText);
document.getElementById("bookmark").classList.add('fa-solid');
document.getElementById("bookmark").classList.remove('fa-regular');
document.getElementById("bookmark").onclick = removeBookmark(writing);
        }
    };
    xmlhttp.open("GET","function/addBookmark.php?writeid="+writing,true);
    xmlhttp.send();
}
function removeBookmark(writing){
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
//tcp added to bookmark!
//console.log(this.responseText);
document.getElementById("bookmark").classList.add('fa-regular');
document.getElementById("bookmark").classList.remove('fa-solid');
document.getElementById("bookmark").onclick = addBookmark(writing);
        }
    };
    xmlhttp.open("GET","function/removeBookmark.php?writeid="+writing,true);
    xmlhttp.send();
}
*/
function toggleBookmark(writing){
    var xmlhttp = new XMLHttpRequest();
    let bookmark = document.getElementById("bookmark").classList.contains('fa-solid');
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
//tcp added to bookmark!
//console.log(this.responseText);
if(bookmark){
    document.getElementById("bookmark").classList.add('fa-regular');
    document.getElementById("bookmark").classList.remove('fa-solid');
}else{
    document.getElementById("bookmark").classList.add('fa-solid');
    document.getElementById("bookmark").classList.remove('fa-regular');
}
        }
    };
    if(bookmark){
        xmlhttp.open("GET","function/removeBookmark.php?writeid="+writing,true);
    }else{
        xmlhttp.open("GET","function/addBookmark.php?writeid="+writing,true);
    }
   // xmlhttp.open("GET","function/removeBookmark.php?writeid="+writing,true);
    xmlhttp.send();
}