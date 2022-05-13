
<?php

// Технический файлик. Обновляет БД в части внесения признака, что были продажи в данной компании


 require_once ("connect_db.php"); // подключение к БД
 
          
           require_once ("bodyparts/header.php"); // header HTML
       //  require_once ("connect_db.php");
           require_once ("functions/select_from_db.php");
           require_once ("functions/make_arr_from_obj.php");
           require_once ("functions/print_our_table.php");
             
            $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
            $KpCondition ="Купили у нас";
            $arr_name = selectArrByKpCondition($mysqli, $KpCondition);
             
            $summa =0;

            echo "КП которые купили у нас :";
             // Высчитываем сумму проданных КП
               foreach ($arr_name as $key => $value) {
                 foreach ($value as $key1 => $value1) {
                   
                  if ($key1 == 'InnCustomer') {

                    $inn = $value1;
                    echo $inn." ";
                      $sql = "UPDATE `inncompany` SET `sell_comp`= 1 WHERE `inn` = $inn";
                      $query =$mysqli->query($sql);
                   
                    }
                 }
               }
             
              printOurTable($arr_name, $FinishContract,0,10000);
        require_once ("bodyparts/footer.php"); // подвал страниы
 exit();
 
 ?>


