<?php

function printOurTable($arr_name, $FinContr) {

// шапка таблицы
     echo "<div class =\"our_table\"> 
      
      <table class=\"drawtable employee_table\">";
      $i=0;
      echo"<tr>
      <td>M</td>
      <td class=\"hidden_class_column\">п/п</td>
      <td>№КП</td>
      <td>Дата КП</td>
      <td class=\"hidden_class_column\">ИНН</td>
      <td>Наименование</td>
      <td class=\"hidden_class_column\">Контакты</td>
      <td class=\"hidden_class_column\">Ред</td>";
      // <td  class=\"hidden_class_column\">ID КП</td>"
      echo "<td class=\"hidden_class_column\">Статус КП</td>
      <td class=\"hidden_class_column\">Важность</td>
          <td class=\"hidden_class_column\">Ред</td>
      <td class=\"hidden_class_column\">Ответственный</td>
          <td  class=\"hidden_class_column\">Ред</td>
      <td>Комментарий</td>
          <td>Ред</td>
      <td>Дата след.Звонка</td>
          <td>Ред</td>
      <td>Состояние</td>
          <td>Ред</td>
      <td>Сумма КП</td>
      <td class=\"hidden_class_column\">НМЦК Закупки</td>
      <td>Контакт закрыт</td>
          <td>Ред</td>
      <td class=\"hidden_class_column\">Адрес поставки</td>
      <td>Ред</td>
      </tr>";
      $realDate = date("m.d.y");
      $realDate=strtotime($realDate);
      $tempDate = "";
if (isset($arr_name)) {

// Заполняем саму таблциу
        for ($i=0; $i<count($arr_name); $i++){
//// Проверяем актуальность КП (Если не актуально то закрасим серым цветом)
          if ($arr_name[$i]['StatusKp']=="КП сформировано" || ($arr_name[$i]['FinishContract']==1 || $arr_name[$i]['KpCondition']=="Не требуется"
          || $arr_name[$i]['KpCondition']=="Уже купили") ) {  //// красим цветом статус КП
            $statusKpClass = "BlinkColor";
              // Смотрии нужно ли выводит закрытые контракты 
               if ($FinContr == 0) {
                  continue;
               }

          }else {
            $statusKpClass = "";
          }

/// Красим строчку в зависомости от важности КП
          if ($arr_name[$i]['KpImportance']=="Важно" ) {  //// красим цветом статус КП
            $KpImportance = "RedColor";
          }elseif ($arr_name[$i]['KpImportance']=="Очень важно" ) {
            $KpImportance = "GreenColor";
          }
          else {
            $KpImportance = "";
          }
//// Проверяем дату следующего звонка ... Если пора звонить, то красим в Красный (если КП актуально)
          $tempDate = ($arr_name[$i]['DateNextCall']);
          $tempDate=strtotime($tempDate);
          
          if (date('Y-m-d', $tempDate) > '0000-00-00')  // проверяем не нуливая ли дата (пустую Дату не красим в КРасный цвет)
            {  
                  if (($tempDate < $realDate) && ($statusKpClass <> "BlinkColor")){
                    $DateNextCall = "alarmcolor";
                  } else   
                    { $DateNextCall = "";  }
             }  else 
                  {   $DateNextCall = "";  }
//// Выбираем цвет Фонаря
        if ($arr_name[$i]['marker'] == 1) {
          $marker='icons/table/lamp.jpg';
        } else {
          $marker='icons/table/nolamp.jpg';
        }
//   <td>".$arr_name[$i]['NameCustomer']."</td>

$konturLinkOn =0;
$realKonturLink = $arr_name[$i]['konturLink'];
if ($realKonturLink != "") {
  $konturLinkOn=1;
}




/// Рисуем саму таблицу
      echo "<tr class =\"".$KpImportance." ".$statusKpClass."\">
           

      <td><a href=\"bodyparts\change_marker.php?id=".$arr_name[$i]['id']."\" class=\"btn\"><img src=".$marker.' alt=formatZakup>'."</a></td>
            
            <td><a name=\"".$arr_name[$i]['id']."\" href='?id=".$arr_name[$i]['id']."'"." target=\"_blank\">".$arr_name[$i]['pp'] ."</a></td> 


            <td><a href='".$arr_name[$i]['LinkKp']."'".">".$arr_name[$i]['KpNumber'] ."</a></td> 
            <td>".$arr_name[$i]['KpData']."</td>
            <td class=\"hidden_class_column\">".$arr_name[$i]['InnCustomer']."</td>";
            
            if ($konturLinkOn == 1) {  
              echo "<td><a href=\"".$arr_name[$i]['konturLink']."\" alt=konturLink target=\"_blank\">".$arr_name[$i]['NameCustomer']."</a></td>";
            } else {
               echo "<td>".$arr_name[$i]['NameCustomer']."</td>";
                    }



            echo "<td class=\"hidden_class_column\">".$arr_name[$i]['ContactCustomer']."</td>
    <td class=\"hidden_class_column\"><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=6"."#win6\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>";  
            // <td class=\"hidden_class_column\">".$arr_name[$i]['idKp']."</td>
            echo "<td class=\"hidden_class_column\">".$arr_name[$i]['StatusKp']."</td>
            <td class=\"hidden_class_column\">".$arr_name[$i]['KpImportance']."</td>
    <td class=\"hidden_class_column\"><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=9"."#win5\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>       
  
            <td class=\"hidden_class_column\">".$arr_name[$i]['Responsible']."</td>
    <td class=\"hidden_class_column\"><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=10"."#win4\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>
            
            <td class =\"limit_width \">".$arr_name[$i]['Comment']."</td>
    
    <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=11"."#win1\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>

    <td class =\"".$DateNextCall."\">".$arr_name[$i]['DateNextCall']."</td>

     <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=12"."#win2\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>
            <td>".$arr_name[$i]['KpCondition']."</td>
     <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=13"."#win3\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>
            <td>".number_format($arr_name[$i]['KpSum'])."</td>
            <td class=\"hidden_class_column\">".number_format($arr_name[$i]['TenderSum'])."</td>

            <td>".$arr_name[$i]['FinishContract']."</td>
            <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=16"."#win6\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>
            <td class=\"hidden_class_column\">".$arr_name[$i]['Adress']."</td>
            <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=100"."#win7\" class=\"btn\"><img style = \"opacity: 0.5\" src=".'icons/table/rr.jpg'.' alt=formatZakup>'."</a></td>
          </tr>";
        }

      // echo "<br>";
    }
    echo "</table></div>";

  return 1;
}

?>