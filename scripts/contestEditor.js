const help = document.getElementById("subcategory-help");
const deadline = document.getElementById("deadline");
const starttime = document.getElementById("start-time");
console.log("https://static.vecteezy.com/system/resources/previews/000/382/407/original/vector-beautiful-creative-wave-banner-template-design.jpg");
console.log("https://static.vecteezy.com/system/resources/previews/000/664/622/original/abstract-banner-design-vector.jpg");
console.log("https://static.vecteezy.com/system/resources/previews/000/381/578/original/vector-abstract-colorful-wave-banner-background.jpg");
function changeBannerImg(){
  document.getElementById("banner-img").src = document.getElementById("banner-url").value;
}
const tooltip = document.querySelector('#tooltip');
var simplemde = new SimpleMDE({ 
    element: document.getElementById("simplemde"),
    spellChecker: false,
 });

 changeTooltip();
function changeTooltip(){
    let select = document.getElementById("category-select");
    let category = select.options[select.selectedIndex].value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        let description = this.responseText;
        tooltip.innerHTML = description;
        const popperInstance = Popper.createPopper(help,tooltip,{
            placement: 'right-start',
            modifiers: [
                {
                  name: 'offset',
                  options: {
                    offset: [0, 8],
                  },
                },
              ],
        });
        popperInstance.update();
    }
    };
    xmlhttp.open("GET","function/subcategoryToolTip.php?subid="+category,true);
    xmlhttp.send();
}

function show() {
    tooltip.setAttribute('data-show', '');
  
    // We need to tell Popper to update the tooltip position
    // after we show the tooltip, otherwise it will be incorrect
    
  }
  
  function hide() {
    tooltip.removeAttribute('data-show');
  }
  
  const showEvents = ['mouseenter', 'focus'];
  const hideEvents = ['mouseleave', 'blur'];
  
  showEvents.forEach((event) => {
    help.addEventListener(event, show);
  });
  
  hideEvents.forEach((event) => {
    help.addEventListener(event, hide);
  });