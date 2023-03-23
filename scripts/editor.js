var simplemde = new SimpleMDE({ element: document.getElementById("simplemde") });
//simplemde.value();
const help = document.getElementById("subcategory-help");
const tooltip = document.querySelector('#tooltip');
changeTooltip();
function changeTooltip(){
    let select = document.getElementById("category-select");
    let category = select.options[select.selectedIndex].value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        let description = this.responseText;
        //let popover = help.data('popover');
        //help.attr('data-content',description);
        //popover.setContent();
//        popover.classList.toggle
        console.log(description);
        tooltip.innerHTML = description;
        //document.getElementById("subcategory-help").data-bs-content = this.responseText;
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


function initHelp(){
    let help = document.getElementById("subcategory-help");
    
}
//subcategory-help
/*
function getCheckedCheckboxesFor(checkboxName) {
var checkboxes = document.querySelectorAll('input[name="' + checkboxName + '"]:checked'), values = [];
Array.prototype.forEach.call(checkboxes, function(el) {
values.push(el.value);
});
return values;
}
*/