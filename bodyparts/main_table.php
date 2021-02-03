<?php
$typeQuery ="";
$value="";
//$date_start="";
//$date_end ="";
if (!empty($_GET['date_start']))  {
  $date_start = $_GET['date_start'];
}
if (!empty($_GET['date_end']))  {
  $date_end = $_GET['date_end'];
}
if (!empty($_GET['typeQuery']))  {
  $typeQuery = $_GET['typeQuery'];
}

if (!empty($_GET['value'])) {
  $value = $_GET['value'];
}

// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ ИНН
  if ($typeQuery == 4 and $value <> "") {
  $inn = $_GET['value'];
  $arr_name = selectArrByInn($mysqli,$inn);
  printOurTable($arr_name) ; 
  }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ номеру КП
  elseif ($typeQuery == 2 and $value <> "") {
    $kpNumber = $_GET['value'];
    $arr_name = selectArrByKpNumber($mysqli,$kpNumber);
    printOurTable($arr_name) ;
  } 
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННой дате
  elseif ($typeQuery == 3 and (isset($date_start) or (isset($date_end)))) {
    $date_start = $_GET['date_start'];
    $date_end = $_GET['date_end'];
    echo $date_start;
    echo "zzz#".(isset($date_start)),"#zzz<BR>";
    echo "222".$date_end."333";
    echo "xxx#".(isset($date_end)),"#xxx<BR>";
    $arr_name = selectArrByDate($mysqli, $date_start, $date_end);
    printOurTable($arr_name) ;
  } 



// ЕСЛИ НИ ОДИН ВАРИАНТ НЕ СРАБОТАЛ, ТО ВЫВОДИМ ВСЮ ТАБЛИЦУ  
  else {
    $arr_name = selectAllArr($mysqli);
    printOurTable($arr_name) ;
  }
  
  //$arr_name = selectArrByData($mysqli);
  
  

  



?>