$('document').ready(function(){
  $('.btncommentClass').click(function(){   
    
       sel = document.getElementById("js-id");
    var id = sel.options[sel.selectedIndex].value;
    // alert (id);
    // KpImportance = getValueById("KpImportance");
        sel = document.getElementById("KpImportance");
    var KpImportance = sel.options[sel.selectedIndex].value;
        sel = document.getElementById("Responsible");
    var Responsible = sel.options[sel.selectedIndex].value;
    var Comment = $('#textarea-Comment').val(); // берем данные из тексарии коментария
        sel = document.getElementById("DateNextCall");
    var DateNextCall = sel.value;
        sel = document.getElementById("KpCondition");
    var KpCondition = sel.options[sel.selectedIndex].value;
        sel = document.getElementById("KpSum");
    var KpSum = sel.value;
        sel = document.getElementById("FinishContract");
    var FinishContract = sel.value;
    
    // var Adress = $('#textarea-Adress').val(); // берем данные из тексарии коментария
        sel = document.getElementById("textarea-Adress");
   var Adress = sel.value;
      
    $.ajax({  // отправляем запрос на обновление БД
      url: "changedb/update_all_zakup.php",
      method: 'POST',             /* Метод передачи (post или get) */
      dataType: 'html',
      data: {id:id,
        KpImportance:KpImportance,
        Responsible:Responsible,
        Comment:Comment,
        DateNextCall:DateNextCall,
        KpCondition:KpCondition,
        KpSum:KpSum,
        FinishContract:FinishContract,
        Adress:Adress
      },
      success: function(data){
        
        // alert ('ОБНОВЛЕНИЕ ПРОШЛО УСПЕШНО  ' + data);
        getParent('.is-show', '.js-modal');
        
        var obj = jQuery.parseJSON( data ); // парсим объем на переменные
        var id = String(obj['id']);
        var KpImportance = String(obj['KpImportance']);
        var Responsible = String(obj['Responsible']);
        var Comment = String(obj['Comment']);
        var DateNextCall = String(obj['DateNextCall']);
        var KpCondition = String(obj['KpCondition']);
        var KpSum = String(obj['KpSum']);
        var FinishContract = String(obj['FinishContract']);
        var Adress = String(obj['Adress']);
        // alert (Comment);
        ///////////// ОБНОВЛЕНИЕ ДАННЫХ В НАШЕЙ ТАБЛИЦЕ***********************************
        var find= 'js-KpImportance' + id;
        sel = document.getElementById(find);
        sel.innerHTML = KpImportance;
        sel.style.color="blue";

        find= 'js-Responsible' + id;
        sel = document.getElementById(find);
        sel.innerHTML = Responsible;
        sel.style.color="blue";

        find= 'js-comment' + id;
        sel = document.getElementById(find);
        sel.innerHTML = Comment;
        sel.style.color="blue";
      
        find= 'js-DateNextCall' + id;
        sel = document.getElementById(find);
        sel.innerHTML = DateNextCall;
        sel.style.color="blue";

        find= 'js-KpCondition' + id;
        sel = document.getElementById(find);
        sel.innerHTML = KpCondition;
        sel.style.color="blue";

        find= 'js-KpSum' + id;
        sel = document.getElementById(find);
        sel.innerHTML = KpSum;
        sel.style.color="blue";

        find= 'js-FinishContract' + id;
        sel = document.getElementById(find);
        sel.innerHTML = FinishContract;
        sel.style.color="blue";

        find= 'js-Adress' + id;
        sel = document.getElementById(find);
        sel.innerHTML = Adress;
        sel.style.color="blue";

      }
   });
   });
  });
 
// var find= 'js-comment' + 2228;
// alert (find);
// sel = document.getElementById(find);
// console.log('SEL=' + sel);
// var NewCom = sel.innerHTML;
// alert ('УСПЕШНО  ' + NewCom);
// sel.innerHTML = 4444444;   