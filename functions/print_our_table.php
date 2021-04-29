<?php

function printOurTable($arr_name, $FinContr) {

// шапка таблицы
$i=0;
echo <<<HTML
     <div class ="our_table"> 
      
      <table class="drawtable employee_table">
      <tbody>
          <tr>
            <td>M</td>
            <td class="hidden_class_column">п/п</td>
            <td>№КП</td>
            <td>Дата КП</td>
            <td class="hidden_class_column">ИНН</td>
            <td>Наименование</td>
            <td class="hidden_class_column">Контакты</td>
            <!-- <td class="hidden_class_column">Ред</td> -->
            <!-- <td  class="hidden_class_column\">ID КП</td>" -->
            <!-- <td class="hidden_class_column">Статус КП</td>": -->
            <td class="hidden_class_column">Важность</td>
            <td class="hidden_class_column">Ред</td>
            <td class="hidden_class_column">Ответственный</td>
            <td  class="hidden_class_column">Ред</td>
            <td>Комментарий</td>
                <td>Ред</td>
            <td>Дата след.Звонка</td>
                <td>Ред</td>
            <td>Состояние</td>
                <td>Ред</td>
            <td>Сумма КП</td>
            <td class="hidden_class_column">НМЦК Закупки</td>
            <td>Контакт закрыт</td>
                <td>Ред</td>
            <td class="hidden_class_column">Адрес поставки</td>
            <td>Ред</td>
      </tr>

HTML;

      $realDate = date("m.d.y");
      $realDate=strtotime($realDate);
      $tempDate = "";
        
if (isset($arr_name)) {
// Заполняем саму таблциу
for ($i=0; $i<count($arr_name); $i++)
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




$jsId = $arr_name[$i]['id'];
// <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=11"."#win1\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>


$id = $arr_name[$i]['id'];
$pp = $arr_name[$i]['pp'];
$LinkKp = $arr_name[$i]['LinkKp'];
$KpNumber = $arr_name[$i]['KpNumber'];
$KpData = $arr_name[$i]['KpData'];
$InnCustomer = $arr_name[$i]['InnCustomer']; 
$konturLink = $arr_name[$i]['konturLink'];
$NameCustomer = $arr_name[$i]['NameCustomer'];
$ContactCustomer = $arr_name[$i]['ContactCustomer'];
$idKp = $arr_name[$i]['idKp'];
$StatusKp = $arr_name[$i]['StatusKp'];
$KpImportance = $arr_name[$i]['KpImportance'];
$Responsible = $arr_name[$i]['Responsible'];
$Comment = $arr_name[$i]['Comment'];
$DateNextCall = $arr_name[$i]['DateNextCall'];
$KpCondition =  $arr_name[$i]['KpCondition'];
$KpSum = number_format($arr_name[$i]['KpSum']);
$TenderSum = number_format($arr_name[$i]['TenderSum']);
$FinishContract = $arr_name[$i]['FinishContract'];
$Adress = $arr_name[$i]['Adress'];
/// Рисуем саму таблицу
echo <<<HTML
       <tr class ="$KpImportanceTable  $statusKpClass">
       <td><img class ="markerClass" id="markerLink $id" src="$marker"></td>
       <td><a name="$id" href="?id=$id" target="_blank"> $id </a></td> 
       <td><a href= "$LinkKp">$KpNumber</a></td> 
       
       
       
       <td><a name="$id" href="open_excel/simplexlsx.php?LinkKp=$LinkKp" target="_blank">$KpData</a></td>
       
       
       <td class="hidden_class_column">$InnCustomer</td>
     HTML;

    if ($konturLinkOn == 1) {  
              echo "<td><a href=\"".$arr_name[$i]['konturLink']."\" alt=\"konturLink\" target=\"_blank\">".$arr_name[$i]['NameCustomer']."</a></td>";
            } else {
               echo "<td>".$arr_name[$i]['NameCustomer']."</td>";
             }
             
  echo <<<HTML
      <td class="hidden_class_column"> $ContactCustomer</td>
      <!-- <td class="hidden_class_column"><a href="?id=$id&typeQuery=6#win6" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>   -->
      <!-- <td class="hidden_class_column">$idKp"</td> -->
      <!-- <td class="hidden_class_column">$StatusKp</td> -->
      <td class="hidden_class_column">$KpImportance</td>
      <td class="hidden_class_column"><a href="?id=$id&typeQuery=9#win5" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>       
      <td class="hidden_class_column">$Responsible</td>
      <td class="hidden_class_column"><a href="?id=$id&typeQuery=10#win4" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>
      <td class ="limit_width">$Comment</td>
      <td><a href="?id=$id&typeQuery=11#win1" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>
      <td class ="$DateNextCallTable">$DateNextCall</td>
      <td><a href="?id=$id&typeQuery=12#win2" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>
      <td> <div class = "$KpConditionTable">$KpCondition</div></td>
      <td><a href="?id=$id&typeQuery=13#win3" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>
      <td>$KpSum</td>
      <td class="hidden_class_column">$TenderSum</td>
      <td>$FinishContract</td>
      <td><a href="?id=$id&typeQuery=16#win6" class="btn"><img src="icons/table/kiss.jpg" alt="addCooment"></a></td>
      <td class="hidden_class_column">$Adress</td>
      <td><a href="?id=$id&typeQuery=100#win7" class="btn"><img style = "opacity: 0.5" src="icons/table/rr.jpg" alt="formatZakup"></a></td>
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