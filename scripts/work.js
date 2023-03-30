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

