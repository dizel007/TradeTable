<?php
echo <<<HTML
  <div class="dm-overlay js-modal " data-modal = "write_comment">
     <div class="dm-table">
          <div class="dm-cell">
              <div class="dm-modal"  >
                  <!-- <a href="#close" class="close js-modal-close"></a> -->
                  <a class="close js-modal-close"></a>
HTML;


// for ($i=0; $i<count($arr_name); $i++){

    // foreach ($arr_name as $key => $value) 
    //   {
    //     foreach ($value as $key1 => $value1) {
    //         if ($key1 == 'Responsible') {
    //             $Responsible   = $value1;
    //           }
    //           if ($key1 == 'KpImportance') {
    //             $KpImportance   = $value1;
    //         }
    //         if ($key1 == 'DateNextCall') {
    //           $DateNextCall   = $value1;
    //       }
    //       if ($key1 == 'KpCondition') {
    //         $KpCondition   = $value1;
    //     }
    //     if ($key1 == 'FinishContract') {
    //       $FinishContract   = $value1;
    //           }
    //           if ($key1 == 'KpSum') {
    //             $KpSum   = $value1;
    //                 }
    //       }
    //     }
// $id = $arr_name[$i]['id'];
// $pp = $arr_name[$i]['pp'];
// $KpNumber = $arr_name[$i]['KpNumber'];
// $KpData = $arr_name[$i]['KpData'];
// $InnCustomer = $arr_name[$i]['InnCustomer'];
// $NameCustomer = $arr_name[$i]['NameCustomer'];
// $ContactCustomer = $arr_name[$i]['ContactCustomer'];
// $idKp = $arr_name[$i]['idKp'];
// $StatusKp = $arr_name[$i]['StatusKp'];
// $Comment = $arr_name[$i]['Comment'];
// $TenderSum = $arr_name[$i]['TenderSum'];
// $Adress = $arr_name[$i]['Adress'];
      // }

$i=0;
$Responsible   = "";
$KpImportance  = "";
$DateNextCall  = "";
$KpCondition = "";
$FinishContract = "";
$KpSum   = "";
$id = "";
$pp = "";
$KpNumber = "";
$KpData = "";
$InnCustomer = "";
$NameCustomer = "";
$ContactCustomer = "";
$idKp = "";
$StatusKp = "";
$Comment = "";
$TenderSum = "";
$Adress = "";
$dateContract="";
$procent_work="";
$dateFinishContract="";
echo <<<HTML
  <div>
    <select id = "js-id" name="id">
      <option id ="js-new-modal-id" value ="$id">$id</option>
    </select>
  </div>

 <div><b> Номер КП : <span id="js-new-modal-KpNumber">$KpNumber</span></b></div>
 <!-- <div>Дата КП :$KpData</div> -->
 <div>ИНН Заказчика :<span id="js-new-modal-InnCustomer">$InnCustomer</span></div>
 <div><b>Наименование Заказчика :<span id="js-new-modal-NameCustomer">$NameCustomer</span></b></div>
  <hr>
<div>ID  закупки :<span id="js-new-modal-idKp">$idKp</span></div>
  <hr>
<!-- <div>Статус КП : <span id="js-new-modal-StatusKp">$StatusKp</span></div> -->
     
<div> 
<p>Важность :
    <select id="KpImportance" size="1" name="KpImportance">
      <option id="js-new-modal-KpImportance" selected value="$KpImportance">$KpImportance</option>  
      <option value="Нейтрально">Нейтрально</option>
      <option value="Важно">Важно</option>
      <option on value="Очень важно">Очень важно</option>
    </select>
</p>
 </div>

<div> 
  <p>Ответственный
    <select id="Responsible" size="1" name="Responsible">
        <option id="js-new-modal-Responsible" selected value = "$Responsible">$Responsible</option>
HTML;

for ($i=0; $i<count($arr_users_active); $i++) {
  $user_name = $arr_users_active[$i]['user_name'];
  echo "<option value=\"$user_name\">$user_name</option>";
  }
        // <option value="Гуц">Гуц</option>
        // <option value="Горячев">Горячев</option>
        // <option value="Штыбко">Штыбко</option>
        // <option value="Зелизко">Зелизко</option>
        // <option value="Кулиев">Кулиев</option>

echo <<<HTML
      </select>
  </p>
</div>
   <hr>
<div> 
    <p>Комментарий :<span id="js-new-modal-Comment">$Comment</span></p>
      <p id="Comment">    
         <textarea id="textarea-Comment" name="Comment" rows="2" cols="50"></textarea>
      </p>
</div>
<hr>

<div> 
    <p >Дата след.Звонка <input id="DateNextCall" type="date" name="DateNextCall" value ="$DateNextCall"></p>
</div>


<div> 
  <p>Состояние КП
    <select id="KpCondition" size="1" name="KpCondition">
        <option id="js-new-modal-KpCondition" selected value = "$KpCondition">$KpCondition</option>
HTML;

for ($i=0; $i<count($arr_condition_kp); $i++) {
  $conditionkp = $arr_condition_kp[$i]['conditionkp'];
  echo "<option value=\"$conditionkp\">$conditionkp</option>";
  }
        // <option value="В работе">В работе</option>
        // <option value="Не требуется">Не требуется</option>
        // <option value="Купили у нас">Купили у нас</option>
        // <option value="Уже купили">Уже купили</option>
        // <option value="Перенос на сл.год">Перенос на сл.год</option>

echo <<<HTML

        </select>
  </p>
</div>
<div><p>Сумма КП  <input type="number" id="KpSum" name="KpSum" value ="$KpSum"></p></div>
<div><p>НМЦК Тендера КП : <span id="js-new-modal-TenderSum">$TenderSum</span></p></div>
<!-- ************************************************** -->
<hr>


<!-- {{{{{{{{{{{{{{{XXXXXXXXXXXXXXXXXXXXXX  88888 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX}}}}}}}}}}}}}}}*** -->

<div> 
    <p>Дата заключения Контакта <input id="dateContract" type="date" name="dateContract" value ="$dateContract">
    Процент выполнения  <input type="number" id="procent_work" name="procent_work" value ="$procent_work"></p>
    <p>Дата окончания Контакта <input id="dateFinishContract" type="date" name="dateFinishContract" value ="$dateFinishContract"></p>
</div>
<!-- {{{{{{{{{{{{{{{XXXXXXXXXXXXXXXXXXXXXX  88888 XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX}}}}}}}}}}}}}}}*** -->
<hr>
<!-- *************************************************************************** -->
<div> 
  <p>Контракт закрыт 
    <select id="FinishContract" size="1" name="FinishContract">
      <!-- <option id="js-new-modal-FinishContract" selected value = "$FinishContract">$FinishContract</option> -->
      <option value="0">Контракт НЕ закрыт</option>
      <option value="1">Контракт закрыт</option>
  </select>
  </p>
</div>

<div> 
  <p>Адрес поставки : </p> 
  <textarea id="textarea-Adress" name="Adress" rows="1" cols="50"><span id="js-new-modal-Adress">$Adress</span></textarea>
</div>
<div class="container-for-btn">
<div class = "btncommentClass button">СОХРАНИТЬ</div>                
</div>    

              
       

              </div>
          </div>
      </div>
  </div>
HTML;

?>