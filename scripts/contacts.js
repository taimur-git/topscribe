window.onload = function() {
    //dragula([document.getElementById('left'), document.getElementById('right'),document.getElementById('right1')]);
    //'drag-section'
    dragula([...document.getElementsByClassName('drag-section')]);
    //dragula([document.getElementById('left'),document.getElementById('right1')]);
    //dragula([document.getElementById('right'),document.getElementById('right1')]);
}
//dragula([document.getElementById(left), document.getElementById(right)]);
/*
dragula([document.getElementById(left), document.getElementById(right)], {
  copy: function (el, source) {
    return source === document.getElementById(left)
  },
  accepts: function (el, target) {
    return target !== document.getElementById(left)
  }
});
//copying elements

dragula([document.getElementById(single)], {
  removeOnSpill: true
});
//removes on spill

*/