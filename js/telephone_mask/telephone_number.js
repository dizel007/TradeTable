$(document).ready(function(){
 
  $("#phone2").mask("+7(999) 999-99-99");
   
});
// СКРИПТ для установки курсора в начальное положение при нажатии на окно
$.fn.setCursorPosition = function(pos) {
  if ($(this).get(0).setSelectionRange) {
    $(this).get(0).setSelectionRange(pos, pos);
  } else if ($(this).get(0).createTextRange) {
    var range = $(this).get(0).createTextRange();
    range.collapse(true);
    range.moveEnd('character', pos);
    range.moveStart('character', pos);
    range.select();
  }
};
$("#phone2").click(function(){
  document.getElementById("phone2").value = "";
  $(this).setCursorPosition(3);
}).mask("+7(999) 999-9999");
