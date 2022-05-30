<?php
require_once ("functions/get_url.php");
function printOurTable($arr_name, $FinContr,$pageNumber, $stringCount) {
// $FinContr=1;
require("functions/page_numbers.php");

// шапка таблицы
$i=0;
$j=0;
echo <<<HTML
     <div class ="our_table"> 
      
      <table width="100%" class="drawtable employee_table">
      <tbody>
          <tr class="DrawDark">
            <td>пп</td>
            
            <td>№КП</td>
            <td>Ex</td> 
            <td>Дата КП</td>
            <td class="hidden_class_column">ИНН</td>
            <td>PDF</td>
            <td>Наименование</td>
            <td>EM</td>
            <td class="hidden_class_column">Важность</td>
            <td class="hidden_class_column">%</td>
            <td class="hidden_class_column">Ответственный</td>
            <td class="hidden_class_column">id</td>
            <td>Комментарий</td>
            <td>Ред</td>
            <td>Сл.звонок</td>
            <td class="">Состояние</td>
            <td>Сумма КП</td>
            <td class="hidden_class_column">НМЦК Закупки</td>
            <td>ДКЗ</td>
            <td>КЗ</td>
            <td class="hidden_class_column">Вр</td>
            <td>Финиш</td>
            <td class="hidden_class_column">Ист</td>
            <td class="hidden_class_column">Адрес поставки</td>
         </tr>

HTML;

      $realDate = date("m.d.y");
      $realDate=strtotime($realDate);
      $tempDate = "";
        
if (isset($arr_name)) {
// Заполняем саму таблциу
$start_string = ($pageNumber-1)*$stringCount;
// echo "Количество начало :".$start_string ."<br>";

$last_string = ($pageNumber*$stringCount); 
$last_string = $last_string; // так как с нуля начинаем считать
if ($last_string>count($arr_name)) {
  $last_string = count($arr_name);
}
// echo "Количество начлоа :". $start_string."<br>";
// echo "Количество конец :". $last_string."<br>";

for ($i=$start_string; $i<$last_string; $i++)
// for ($i=0; $i<count($arr_name); $i++)
{
// Заводим все переменные 

// $jsId = $arr_name[$i]['id'];
$id = $arr_name[$i]['id'];
// $pp = $arr_name[$i]['pp'];
$LinkKp = $arr_name[$i]['LinkKp'];
$KpNumber = $arr_name[$i]['KpNumber'];
$KpData = $arr_name[$i]['KpData'];
$InnCustomer = $arr_name[$i]['InnCustomer']; 
// $konturLink = $arr_name[$i]['konturLink'];
// $NameCustomer = $arr_name[$i]['NameCustomer'];
// $ContactCustomer = $arr_name[$i]['ContactCustomer'];
// $idKp = $arr_name[$i]['idKp'];
$StatusKp = $arr_name[$i]['StatusKp'];
$KpImportance = $arr_name[$i]['KpImportance'];
$Responsible = $arr_name[$i]['Responsible'];
$Comment = (string)$arr_name[$i]['Comment'];

$Comment = substr($Comment, 2, strlen($Comment)); // удаляем первые два символа комментария
$Comment  = str_replace( "@!", "<br><hr>" , $Comment); // 
$Comment  = str_replace( "||+", ";" , $Comment);

$DateNextCall = $arr_name[$i]['DateNextCall'];
if ($DateNextCall =="0000-00-00") {$DateNextCall='';}  // ничего не выводим, если дата звонка не задана
$KpCondition =  $arr_name[$i]['KpCondition'];
$KpSum = number_format($arr_name[$i]['KpSum']);
$TenderSum = number_format($arr_name[$i]['TenderSum']);
$FinishContract = $arr_name[$i]['FinishContract'];
$Adress = $arr_name[$i]['Adress'];
//делаем ссылку для скачивания PDF
$LinkKpPdf = substr($LinkKp, 0, -4)."pdf";
$exist_pdf_file =file_exists($LinkKpPdf); // Проверяем есть ли ПДФ файл
$exist_excel_file = file_exists($LinkKp);
$dateContract = $arr_name[$i]['dateContract'];
$KpConditionTable = ""; // Вводим пустую переченную
$procent_work = $arr_name[$i]['procent_work'];
if ($procent_work == 0) {$procent_work="";}
$date_write = $arr_name[$i]['date_write']; // 
$dateFinishContract = $arr_name[$i]['dateFinishContract'];
if ($dateFinishContract =="0000-00-00") {$dateFinishContract='';}  // ничего не выводим, если дата окончания не задана
$second_sell = $arr_name[$i]['second_sell'];






  /// Не выводим перенесенные на следующий год КП
  $KpData_d = strtotime($KpData); // приводим дату КП к типу дата
  $KpData_d = date('Y',$KpData_d); // Берем год из даты КП
  $realDate_d = date('Y',$realDate); // Берем сегодняшний год
  
  if (($KpCondition == "Перенос на сл.год") &&
  ($KpData_d == $realDate_d))
   { 
    $KpConditionTable = "buy_next_year"; // Красим стутус КП (В оранжевый)

     if ($FinContr == 0) { // если не выбран флаг =Э показывать закрытые перенесенные контракты, то не показываем закупку
      continue;
            
     }
     
  } 
  //// Проверяем актуальность КП (Если не актуально то закрасим серым цветом)

    if ($StatusKp == "КП сформировано" ||
        $FinishContract == 1 || 
        $KpCondition =="Не требуется" || 
        $KpCondition =="Уже купили")  
          {  //// красим цветом статус КП
                  $statusKpClass = "BlinkColor";
               
              // Смотрии нужно ли выводит закрытые контракты 
               if ($FinContr == 0) {
                  continue;
                  
                }
          }else{
                  $statusKpClass = "";
                }

/// Красим строчку в зависомости от важности КП
          if ($KpImportance == "Важно" ) {  //// красим цветом статус КП
              $KpImportanceTable = "RedColor";
          }elseif ($KpImportance =="Очень важно" ) {
            $KpImportanceTable = "GreenColor";
          }
          else {
            $KpImportanceTable = "";
          }


// Подсвечиваем компании которым раньше продавали
if ($second_sell == 1 ) {
 $second_sell_cl = 'sell_comp';  
} else {
  $second_sell_cl = '';  
}

//// Проверяем дату следующего звонка ... Если пора звонить, то красим в Красный (если КП актуально)
          $tempDate = ($arr_name[$i]['DateNextCall']);
          $tempDate=strtotime($tempDate);
          
          if (date('Y-m-d', $tempDate) > '0000-00-00')  // проверяем не нуливая ли дата (пустую Дату не красим в КРасный цвет)
            {  
                  if (($tempDate < $realDate) && ($statusKpClass <> "BlinkColor")){
                    $DateNextCallTable = "alarmcolor";
                  } else   
                    { $DateNextCallTable = "";  }
             }  else 
                  {   $DateNextCallTable = "";  }
//// Выбираем цвет Фонаря
        // if ($arr_name[$i]['marker'] == 1) {
        //   $marker='icons/table/lamp.jpg';
        // } else {
        //   $marker='icons/table/nolamp.jpg';
        // }
$konturLinkOn = 0; // признак наличия ссылки у закупки (Лкгаси - уже везде ссылка есть)
$realKonturLink = $arr_name[$i]['konturLink'];
if ($realKonturLink != "") {
  $konturLinkOn=1;
}

/// ЕСЛИ КУПИЛИ У НАС ТО КРАСИМ ЗЕЛЕНЫМ
if ($KpCondition == "Купили у нас")
      {  //// красим цветом статус КП
            $KpConditionTable = "buyour";
      }
      //  else {
      //   $KpConditionTable = "";
      // }

if(($i % 2) == 0) {
  $StringColor = "DrawLight";
} else {
  $StringColor = "DrawDark";
}

//  ******************************  Рисуем саму таблицу  *********************************************** 
// $i1=$i+1;
$j=($j+1);
$puncPp = $j + 200*($pageNumber-1);
echo <<<HTML
       <tr class ="$KpImportanceTable  $statusKpClass $StringColor">
<!-- ******************************  AJAX MARKER  ***********************************************  -->
       <!-- <td class = "hidden_class_column"><img class ="markerClass" id="markerLink $id" src="marker"></td> -->
       <td class = "hidden_class_column">$puncPp</td>


<!-- *************  ССЫлка для скачивания КП в формате EXCEL  *********************************  -->
       <td><a href= "$LinkKp">$KpNumber</a></td> 
HTML;

// Проверяем есть ли файл с КП в формате ексель на сервере **************************************
// Если есть то картника стает яркой 

if ($exist_excel_file) {  
  echo "<td><a href=\"open_excel/simplexlsx.php?LinkKp=$LinkKp\" class=\"btn\" target=\"_blank\"><img class=\"scale11\" style = \"opacity: 0.8\" src=\"icons/table/excel.png\" alt=\"Excel\"></a></td>";
        } else {
  echo "<td><img style = \"opacity: 0.2\" src=\"icons/table/excel.png\" alt=\"Excel\"></td>";
       }  

echo <<<HTML
       <td width="60">$KpData</td>
       <td width ="70" class="$second_sell_cl hidden_class_column">$InnCustomer</td>
     HTML;

// Проверяем есть ли ПДФ файл, то рисуем Иконку и цепляем ссылку на него        
        if ($exist_pdf_file) {  
          echo "<td><a href= \"$LinkKpPdf\" target=\"_blank\"><img class=\"scale11\" style = \"opacity: 0.8\" src=\"icons/table/pdf.png\" alt=\"SeeKp\"></a></td>" ;
                } else {
                  echo "<td><img style = \"opacity: 0.1\" src=\"icons/table/pdf.png\" alt=\"SeeKp\"></td>" ;
                 }  
//  Проверяем есть ли ссылна на контур,Закупки
    if ($konturLinkOn == 1) {  
              echo "<td width =\"150\" ><a href=\"".$arr_name[$i]['konturLink']."\" alt=\"konturLink\" target=\"_blank\">".$arr_name[$i]['NameCustomer']."</a></td>";
            } else {
               echo "<td width =\"150\">".$arr_name[$i]['NameCustomer']."</td>";
             }
        
    echo <<<HTML
 
<!-- ******************************  Icons Email  *********************************************** -->
      <td><a href= "mailer/login_mail.php?id=$id&InnCustomer=$InnCustomer" target="_blank"><img class="scale11" style = "opacity: 0.8" src="icons/table/email.png" alt="SeeKp"></a> </a></td> 
 <!-- ********************************** ВАЖНОСТЬ КП ************************************************ -->
      <td id = "js-KpImportance$id" width ="50"class="hidden_class_column">$KpImportance</td>

<!-- ****************************** % выполнения   ********************************************* -->
      <td id = "js-procent_work$id" width ="20" class="hidden_class_column" title="$date_write"><b>$procent_work</b></td>
 <!-- ********************************** ОТветственный  ************************************************ -->
     <td id= "js-Responsible$id" width="80" class="hidden_class_column">$Responsible</td>

<!-- ******************************  ПАПКА для открытия КП  *************************************  -->
     <td><a name="$id" href="?id=$id" target="_blank"><img class="scale11" src="icons/table/open_dir.png" style = "opacity: 0.6" alt="OPEN" title="Открыть КП id=$id"></a></td> 

<!-- ********************************** Комментарий  ************************************************ -->
      <td id = "js-comment$id" class ="limit_width text_left">$Comment</td>


<!-- ********************************** Редактирование  ************************************************ -->
<td  class= "hidden_class_column"><img id = "$id" data-modal = "write_comment" class="js-open-modal commentClass scale11" src="icons/table/change.png" alt="addCooment"></td> 
      <!-- <td  class= "hidden_class_column"  id="markerLink $id"><img id = "$id" data-modal = "write_comment" class="js-open-modal commentClass" src="icons/table/change.png" alt="addCooment"></td>  -->
<!-- ********************************** Дата следующего звонка  ********************************** -->
      <td id = "js-DateNextCall$id" width="60" class ="$DateNextCallTable">$DateNextCall</td>
<!-- ********************************** СОСТОЯНИЕ КП ********************************** -->
      <td > <div id = "js-KpCondition$id" class = "$KpConditionTable">$KpCondition</div></td>
      <td id = "js-KpSum$id" >$KpSum</td>
      <td class="hidden_class_column">$TenderSum</td>


HTML;
if (($dateContract<>"0000-00-00") and ($dateContract)) {
      // if ($exist_excel_file) {  
  echo "<td id = \"js-dateContract$id\"><img class=\"scale11\" style = \"opacity: 0.8\" src=\"icons/table/dateContract.png\" title=\"Дата Закл :$dateContract\"></td>";
        } else {
  echo "<td id = \"js-dateContract$id\"><img style = \"opacity: 0.2\" src=\"icons/table/dateContract.png\" title=\"Нет данных\"></td>";
       } ;
      // <td id = "js-dateContract$id" >$dateContract</td>

echo <<<HTML
      <td id = "js-FinishContract$id" >$FinishContract</td>
<!-- ****************************** ССылка на часики   ********************************************* -->
      <td width ="25" class="hidden_class_column"><a href = "https://xmlsearch.yandex.ru/search/?text=местное+время+time100+$Adress" target="_blank"><img class="scale11" src="icons/table/clocks.png" style = "opacity: 0.7" alt="Time" title="Время по адресу доставки"></a></td>

<!-- ****************************** ССылка на часики   ********************************************* -->
      <td id = "js-dateFinishContract$id" width="60">$dateFinishContract</td>

      <!-- ******************************  ПАПКА для открытия КП  *************************************  -->
     <td><a name="$id" href="reports_show_history_kp.php?typeQuery=5&id_kp=$id" target="_blank"><img class="scale11" src="icons/table/history_kp.png" style = "opacity: 0.6" alt="История КП" title="История КП"></a></td> 

      <!-- ****************************** Адрес поставки   ********************************************* -->
      <td id = "js-Adress$id" width ="150" class="hidden_class_column">$Adress</td>
  </tr>
 
HTML;
     } 
   } 
   
 echo <<<HTML
  </tbody></table></div>
  HTML;
  require("functions/page_numbers.php");
  return 1;
  }

?>