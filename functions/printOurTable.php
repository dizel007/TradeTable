<?php

function printOurTable($arr_name) {
      echo "<div class =\"our_table\"> 
      
      <table class=\"drawtable employee_table\">";
      $i=0;
      echo"<tr>
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
          if ($arr_name[$i]['StatusKp']=="КП сформировано" || ($arr_name[$i]['FinishContract']==1 || $arr_name[$i]['KpCondition']=="Не требуется") ) {  //// красим цветом статус КП
            $statusKpClass = "BlinkColor";
          }else {
            $statusKpClass = "";
          }
//// Проверяем Состояние КП (Если не требуется продукция то  закрасим серым цветом)
// if ($arr_name[$i]['KpCondition']=="Не требуется") {  //// красим цветом статус КП
//   $statusKpClass = "BlinkColor";
// }else {
//   $statusKpClass = "";
// }






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
                          {
                          $DateNextCall = "";
                          }
            }  
            else 
                    {
                      $DateNextCall = "";
                    }
                   // <td class =\"".$DateNextCall."\">".$arr_name[$i]['DateNextCall']."</td>
              //     <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=12"."#win2\" class=\"btn\">".$arr_name[$i]['DateNextCall']."</a></td>
      echo "<tr class =\"".$KpImportance." ".$statusKpClass."\">
            <td class=\"hidden_class_column\">".$arr_name[$i]['pp']."</td>
            <td><a href='".$arr_name[$i]['LinkKp']."'".">".$arr_name[$i]['KpNumber'] ."</a></td> 
            <td>".$arr_name[$i]['KpData']."</td>
            <td class=\"hidden_class_column\">".$arr_name[$i]['InnCustomer']."</td>
            <td>".$arr_name[$i]['NameCustomer']."</td>
            <td class=\"hidden_class_column\">".$arr_name[$i]['ContactCustomer']."</td>
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
            <td>".$arr_name[$i]['KpSum']."</td>
            <td class=\"hidden_class_column\">".$arr_name[$i]['TenderSum']."</td>

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