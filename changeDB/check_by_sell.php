<?php
// сначала проверяем есть ли статус "КУПИЛИ у НАС 
// признак что КУПИЛИ у НАС
if ($second_sell == 1) {

  // обновляем признак Покупки у этой компании
  $sql = "UPDATE `inncompany` SET `sell_comp`= 1 WHERE `inn`= $InnCustomer";
  $query = $mysqli->query($sql);

  // если купили у нас, то подсветим все КП у этой компании
  ///  обновляем все закупки у этой компании
  $sql = "UPDATE `reestrkp` SET `second_sell`= 1 WHERE `InnCustomer`= $InnCustomer";
  $query = $mysqli->query($sql);


} else {

//  если этот признак снимает в этом КП или его просто не было
// то проверяем, если ли в других КП с этим ИНН этот признак 
    $sql = "SELECT * FROM `reestrkp` WHERE `InnCustomer`= $InnCustomer AND `KpCondition`= 'Купили у нас'";
    $query = $mysqli->query($sql);
    $my_inn_arr = makeArrayFromObj($query);

    if (isset($my_inn_arr[0]['id'])) {
      $sql = "UPDATE `reestrkp` SET `second_sell`= 1 WHERE `InnCustomer`= $InnCustomer";
      $query = $mysqli->query($sql);

    } else {
      $sql = "UPDATE `reestrkp` SET `second_sell`= 0 WHERE `InnCustomer`= $InnCustomer";
      $query = $mysqli->query($sql);
      $sql = "UPDATE `inncompany` SET `sell_comp`= 0 WHERE `inn`= $InnCustomer";
      $query = $mysqli->query($sql);
   }
}






?>