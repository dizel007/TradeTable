<?php
$mysqli->query("SET NAMES 'utf8'");
// Из объекиа данных считанных из БД мы формируем для работы массив с этими данными (выводим весь объем данных)
function selectAllArr($mysqli, $FinishContract) {
//$sql = "SELECT * FROM reestrkp ORDER BY pp";
if ($FinishContract == 0) {
// $sql = "SELECT * FROM reestrkp WHERE `FinishContract` =0 ORDER BY FinishContract ASC, KpData DESC , KpNumber DESC";

// $sql = "SELECT * FROM reestrkp WHERE `FinishContract` =0 ORDER BY KpData DESC , KpNumber DESC";

$sql = "SELECT * FROM reestrkp WHERE `FinishContract` =0 ORDER BY KpData DESC , CHAR_LENGTH(`KpNumber`) DESC, KpNumber DESC";


} else {
  // $sql = "SELECT * FROM reestrkp ORDER BY FinishContract ASC, KpData DESC , KpNumber DESC";
  $sql = "SELECT * FROM reestrkp ORDER BY KpData DESC , KpNumber DESC";
}
  $fQuery = $mysqli->query($sql);
   //$arr_name = [];
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по ИНН
function selectArrByInn ($mysqli,$inn) {
  $sql = "SELECT * FROM reestrkp where InnCustomer = '$inn' ORDER BY KpData DESC , KpNumber DESC";
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
          $sql = "SELECT * FROM reestrkp where kpNumber = '$kpNumber' ORDER BY KpData DESC , KpNumber DESC";

     } elseif ((substr($kpNumber, -1) == "e") or (substr($kpNumber, -1) == "E")) {
          $kpNumber = substr($kpNumber,0,-1)."Е";
          $sql = "SELECT * FROM reestrkp where kpNumber = '$kpNumber' ORDER BY KpData DESC , KpNumber DESC";
     
     } else {
          $NewkpNumber = $kpNumber."Е";
          $sql = "SELECT * FROM reestrkp where kpNumber = '$NewkpNumber'  ORDER BY KpData DESC , KpNumber DESC";
     }
   
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

// Выбор массива КП по дате
function selectArrByDate ($mysqli, $date_start, $date_end) {
  //
  if (($date_start <> "") and ($date_end == "")) { 
    $sql = "SELECT * FROM reestrkp WHERE KpData >= '$date_start'  ORDER BY KpData DESC , KpNumber DESC";
   }  elseif (($date_start == "") and ($date_end <> "")) {
    $sql = "SELECT * FROM reestrkp WHERE KpData <= '$date_end'  ORDER BY KpData DESC , KpNumber DESC";
   } else {
    $sql = "SELECT * FROM reestrkp WHERE (KpData >= '$date_start' AND KpData <= '$date_end')  ORDER BY KpData DESC , KpNumber DESC";
   }
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

  // выбор масива по ID КП
function selectArrByIdKp ($mysqli,$idKp) {
  $sql = "SELECT * FROM reestrkp where idKp = '$idKp' ORDER BY KpData DESC , KpNumber DESC";
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}
function selectArrByHiddenIdKp ($mysqli,$id) {
  $sql = "SELECT * FROM reestrkp where id = '$id' ORDER BY KpData DESC , KpNumber DESC";
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
  return $arr_name;
}

  // выбор масива по ответственному КП
  function selectArrByResponsible ($mysqli,$Responsible) {
    
    //$sql = "SELECT * FROM reestrkp where Responsible = '$Responsible' ORDER BY pp";
    $sql = "SELECT * FROM reestrkp where Responsible = '$Responsible' ORDER BY KpData DESC , KpNumber DESC";
    $fQuery = $mysqli->query($sql);
    $arr_name = makeArrayFromObj($fQuery) ;
    return $arr_name;
  }
//// Выбор ИНН компании по Id закупки
Function FindInnById ($mysqli, $id) {
    $sql = "SELECT * FROM reestrkp where id='$id'";
    $fQuery = $mysqli->query($sql);
    $arr_findInn = MakeArrayFromObj($fQuery);
    foreach ($arr_findInn as $key => $value) {
      foreach ($value as $key1 => $value1) {
          if ($key1 == 'InnCustomer') {
              $findInn = $value1;
          }
        }
    }
    
    $sql = "SELECT * FROM reestrkp where InnCustomer = '$findInn' AND id <>'$id' ORDER BY KpData DESC , KpNumber DESC";
    $fQuery = $mysqli->query($sql);
    $arr_findInn = MakeArrayFromObj($fQuery);

    return $arr_findInn;

  }
  
  // ВЫБИАРЕМ ИЗ ТАБЛИЦЫ ИНН НУЖНУЮ КОМПАНИЮ
  function selectInnFromDB ($mysqli,$inn) {
    $sql = "SELECT * FROM inncompany where inn = '$inn'";
    $fQuery = $mysqli->query($sql);
        $arr_name = MakeArrayFromObjINN($fQuery) ;
    return $arr_name;
  }

//// Выбираем из реестре те КП, которые купили у нас

Function selectArrByKpCondition ($mysqli, $KpCondition) {
  $sql = "SELECT * FROM reestrkp where KpCondition = '$KpCondition' ORDER BY KpData DESC , KpNumber DESC";
  $fQuery = $mysqli->query($sql);
  $arr_findInn = MakeArrayFromObj($fQuery);

  return $arr_findInn;

}

//// Выбираем КП по части названия компании

Function selectArrByNamePart ($arr_name, $zakName) {
  
  foreach ($arr_name as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'NameCustomer') {
          $value1 = "222 ".$value1;
          $value1 = mb_strtolower($value1);
          $zakName = mb_strtolower($zakName);

          if (stripos($value1, $zakName)) {
                $FindNameCustomer[] = $value;
              }
        }
      }
  }
  if (!isset($FindNameCustomer)) {
    $FindNameCustomer[] = 1;
  }

return $FindNameCustomer;
}

/// Находим телефон для корректировки
Function FindPhoneNumber ($inn, $mysqli){
$sql = ("SELECT * FROM telephone WHERE `inn` = '$inn'");
$query = $mysqli->query($sql);
$arr_phone = MakeArrayFromObjTelephone($query);
return $arr_phone;
}

Function FindEmailByInn($inn, $mysqli) {
$sql = "SELECT * FROM `email` WHERE `inn` = $inn";
$fQuery = $mysqli->query($sql);
$arr_comp = MakeArrayFromObjEmail($fQuery) ;
// возвращаем массив с почтами
return $arr_comp;
}


//// Выбираем КП по части названия компании

Function selectArrByRegion ($arr_name, $region) {

  
  foreach ($arr_name as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'Adress') {

          $value1 = " ".$value1;
          $value1 = mb_strtolower($value1);
          $region = mb_strtolower($region);

          if (stripos($value1, $region)) {
                $FindKpRegion[] = $value;
              }
        }
      }
  }
  if (!isset($FindKpRegion)) {
    $FindKpRegion[] = 1;
  }

return $FindKpRegion;
}

  ?>