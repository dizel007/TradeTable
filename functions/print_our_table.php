<?php
require_once ("functions/get_url.php");
function printOurTable($arr_name, $FinContr,$pageNumber) {
// $FinContr=1;
$pageNumber=1;
$stringCount=200; // количество строк на странице
if (!empty($_GET['pageNumber'])) {
  $pageNumber = $_GET['pageNumber'];
}
$elem_count = count($arr_name); // Количество элементов
$pageCount= $elem_count/$stringCount; // 
$pageCount = ceil($pageCount); // округление ввех
$url = remove_key("pageNumber"); // удаляем из URL ключ с номером страницы
$url = removeDomain($url); // удаляем из URL  наименование сайта

/// Выводим номера страниц если больше одной 
if ($pageCount>1) {
echo "<div class=\"pageNumber\">";
for ($i=0; $i<$pageCount; $i++){
  $i1 = $i+1;
      if ($i1 == $pageNumber) {
      echo "<a class=\"bigNumber\" href=\"$url&pageNumber=$i1\">$i1 </a>";
      } else {
      echo "<a class=\"normalNumber\" href=\"$url&pageNumber=$i1\">$i1 </a>";
      }
}
echo "</div>";
}

// шапка таблицы
$i=0;
echo <<<HTML
     <div class ="our_table"> 
      
      <table width="100%" class="drawtable employee_table">
      <tbody>
          <tr>
            <td>M</td>
            <td class="hidden_class_column">п/п</td>
            <td>№КП</td>
            <td>Ex</td> 
            <td>Дата КП</td>
            <td class="hidden_class_column">ИНН</td>
            <td>PDF</td>
            <td>Наименование</td>
            <td>EM</td>
            <td class="hidden_class_column">Важность</td>
            <td class="hidden_class_column">Ответственный</td>
            <td>Комментарий</td>
            <td>Ред</td>
            <td>Сл.звонок</td>
            <td class="">Состояние</td>
            <td>Сумма КП</td>
            <td class="hidden_class_column">НМЦК Закупки</td>
            <td>КонЗак</td>
            <td class="hidden_class_column">Вр</td>
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
$last_string = $last_string - 1;
if ($last_string>count($arr_name)) {
  $last_string = count($arr_name);
}
// echo "Количество конец :". $last_string."<br>";


for ($i=$start_string; $i<$last_string; $i++)

// for ($i=$pageNumber; $i<count($arr_name); $i++)
{
//// Проверяем актуальность КП (Если не актуально то закрасим серым цветом)

    if ($arr_name[$i]['StatusKp']=="КП сформировано" ||
        $arr_name[$i]['FinishContract']==1 || 
        $arr_name[$i]['KpCondition']=="Не требуется" || 
        $arr_name[$i]['KpCondition']=="Уже купили")  
          {  //// красим цветом статус КП
                  $statusKpClass = "BlinkColor";
              // Смотрии нужно ли выводит закрытые контракты 
               if ($FinContr == 0) { continue;}
          }else{
                  $statusKpClass = "";
                }

/// Красим строчку в зависомости от важности КП
          if ($arr_name[$i]['KpImportance']=="Важно" ) {  //// красим цветом статус КП
              $KpImportanceTable = "RedColor";
          }elseif ($arr_name[$i]['KpImportance']=="Очень важно" ) {
            $KpImportanceTable = "GreenColor";
          }
          else {
            $KpImportanceTable = "";
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
        if ($arr_name[$i]['marker'] == 1) {
          $marker='icons/table/lamp.jpg';
        } else {
          $marker='icons/table/nolamp.jpg';
        }
$konturLinkOn = 0;
$realKonturLink = $arr_name[$i]['konturLink'];
if ($realKonturLink != "") {
  $konturLinkOn=1;
}

/// ЕСЛИ КУПИЛИ У НАС ТО КРАСИМ ЗЕЛЕНЫМ
if ($arr_name[$i]['KpCondition'] == "Купили у нас")
      {  //// красим цветом статус КП
            $KpConditionTable = "buyour";
      } else {
        $KpConditionTable = "";
      }

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
// $StatusKp = $arr_name[$i]['StatusKp'];
$KpImportance = $arr_name[$i]['KpImportance'];
$Responsible = $arr_name[$i]['Responsible'];
$Comment = $arr_name[$i]['Comment'];
$DateNextCall = $arr_name[$i]['DateNextCall'];
$KpCondition =  $arr_name[$i]['KpCondition'];
$KpSum = number_format($arr_name[$i]['KpSum']);
$TenderSum = number_format($arr_name[$i]['TenderSum']);
$FinishContract = $arr_name[$i]['FinishContract'];
$Adress = $arr_name[$i]['Adress'];
//делаем ссылку для скачивания PDF
$LinkKpPdf = substr($LinkKp, 0, -4)."pdf";
$exist_pdf_file =file_exists($LinkKpPdf); // Проверяем есть ли ПДФ файл

$exist_excel_file = file_exists($LinkKp);

//  ******************************  Рисуем саму таблицу  *********************************************** 

echo <<<HTML
       <tr class ="$KpImportanceTable  $statusKpClass">
<!-- ******************************  AJAX MARKER  ***********************************************  -->
       <td class = "hidden_class_column"><img class ="markerClass" id="markerLink $id" src="$marker"></td>

<!-- ******************************  ПАПКА для открытия КП  ***********************************************  -->
       <td><a name="$id" href="?id=$id" target="_blank"><img src="icons/table/open_dir.png" style = "opacity: 0.6" alt="OPEN" title="Открыть КП id=$id"></a></td> 
<!-- *************  ССЫлка для скачивания КП в формате EXCEL  *********************************  -->
       <td><a href= "$LinkKp">$KpNumber</a></td> 
HTML;

// Проверяем есть ли файл с КП в формате ексель на сервере **************************************
// Если есть то картника стает яркой 
if ($exist_excel_file) {  
  echo "<td><a href=\"open_excel/simplexlsx.php?LinkKp=$LinkKp\" class=\"btn\" target=\"_blank\"><img style = \"opacity: 0.8\" src=\"icons/table/excel.png\" alt=\"Excel\"></a></td>";
        } else {
  echo "<td><img style = \"opacity: 0.2\" src=\"icons/table/excel.png\" alt=\"Excel\"></td>";
       }  

echo <<<HTML
       <td width="60">$KpData</td>
       
       
       <td width ="70" class="hidden_class_column">$InnCustomer</td>
     HTML;

// Проверяем есть ли ПДФ файл, то рисуем Иконку и цепляем ссылку на него        
        if ($exist_pdf_file) {  
          echo "<td><a href= \"$LinkKpPdf\" target=\"_blank\"><img style = \"opacity: 0.8\" src=\"icons/table/pdf.png\" alt=\"SeeKp\"></a></td>" ;
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
      <td><a href= "mailer/login_mail.php?id=$id&InnCustomer=$InnCustomer" target="_blank"><img style = "opacity: 0.8" src="icons/table/email.png" alt="SeeKp"></a> </a></td> 
 <!-- ********************************** ВАЖНОСТЬ КП ************************************************ -->
      <td id = "js-KpImportance$id" width ="50"class="hidden_class_column">$KpImportance</td>
 <!-- ********************************** ОТветственный  ************************************************ -->
     <td id= "js-Responsible$id" width="80" class="hidden_class_column">$Responsible</td>
<!-- ********************************** Комментарий  ************************************************ -->
      <td  id = "js-comment$id" class ="limit_width">$Comment</td>
<!-- ********************************** Редактирование  ************************************************ -->
<td  class= "hidden_class_column"><img id = "$id" data-modal = "write_comment" class="js-open-modal commentClass" src="icons/table/change.png" alt="addCooment"></td> 
      <!-- <td  class= "hidden_class_column"  id="markerLink $id"><img id = "$id" data-modal = "write_comment" class="js-open-modal commentClass" src="icons/table/change.png" alt="addCooment"></td>  -->
<!-- ********************************** Дата следующего звонка  ********************************************* -->
      <td id = "js-DateNextCall$id" width="60" class ="$DateNextCallTable">$DateNextCall</td>
      <td> <div id = "js-KpCondition$id"  class = "$KpConditionTable">$KpCondition</div></td>
      <td id = "js-KpSum$id" >$KpSum</td>
      <td class="hidden_class_column">$TenderSum</td>
      <td id = "js-FinishContract$id" >$FinishContract</td>
<!-- ****************************** ССылка на часики   ********************************************* -->
      <td width ="25" class="hidden_class_column"><a href = "https://xmlsearch.yandex.ru/search/?text=местное+время+time100+$Adress" target="_blank"><img src="icons/table/clocks.png" style = "opacity: 0.7" alt="Time" title="Время по адресу доставки"></a></td>
<!-- ****************************** Адрес поставки   ********************************************* -->
      <td id = "js-Adress$id" width ="150" class="hidden_class_column">$Adress</td>
  </tr>
 
HTML;
     } 
   } 
   
 echo <<<HTML
  </tbody></table></div>
  HTML;
  return 1;
  }

?>