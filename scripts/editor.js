var simplemde = new SimpleMDE({ element: document.getElementById("simplemde") });

const help1 = document.getElementById("subcategory-help");
const help2 = document.getElementById("subcategory-help2");
const tooltip = document.querySelector('#tooltip');
const autoGenBox = document.getElementById("flexSwitchCheckChecked");
const topicDiv = document.getElementById("topicDiv");
if(help1!=null){changeTooltip();}
if(help2!=null){createPopperHelp2();}

function changeTooltip(){
    let select = document.getElementById("category-select");
    let category = select.options[select.selectedIndex].value;
    
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        let description = this.responseText;
        tooltip.innerHTML = description;
        const popperInstance = Popper.createPopper(help1,tooltip,{
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
function createPopperHelp2(){
    const popperInstance = Popper.createPopper(help2,tooltip,{
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
    if(help1!=null){help1.addEventListener(event, show);}
    if(help2!=null){help2.addEventListener(event, show);}
    
    
  });
  
  hideEvents.forEach((event) => {
    if(help1!=null){help1.addEventListener(event, hide);}
    if(help2!=null){help2.addEventListener(event, hide);}
    
    
  });


//(autoGenBox.checked)
function boxClicked(){
    topicDiv.classList.toggle("hidden");
}
const topicsinput = document.getElementById("topic-input");
topicsinput.addEventListener("keypress",function(event){
    if (event.key === "Enter") {
        event.preventDefault();
        addTopic();
    }   
});
function addTopic(){
    value = topicsinput.value.toLowerCase().replace(/[^a-z0-9 -]/g, '');;
    value.trim();
    if(value!=""){
        addTopicVal(value);
        document.getElementById("topic-input").value ="";
    }
    
}
//
let topicsSet = new Set();
function addTopicVal(value){
    topicsSet.add(value);
    renderTopics();
}

function renderTopics(){
    topics = document.getElementById("topics-display");
    str ="";
    topicsSet.forEach(element=>{
        str += "<span class='badge rounded-pill bg-light' onclick='removeTopic(this.innerText)'>"+element+"</span>";
    });
    topics.innerHTML = str;
}
function generateRandomTopic(){
    //let arr = "random topic";
    //addTopicVal(arr);
}
function removeTopic(value){
    topicsSet.delete(value);
    renderTopics();
}
function getTopics(){
    topics = document.getElementById("topics-display");
}
function generateTopics(){
    let hidden = document.getElementById('hidetopic');
    let val = JSON.stringify([...topicsSet]);
    hidden.value = val;
    return val;
}

function test(){
    let topics = generateTopics();
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
        console.log(this.responseText);
    }
    };
    xmlhttp.open("GET","function/test.php?topics="+topics,true);
    xmlhttp.send();
}