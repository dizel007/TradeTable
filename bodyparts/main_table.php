<?php



$typeQuery ="";
$value="";

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
if (!empty($_GET['FinishContract'])) {
  $FinishContract=$_GET['FinishContract'];
}


/// если есть какая либо выбранная закупка по скрытому id
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
  echo "Выбран id_закупки :". $id;
  $arr_name = selectArrByHiddenIdKp($mysqli,$id);
  printOurTable($arr_name);
}
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ ИНН
  elseif ($typeQuery == 4 and $value <> "") {
  $inn = $_GET['value'];
  echo "Выбран ИНН :". $inn;
  $arr_name = selectArrByInn($mysqli,$inn);
  printOurTable($arr_name) ; 
  }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ номеру КП
  elseif ($typeQuery == 2 and $value <> "") {
    $kpNumber = $_GET['value'];
    echo "Выбран номер КП :". $kpNumber;
    $arr_name = selectArrByKpNumber($mysqli,$kpNumber);
    printOurTable($arr_name) ;
  } 
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННой дате
  elseif ($typeQuery == 3 and (isset($date_start) or (isset($date_end)))) {
    $date_start = $_GET['date_start'];
    $date_end = $_GET['date_end'];
    echo "Выбрана дата начала:".$date_start. " Дата окончания: ".$date_end."|";
    $arr_name = selectArrByDate($mysqli, $date_start, $date_end);
    printOurTable($arr_name) ;
  } 
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ ИНН
  elseif ($typeQuery == 7 and $value <> "") {
    $idKp = $_GET['value'];
    echo "Выбран ID КП :". $idKp;
    $arr_name = selectArrByIdKp($mysqli,$idKp);
    printOurTable($arr_name) ; 
    }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ СОТРУБНИКУ
elseif ($typeQuery == 10 and $value <> "") {
  $Responsible = $_GET['value'];
  echo "Выбран ответственный :". $Responsible;
  $arr_name = selectArrByResponsible($mysqli,$Responsible);
  printOurTable($arr_name) ; 
  }

// ЕСЛИ НИ ОДИН ВАРИАНТ НЕ СРАБОТАЛ, ТО ВЫВОДИМ ВСЮ ТАБЛИЦУ  
  else {
    $arr_name = selectAllArr($mysqli);
    printOurTable($arr_name) ;
  }
  
  //$arr_name = selectArrByData($mysqli);
  
  

  



?>