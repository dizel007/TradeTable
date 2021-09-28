//// Заполняем модальное окно актуальными значениями 
$(document).ready(function($){
  $('.js-open-modal').on("click",function(event){
// открываем модальное окно
    modalName = $(this).attr('data-modal');
    modal = $('.js-modal[data-modal = "' + modalName + '"]');
    modal.addClass('is-show');
 // вычитываем переменные
    id = event.target.id;
  document.getElementById("textarea-Comment").value=""; // Всегда чистим ТехтАриа в комментах при открытии окна
  
  $.ajax(  {
          url: "functions/get_one_item.php",
          method: 'POST',             /* Метод передачи (post или get) */
          dataType: 'html',
          cache: false,
          data: {id:id},
         success: function(data){
                      obj = jQuery.parseJSON( data ); // парсим объем на переменные
                      KpNumber = String(obj[0]["KpNumber"]); // парсим объем на переменные
                      InnCustomer = String(obj[0]["InnCustomer"]);
                      NameCustomer = String(obj[0]["NameCustomer"]);
                      idKp = String(obj[0]["idKp"]);
                      KpImportance = String(obj[0]["KpImportance"]);
                      Responsible = String(obj[0]["Responsible"]);
                      Comment = String(obj[0]["Comment"]);
                      DateNextCall = String(obj[0]["DateNextCall"]);
                      KpCondition = String(obj[0]["KpCondition"]);
                      KpSum = String(obj[0]["KpSum"]);
                      TenderSum = String(obj[0]["TenderSum"]);
                      FinishContract = String(obj[0]["FinishContract"]);
                      Adress = String(obj[0]["Adress"]);

      document.getElementById("js-new-modal-id").innerHTML = id;
      document.getElementById('js-new-modal-id').value = id;
      document.getElementById("js-new-modal-KpNumber").innerHTML = KpNumber;
      document.getElementById("js-new-modal-InnCustomer").innerHTML = InnCustomer;
      document.getElementById("js-new-modal-NameCustomer").innerHTML = NameCustomer;
      document.getElementById("js-new-modal-idKp").innerHTML = idKp;
      // document.getElementById("js-new-modal-KpImportance").innerHTML = KpImportance; // отображаемое значение
      // document.getElementById('js-new-modal-KpImportance').value = KpImportance; // value  - коде
      // document.getElementById("js-new-modal-Responsible").innerHTML = Responsible; // отображаемое значение
      // document.getElementById('js-new-modal-Responsible').value = Responsible; // value  - коде
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

      document.getElementById("Responsible").value=Responsible; // изменям options в Select
      document.getElementById("Responsible").text=Responsible; //изменям options в Select
      var elem = document.getElementById("Responsible").options[0]; // делаем этот отшинс активным

      document.getElementById("KpImportance").value=KpImportance;
      document.getElementById("KpImportance").text=KpImportance;
       var elem1 = document.getElementById("KpImportance").options[0];
 
      }

   });

});
});

/// открываем модальное окно
// $('.js-open-modal').click(function(){

//   var modalName = $(this).attr('data-modal');
//   console.log(modalName);
//   var modal = $('.js-modal[data-modal = "' + modalName + '"]');
//   modal.addClass('is-show');

// });

  
/// Закрываем модальное окно
$('.js-modal-close').click(function() {
getParent('.is-show', '.js-modal');
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