var simplemde = new SimpleMDE({ 
    element: document.getElementById("simplemde"),
    toolbar: false,
    status: ["words"],
    spellChecker: false,
 });
 simplemde.togglePreview();
//console.log(simplemde.status);
 particlesJS.load('particles-js', 'assets/particles.json', function() {
    console.log('callback - particles.js config loaded');
  });

 function downloadPDF(){
let x = simplemde.value();
 }