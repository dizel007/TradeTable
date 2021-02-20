<?php
$mysqli->query("SET NAMES 'utf8'");
// Из объекиа данных считанных из БД мы формируем для работы массив с этими данными (выводим весь объем данных)
function selectAllArr($mysqli) {
//$sql = "SELECT * FROM reestrkp ORDER BY pp";
$sql = "SELECT * FROM reestrkp ORDER BY KpData DESC , KpNumber DESC";
  $fQuery = $mysqli->query($sql);
   //$arr_name = [];
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по ИНН
function selectArrByInn ($mysqli,$inn) {
  $sql = "SELECT * FROM reestrkp where InnCustomer = '$inn' ORDER BY pp";
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по номеру КП
function selectArrByKpNumber ($mysqli,$kpNumber) {
  // 
  // можно вводить номер КП как с "Е" так и без него (можно и русскую и английсую вбивать)
    if ((substr($kpNumber, -2) == "Е") or (substr($kpNumber, -2) == "е") ){
          $kpNumber = substr($kpNumber,0,-2)."Е";
          $sql = "SELECT * FROM reestrkp where kpNumber = '$kpNumber' ORDER BY pp";

     } elseif ((substr($kpNumber, -1) == "e") or (substr($kpNumber, -1) == "E")) {
          $kpNumber = substr($kpNumber,0,-1)."Е";
          $sql = "SELECT * FROM reestrkp where kpNumber = '$kpNumber' ORDER BY pp";
     
     } else {
          $NewkpNumber = $kpNumber."Е";
          $sql = "SELECT * FROM reestrkp where kpNumber = '$NewkpNumber'  ORDER BY pp";
     }
   
  $fQuery = $mysqli->query($sql);
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
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

  // выбор масива по ID КП
function selectArrByIdKp ($mysqli,$idKp) {
  $sql = "SELECT * FROM reestrkp where idKp = '$idKp' ORDER BY pp";
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}
function selectArrByHiddenIdKp ($mysqli,$id) {
  $sql = "SELECT * FROM reestrkp where id = '$id' ORDER BY pp";
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

  // выбор масива по ответственному КП
  function selectArrByResponsible ($mysqli,$Responsible) {
    
    //$sql = "SELECT * FROM reestrkp where Responsible = '$Responsible' ORDER BY pp";
    $sql = "SELECT * FROM reestrkp where Responsible = '$Responsible' ORDER BY KpData DESC";
    $fQuery = $mysqli->query($sql);
    $arr_name = makeArrayFromObj($fQuery) ;
    return $arr_name;
  }

  ?>