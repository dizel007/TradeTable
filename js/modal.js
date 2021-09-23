//// Заполняем модальное окно актуальными значениями 
$(document).ready(function($){
  $('.js-open-modal').on("click",function(event){
    //  alert ( event.target.id);
     id = event.target.id;
     document.getElementById("textarea-Comment").value=""; // Всегда чистим ТехтАриа в комментах при открытии окна
  $.ajax(  {
    url: "functions/get_one_item.php",
    method: 'POST',             /* Метод передачи (post или get) */
    dataType: 'html',
    data: {id:id},
    success: function(data){
      var obj = jQuery.parseJSON( data ); // парсим объем на переменные
      var KpNumber = String(obj[0]["KpNumber"]); // парсим объем на переменные
      var InnCustomer = String(obj[0]["InnCustomer"]);
      var NameCustomer = String(obj[0]["NameCustomer"]);
      var idKp = String(obj[0]["idKp"]);
      var KpImportance = String(obj[0]["KpImportance"]);
      var Responsible = String(obj[0]["Responsible"]);
      var Comment = String(obj[0]["Comment"]);
      var DateNextCall = String(obj[0]["DateNextCall"]);
      var KpCondition = String(obj[0]["KpCondition"]);
      var KpSum = String(obj[0]["KpSum"]);
      var TenderSum = String(obj[0]["TenderSum"]);
      var FinishContract = String(obj[0]["FinishContract"]);
      var Adress = String(obj[0]["Adress"]);

      document.getElementById("js-new-modal-id").innerHTML = id;
      document.getElementById('js-new-modal-id').value = id;
      document.getElementById("js-new-modal-KpNumber").innerHTML = KpNumber;
      document.getElementById("js-new-modal-InnCustomer").innerHTML = InnCustomer;
      document.getElementById("js-new-modal-NameCustomer").innerHTML = NameCustomer;
      document.getElementById("js-new-modal-idKp").innerHTML = idKp;
      document.getElementById("js-new-modal-KpImportance").innerHTML = KpImportance; // отображаемое значение
      document.getElementById('js-new-modal-KpImportance').value = KpImportance; // value  - коде
      document.getElementById("js-new-modal-Responsible").innerHTML = Responsible; // отображаемое значение
      document.getElementById('js-new-modal-Responsible').value = Responsible; // value  - коде
      document.getElementById("js-new-modal-Comment").innerHTML = Comment; // отображаемое значение
      document.getElementById('js-new-modal-Comment').value = Comment; // value  -  коде
      document.getElementById("DateNextCall").innerHTML = DateNextCall; // отображаемое значение
      document.getElementById('DateNextCall').value = DateNextCall; // value  - коде
      document.getElementById("js-new-modal-KpCondition").innerHTML = KpCondition; // отображаемое значение
      document.getElementById('js-new-modal-KpCondition').value = KpCondition; // value  - коде
      document.getElementById('KpSum').value = KpSum; // value  - коде
      document.getElementById("js-new-modal-TenderSum").innerHTML = TenderSum;
      document.getElementById("js-new-modal-FinishContract").innerHTML = FinishContract; // отображаемое значение
      document.getElementById('js-new-modal-FinishContract').value = FinishContract; // value  - коде
      document.getElementById("textarea-Adress").innerHTML = Adress; // отображаемое значение
      document.getElementById('textarea-Adress').value = Adress; // value  -  коде
      }

   });
});
});

/// открываем модальное окно
$('.js-open-modal').click(function(){

  var modalName = $(this).attr('data-modal');
  console.log(modalName);
  var modal = $('.js-modal[data-modal = "' + modalName + '"]');
  modal.addClass('is-show');

});
function getParent(elemSelector, parentSelector) {
  var elem = document.querySelector(elemSelector);
  var parents = document.querySelectorAll(parentSelector);
  
  for (var i = 0; i < parents.length; i++) {
    var parent = parents[i];
    
    if (parent.contains(elem)) {
      var attr = parent.getAttribute('data-modal');
      var modal = $('.js-modal[data-modal = "' + attr + '"]');
      modal.removeClass('is-show');
      
    }
  }
  return null;
}   
/// Закрываем модальное окно
$('.js-modal-close').click(function() {
getParent('.is-show', '.js-modal');
});


