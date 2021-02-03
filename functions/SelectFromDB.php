<?php

// Из объекиа данных считанных из БД мы формируем для работы массив с этими данными (выводим весь объем данных)
function selectAllArr($mysqli) {
$sql = "SELECT * FROM reestrkp ORDER BY pp";
  $fQuery = $mysqli->query($sql);
   //$arr_name = [];
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по ИНН
function selectArrByInn ($mysqli,$inn) {
  $sql = "SELECT * FROM reestrkp where InnСustomer = '$inn' ORDER BY pp";
  $fQuery = $mysqli->query($sql);
   //$arr_name = [];
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по номеру КП
function selectArrByKpNumber ($mysqli,$kpNumber) {
  //
  $New_kpNumber = $kpNumber."E"; // можно вводить номер КП без буквы Е
  $sql = "SELECT * FROM reestrkp where (kpNumber = '$kpNumber' OR kpNumber = '$New_kpNumber') ORDER BY pp";
  $fQuery = $mysqli->query($sql);
   //$arr_name = [];
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по дате
function selectArrByDate ($mysqli, $date_start, $date_end) {
  //
  if (($date_start <> "") and ($date_end == "")) { 
    $sql = "SELECT * FROM reestrkp WHERE KpData >= '$date_start'  ORDER BY pp";
   }  elseif (($date_start == "") and ($date_end <> "")) {
    $sql = "SELECT * FROM reestrkp WHERE KpData <= '$date_end'  ORDER BY pp";
   } else {
    $sql = "SELECT * FROM reestrkp WHERE (KpData >= '$date_start' AND KpData <= '$date_end')  ORDER BY pp";
   }
   

    $fQuery = $mysqli->query($sql);
   //$arr_name = [];
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

  ?>