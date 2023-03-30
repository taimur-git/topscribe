function updateContactToGroup(gid,uid,remove=false){
  let hidden = document.getElementById('contact-array'+gid);
  let set = new Set(JSON.parse(hidden.value));//current value
  if(remove){
    set.delete(uid);
  }else{
    set.add(uid);
  }
  let val = JSON.stringify([...set]);
  hidden.value = val;
  updateGroup(gid,val);
  return val;
}

function updateGroup(gid,val){
  //let name = document.getElementById('group-name').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      //window.location.reload();
    }
  };
  xmlhttp.open("GET","function/updateGroup.php?gid="+gid+"&garray="+val,true);
  xmlhttp.send();
}

function updateGroupName(gid,groupname){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      //window.location.reload();
    }
  };
  xmlhttp.open("GET","function/updateGroupName.php?gid="+gid+"&groupname="+groupname,true);
  xmlhttp.send();
}

window.onload = function() {
    var drake = dragula([...document.getElementsByClassName('drag-section')],{
      copy: function(e1,source){
        return source === document.getElementById('left');
      },
      accepts: function(e1,target){
        
        //console.log(target.childNodes);
        //console.log(e1);
        /*
        flag = true;
        //console.log(el);
        for(let el2 of target.childNodes){
          if(el2.innerHTML===e1.innerHTML){
              flag=false;
          }
          //console.log(el);
        }
        */
        //console.log(flag);(!target.contains(e1))
        return target !== document.getElementById('left');//&&flag);
        //add a condition that the element doesnt already exist.
      },
      removeOnSpill: function(e1,target){
        return target !== document.getElementById('left');
      },
      moves: function (el, source, handle, sibling) {
        return [...document.getElementsByClassName('draggable')].includes(el); // elements are always draggable by default
      },
    });
    //drake.containers.push(container);
    drake.on('drop',function(el,target,source){
      let gid = +target.attributes.gid.value;
      let uid = +el.attributes.uid.value;
      let sid = +source.attributes.gid.value;
      //if gid=0 it means its from contact list
      updateContactToGroup(gid,uid);
      if(sid!==0){
        updateContactToGroup(sid,uid,true);
      }
    });
    drake.on('remove',function(el,source){
      let uid = +el.attributes.uid.value;
      let sid = +source.attributes.gid.value;
      if(sid!==0){
        updateContactToGroup(sid,uid,true);
      }
    });
}
//attributes.uid.value
function addGroup(){
  let name = document.getElementById('group-name').value;
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      window.location.reload();
  }
  };
  xmlhttp.open("GET","function/addGroup.php?groupname="+name,true);
  xmlhttp.send();
}

function removeGroup(gid){
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200) {
      console.log(this.responseText);
      window.location.reload();
  }
  };
  xmlhttp.open("GET","function/removeGroup.php?gid="+gid,true);
  xmlhttp.send();
}
/*
let returnArray = document.getElementById('contact-array');
returnArray.value = "";
*/
