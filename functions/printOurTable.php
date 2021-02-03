<?php

function printOurTable($arr_name) {
      echo '<table class="drawtable">';
      $i=0;
      echo"<tr>
      <td>п/п</td>
      <td>№КП</td>
      <td>Дата КП</td>
      <td>ИНН</td>
      <td>Наименование</td>
      <td>Контакты</td>
      <td>ID КП</td>
      <td>Статус КП</td>
      <td>Важность</td>
      <td>Ответственный</td>
      <td>Комментарий</td>
      <td>Ред</td>
      <td>Дата след.Звонка</td>
      <td>Ред</td>
      <td>Состояние</td>
      <td>Ред</td>
      <td>Сумма КП</td>
      <td>НМЦК Закупки</td>
      <td>Контакт закрыт</td>
      <td>Адрес поставки</td>
      </tr>";
      $realDate = date("m.d.y");
      $realDate=strtotime($realDate);
      $tempDate = "";
if (isset($arr_name)) {
  // Заполняем саму таблциу
        for ($i=0; $i<count($arr_name); $i++){
      echo "<td>".$arr_name[$i]['pp']."</td>
            <td><a href='excel/".$arr_name[$i]['LinkKp']."'".">".$arr_name[$i]['KpNumber'] ."</a></td>
            <td>".$arr_name[$i]['KpData']."</td>
            <td>".$arr_name[$i]['InnСustomer']."</td>
            <td>".$arr_name[$i]['NameCustomer']."</td>
            <td>".$arr_name[$i]['ContactCustomer']."</td>
            <td>".$arr_name[$i]['idKp']."</td>
            <td>".$arr_name[$i]['StatusKp']."</td>
            <td>".$arr_name[$i]['KpImportance']."</td>
            <td>".$arr_name[$i]['Responsible']."</td>
            <td >".$arr_name[$i]['Comment']."</td>
            <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=11"."#win1\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>";
      // проверяем дату следующего звонка, если она меньше сегодняшней, то подсвечиваем ее краным      
            $tempDate = ($arr_name[$i]['DateNextCall']);
            $tempDate=strtotime($tempDate);
                if ($tempDate < $realDate) {
                  echo "<td class=\"alarmcolor\">".$arr_name[$i]['DateNextCall']."</td>";
                }
                else {
                  echo "<td>".$arr_name[$i]['DateNextCall']."</td>";
                }
      echo "<td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=12"."#win2\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>
            <td>".$arr_name[$i]['KpCondition']."</td>
            <td><a href=\"?id=".$arr_name[$i]['id']."&typeQuery=13"."#win3\" class=\"btn\"><img src=".'icons/table/kiss.jpg'.' alt=addCooment>'."</a></td>
            <td>".$arr_name[$i]['KpSum']."</td>
            <td>".$arr_name[$i]['TenderSum']."</td>

            <td>".$arr_name[$i]['FinishContract']."</td>
            <td>".$arr_name[$i]['Adress']."</td>
          </tr>";
        }

      // echo "<br>";
    }
    echo "</table>";

  return 1;
}

?>