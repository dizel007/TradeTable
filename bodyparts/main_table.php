<?php


$username = "Dmitriy";
$typeQuery ="";
$value="";
$FinishContract=0;
$FinContr=0;
$pageNumber=0;
$stringCount=200; // максимальное количество строк в таблице на одной странице
$date_now=date('Y-m-d');
$KpImportance="";

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

if (!empty($_GET['FinContr'])) {
  $FinContr=$_GET['FinContr'];
  }

if (!empty($_GET['pageNumber'])) {
  $pageNumber=$_GET['pageNumber'];
}
// ************************
// ************************
if (isset($_GET["KpCondition"])) {
  $KpCondition= $_GET['KpCondition'];
} else {
  $KpCondition= "";
}
if (isset($_GET["KpImportance"])) {
  $KpImportance= $_GET['KpImportance'];
} else {
  $KpImportance= "";
}

if (isset($_GET["Responsible"])) {
  $Responsible= $_GET['Responsible'];
 } else {
  $Responsible= "";
}
if (isset($_GET["min_sum"])) {
  $min_sum= $_GET['min_sum'];
 } else {
  $min_sum= "";
}
if (isset($_GET["max_sum"])) {
  $max_sum= $_GET['max_sum'];
 } else {
  $max_sum= "";
}





// ************************
// ************************


/// если есть какая либо выбранная закупка по скрытому id
if (!empty($_GET['id'])) {
        $id = $_GET['id'];
        $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
        
        $arr_name = selectArrByHiddenIdKp($mysqli,$id);
        $inn = $arr_name[0]['InnCustomer'];
        $kpNumber = $arr_name[0]['KpNumber'];
        $NameCustomer = $arr_name[0]['NameCustomer'];
// делаем запрос в БД, чтобы найти ИНН нашей компании
        $arr_inn= selectInnFromDB($mysqli,$inn); 

        printAboutCompany($arr_inn, $id, $mysqli); // выводим на экран инфу о комании
        $name = $arr_inn[0]['name'];
        // echo "Выбран id_закупки :". $id;
        echo "<div class = \"zagolovok\">Выбрано КП№".$kpNumber.";   id Закупки :".$id." (дата последней корректировки: ".$arr_name[0]["date_write"].")</div>";
        printOurTable($arr_name, $FinishContract,$pageNumber, $stringCount);
    //////// сюда же добавим компании с этим же инн
        $arr_inn_id = FindInnById($mysqli, $id);
        // $str_count = count($arr_inn_id) ; // фактическое количество строк в массиве, включая исключенный ID 
        // echo "Количество Дополнительных строк = ". $str_count;
        if ($arr_inn_id[0]['pp'] !='')
            {  // чтобы условия чтобы не выводить пустой массив 
                echo "<div class = \"zagolovok\">Остальные КП, которые были высланы в эту компанию <BR></div>";
                printOurTable($arr_inn_id, $FinishContract,$pageNumber, $stringCount) ; 
            } else {
              echo "<div class = \"zagolovok\">Больше КП в данную компанию не высылали ... <BR></div>";
            }
    }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ ИНН
  elseif ($typeQuery == 4 and $value <> "") {
      $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
      $inn = $_GET['value'];
      $arr_inn= selectInnFromDB($mysqli,$inn); 
if (isset($arr_inn[0]['inn'])){
      // поулчаем id последнего КП по данному ИНН
      $arr_0_inn = selectArrByInn($mysqli,$inn);
      $id = $arr_0_inn[0]['id'];
      printAboutCompany($arr_inn,  $id, $mysqli); // выводим на экран инфу о комании
      echo "<div class = \"zagolovok\">Выбран ИНН : $inn<BR></div>";
      $arr_name = selectArrByInn($mysqli,$inn);
      printOurTable($arr_name, $FinishContract,$pageNumber, $stringCount) ; 
} else {
  echo "<div class = \"zagolovok\">ИНН : $inn отсуствует в Базе<BR></div>";
}
  }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ номеру КП
  
elseif (($typeQuery == 2) and (!empty($value))) {
      $kpNumber = $_GET['value'];
      $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки

      $arr_name = selectArrByKpNumber($mysqli,$kpNumber);
      $id = $arr_name[0]['id'];  // Берем ID закупки
    if (!empty($id)) { // проверяем есть ли какой либо ID  закупки
        echo "<div class = \"zagolovok\">Выбрано номер КП№".$kpNumber." (дата последней корректировки: ".  $arr_name[0]["date_write"].") <BR></div>";
              printOurTable($arr_name, $FinishContract,$pageNumber, $stringCount) ;

        } else {
         echo "<div class = \"zagolovok\"> КП с номером №$kpNumber отсутствует<BR></div>";
        }

  } 

// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННой дате
  elseif ($typeQuery == 3 and (isset($date_start) or (isset($date_end)))) {
    $date_start = $_GET['date_start'];
    $date_end = $_GET['date_end'];
    echo "Выбрана дата начала:".$date_start. " Дата окончания: ".$date_end."|";
    $arr_name = selectArrByDate($mysqli, $date_start, $date_end);
    printOurTable($arr_name, $FinishContract, $pageNumber, $stringCount) ;
  } 
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ по ИД_КР Контура
  elseif ($typeQuery == 7 and $value <> "") {
    $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
    $idKp = $_GET['value'];
    
    $arr_name = selectArrByIdKp($mysqli,$idKp); // получаем строку с этой закупкой
        $inn = $arr_name[0]['InnCustomer']; // берем ИНН компании
        $id = $arr_name[0]['id'];  // Берем ID закупки
        $arr_inn= selectInnFromDB($mysqli,$inn); // делаем запрос в БД, чтобы получить массив с данными о компании
        if (!empty($id)) { // проверяем есть ли какой либо ID  закупки             
                      printAboutCompany($arr_inn, $id, $mysqli); // выводим на экран инфу о комании

                      echo "<div class = \"zagolovok\">Выбран ID КП :".$idKp." (дата последней корректировки: ".$arr_name[0]["date_write"].")<BR></div>";
                      
                      printOurTable($arr_name, $FinishContract, $pageNumber, $stringCount) ; 
                  
                  //////// сюда же добавим компании с этим же инн
                  $arr_inn_id = FindInnById($mysqli, $id);
                  // $str_count = count($arr_inn_id) ; // фактическое количество строк в массиве, включая исключенный ID 
                  // echo "Количество Дополнительных строк = ". $str_count;
                  if ($arr_inn_id[0]['pp'] !='')
                      {  // чтобы условия чтобы не выводить пустой массив 
                          echo "<div class = \"zagolovok\">Остальные КП, которые были высланы в эту компанию <BR></div>";
                          printOurTable($arr_inn_id, $FinishContract,$pageNumber, $stringCount) ; 
                      } else {
                        echo "<div class = \"zagolovok\">Больше КП в данную компанию не высылали ... <BR></div>";
                      }
    
      } else {
        echo "<div class = \"zagolovok\"> КП с таким ID_КП не существует<BR></div>";
       }
    }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ СОТРУДНИКУ
elseif ($typeQuery == 10 and $value <> "") {
  $Responsible = $_GET['value'];
  echo "Выбран ответственный :". $Responsible;
  $arr_name = selectArrByResponsible($mysqli,$Responsible);
  printOurTable($arr_name, $FinishContract, $pageNumber, $stringCount) ; 
  }

// ВЫВОДИМ ТАБЛИЦУ ПО Найденному наименованию
elseif ($typeQuery == 8 and $value <> "") {
  $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
  $zakName = $_GET['value'];
  echo "<div class = \"zagolovok\">Название Компании : $zakName<BR></div>";
  
  $arr_name = selectAllArr($mysqli, $FinishContract);
  $select_arr = selectArrByNamePart($arr_name, $zakName);
    
// echo '<pre>';
// print_r($select_arr);
// echo '</pre>';
  
if ($select_arr[0]['pp'] !='') {
          
  printOurTable($select_arr, $FinishContract, $pageNumber, $stringCount) ; 
        }
        else {
          echo "<div class = \"zagolovok\"> Не нашли таких Наименований<BR></div>";
        }
}


// ВЫВОДИМ ТАБЛИЦУ ПО РЕГИОНУ МОСКВА
elseif ($typeQuery == 12) {
  // $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
  if ($value=="" ) {
    $region = 'моск';
  echo "<div class = \"zagolovok\">Выборка по региону Москва  и Мос область<br></div>";
  } else {
    $region = $value;
    echo "<div class = \"zagolovok\">Выборка по региона, где встречается ==$region==<br></div>";
  }
  $arr_name = selectAllArr($mysqli, $FinishContract);
  $select_arr = selectArrByRegion($arr_name, $region);
  
if ($select_arr[0]['pp'] !='') {
          
  printOurTable($select_arr, $FinishContract, $pageNumber, $stringCount) ; 
        }
        else {
          echo "<div class = \"zagolovok\"> Не нашли таких закупок<BR></div>";
        }
}
// *******************************************************
// *******************************************************
/// ЗАПРОС ПО ВСЕМ НОВЫМ КП ЗА ПЕРИОД
elseif ($typeQuery == 551) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end' ORDER BY KpData DESC , KpNumber DESC";
  $query= $mysqli->query($sql);
  $arr_items = MakeArrayFromObj($query);
     printOurTable($arr_items, 1, $pageNumber, 200) ;
}
/// ЗАПРОС ПО НОВЫМ КП ЗА ПЕРИОД, Которые еще не взяты в работу
elseif ($typeQuery == 552) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpCondition` = '$KpCondition' AND `KpData` >= '$date_start' AND `KpData` <= '$date_end' ORDER BY KpData DESC , KpNumber DESC";
  $query= $mysqli->query($sql);
  $arr_items = MakeArrayFromObj($query);
     printOurTable($arr_items, 0, $pageNumber, 200) ;
}

elseif ($typeQuery == 553) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `date_sell` >= '$date_start' AND
  `date_sell` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
//   <!-- КП за все время, которые ПРосроченные -->  
elseif ($typeQuery == 554) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `DateNextCall` < '$date_now'
     AND `DateNextCall` <> '' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 555) {
  $sql = "SELECT * FROM `reestrkp` WHERE `KpData` >= '$date_start' AND`KpData` <= '$date_end' ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 556) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract' ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 557) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract' ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 558) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `date_sell` >= '$date_start' AND
  `date_sell` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract' ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 559) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `DateNextCall` <= '$date_now'
     AND `DateNextCall` <> '' AND `FinishContract` <>1 ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// <!-- КП за все время, которые были взяты в работу --> 
elseif ($typeQuery == 560) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 561) {
  $sql = "SELECT * FROM `reestrkp` WHERE `KpCondition` = '$KpCondition' AND `FinishContract` <> 1 ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// <!-- КП за период, которые были Закрыты, кроме которых КУПИЛИ У НАС -->   
elseif ($typeQuery == 562) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` ='$Responsible'  AND `date_close` >= '$date_start' AND
  `date_close` <= '$date_end' AND `KpCondition` <> '$KpCondition' AND `FinishContract` = 1 ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
/// Выборка всех закрытых КП за заданный период
elseif ($typeQuery == 563) {
  $sql = "SELECT * FROM `reestrkp` WHERE `date_close` >= '$date_start' AND   `date_close` <= '$date_end' AND `KpCondition` <> '$KpCondition' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
    printOurTable($arr_items, 1, $pageNumber, 200) ;
}
///  <!-- КП за все время, которые были Закрыты, кроме которых КУПИЛИ У НАС --> 
elseif ($typeQuery == 564) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` ='$Responsible' AND `KpCondition` <> '$KpCondition' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
  $query= $mysqli->query($sql);
  $arr_items = MakeArrayFromObj($query);
   printOurTable($arr_items, 1, $pageNumber, 200) ;
}
elseif ($typeQuery == 565) {
  $sql = "SELECT * FROM `reestrkp` WHERE `KpCondition` <> '$KpCondition' AND `FinishContract` = 1 ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);
       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// КП которые в работе и значимость ВАЖНо или Очень важно
elseif ($typeQuery == 566) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpCondition` = '$KpCondition' AND `KpImportance`='$KpImportance' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// КП которые в работе и значимость Нейтрально или без значимости
elseif ($typeQuery == 567) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpCondition` = '$KpCondition' AND (`KpImportance`='$KpImportance' OR `KpImportance`='') AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}

// КП без ответственного за Все время
elseif ($typeQuery == 568) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// КП без ответственного за Все время
elseif ($typeQuery == 569) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpCondition` <> '$KpCondition' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
      //  echo "typeQuery=".$typeQuery;
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// КП без ответственного за Все время
elseif ($typeQuery == 570) {
  $sql = "SELECT * FROM `reestrkp` WHERE `KpCondition` <> '$KpCondition' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
      //  echo "typeQuery=".$typeQuery;
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}
//   <!-- КП за все время, куда сегодня нужно позвонить -->  
elseif ($typeQuery == 571) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `DateNextCall` = '$date_now'
     AND `DateNextCall` <> '' AND `FinishContract` = '$FinContr' ORDER BY KpData DESC , KpNumber DESC";
       $query= $mysqli->query($sql);
       $arr_items = MakeArrayFromObj($query);
          printOurTable($arr_items, 1, $pageNumber, 200) ;
}


elseif ($typeQuery == 601) {
  $sql = "SELECT * FROM `reestrkp` WHERE `KpSum` >= '$min_sum'  AND `KpSum` <= '$max_sum'
  AND `FinishContract` = 0 ORDER BY KpData DESC , KpNumber DESC";
    $query= $mysqli->query($sql);
    $arr_items = MakeArrayFromObj($query);

       printOurTable($arr_items, 1, $pageNumber, 200) ;
}
// выводим перечень КП из переданного списка id КП переданного в GET запросе
elseif ($typeQuery == 602) {
$arr_by_kp = explode(";",$_GET['idKP']);
$author = $_GET['author'];
$sql = "SELECT * FROM `users` WHERE `user_login` = '$author'";
$query= $mysqli->query($sql);
$arr = MakeArrayFromObjUsers($query);
$author = $arr[0]['user_name'];
$arr_by_kp_num= SelectAllChangeKPByUser ($arr_by_kp,$mysqli);
echo "<div class = \"zagolovok\">Выбраны изменения по КП, которые сделал: ".$author."</div>";

  printOurTable($arr_by_kp_num, 1, $pageNumber, 200) ;
}


// echo "<br>***".$sql."<br>";


   




// *******************************************************
// *******************************************************






// ЕСЛИ НИ ОДИН ВАРИАНТ НЕ СРАБОТАЛ, ТО ВЫВОДИМ ВСЮ ТАБЛИЦУ  
  else {
    $arr_name = selectAllArr($mysqli,$FinishContract);

/// Получаем количество элементов в таблице
// $sql = "SELECT COUNT(`id`) from reestrkp";
// $fQuery = $mysqli->query($sql);
// if ($fQuery -> num_rows > 0) {
//       while ($row = $fQuery -> fetch_assoc()) 
//       {
//         $arr_count =$row["COUNT(`id`)"];
//       }
//      }

    printOurTable($arr_name, $FinishContract, $pageNumber, $stringCount) ;
    
}
?>