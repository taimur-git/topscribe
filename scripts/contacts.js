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