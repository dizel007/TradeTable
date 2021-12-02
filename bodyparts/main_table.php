<?php


$username = "Dmitriy";
$typeQuery ="";
$value="";
$FinishContract=0;
$pageNumber=0;
$stringCount=200; // максимальное количество строк в таблице на одной странице

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
if (!empty($_GET['pageNumber'])) {
  $pageNumber=$_GET['pageNumber'];
}

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
        echo "<div class = \"zagolovok\">Выбрано КП№".$kpNumber.";   id Закупки :".$id."</div>";
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
      echo "<div class = \"zagolovok\">Выбран ИНН : $inn<BR></div>";
      
      $arr_name = selectArrByInn($mysqli,$inn);
      printOurTable($arr_name, $FinishContract,$pageNumber, $stringCount) ; 
  }
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ номеру КП
  
elseif (($typeQuery == 2) and (!empty($value))) {
      $kpNumber = $_GET['value'];
      $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки

      $arr_name = selectArrByKpNumber($mysqli,$kpNumber);

      $inn = $arr_name[0]['InnCustomer']; // берем ИНН компании
      $id = $arr_name[0]['id'];  // Берем ID закупки
    if (!empty($id)) { // проверяем есть ли какой либо ID  закупки
              $arr_inn= selectInnFromDB($mysqli,$inn); // делаем запрос в БД, чтобы получить массив с данными о компании
                      
              printAboutCompany($arr_inn, $id, $mysqli); // выводим на экран инфу о комании

              echo "<div class = \"zagolovok\">Выбрано номер КП№".$kpNumber." <BR></div>";

              printOurTable($arr_name, $FinishContract,$pageNumber, $stringCount) ;

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
         echo "<div class = \"zagolovok\"> КП с таким номером отсутствует<BR></div>";
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
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ ИНН
  elseif ($typeQuery == 7 and $value <> "") {
    $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
    $idKp = $_GET['value'];
    
    $arr_name = selectArrByIdKp($mysqli,$idKp); // получаем строку с этой закупкой
        $inn = $arr_name[0]['InnCustomer']; // берем ИНН компании
        $id = $arr_name[0]['id'];  // Берем ID закупки
        $arr_inn= selectInnFromDB($mysqli,$inn); // делаем запрос в БД, чтобы получить массив с данными о компании
        if (!empty($id)) { // проверяем есть ли какой либо ID  закупки             
                      printAboutCompany($arr_inn, $id, $mysqli); // выводим на экран инфу о комании

                      echo "<div class = \"zagolovok\">Выбран ID КП :".$idKp." <BR></div>";
                      
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
// ВЫВОДИМ ТАБЛИЦУ ПО ВЫБРАННОМУ номеру КП

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
    
    require("functions/page_numbers.php");
    
  }

?>