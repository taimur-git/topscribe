var simplemde = new SimpleMDE({ 
    element: document.getElementById("simplemde"),
    toolbar: false,
    status: false,
    spellChecker: false,
 });
 simplemde.togglePreview();

 particlesJS.load('particles-js', 'assets/particles.json', function() {
    console.log('callback - particles.js config loaded');
  });

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