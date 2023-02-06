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