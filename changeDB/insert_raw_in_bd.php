<?php

require_once ("../bodyparts/header.php"); // header HTML
require_once ("../connect_db.php");
// mb_internal_encoding("UTF-8");  // не работает
$filename = "../myfile1.txt";
if (!file_exists($filename)) {
  echo "Файла для ввода КП в реестр НЕ существует";
  die();
} else {

          echo "СТАРТ ЗАГРУЗКИ ДАННЫХ в БАЗУ ДАННЫХ ............................. <br><br>";
          $handle = fopen ("../myfile1.txt", "r");

          $lines = file('../myfile1.txt');

          //$array = null;

          $i=0;
          if ($handle) {
              while (($buffer = fgets($handle)) !== false) {

                $buffer = substr($buffer, 0, -3);
          $sql = "INSERT INTO `reestrkp` (`pp`, `KpNumber`, `KpData`, `InnCustomer`, `NameCustomer`, `ContactCustomer`, `idKp`, `StatusKp`, `KpImportance`, `Responsible`, `Comment`, `DateNextCall`, `KpCondition`, `KpSum`, `TenderSum`, `FinishContract`, `LinkKp`, `adress`, `id`, `marker`, `konturLink`) VALUES $buffer";

          // echo "XXX(Zapros)===".$buffer."===(Zapros)XXX<br><br>";

          echo "<br>=".$i."========================================(SQL)=============================<br>".$sql.
          "<br>====================================================(SQL)=========================<br><br>";
               
          
          
             $query = $mysqli->query($sql);
                // $query = 1;
                if (!$query){
                  echo "WE ARE DIE  (Не положили строку в БД)<br>";
                  die(mysqli_error($mysqli) );
                  printf("Соединение не удалось: ");
           }

/// Берем ИНН из строки, которую добавляем, и смотрим продавали ли в эту компанию
               $str_arr=explode(",",$buffer); // Выбираем из строки ИНН
               echo  $inn = $str_arr[3]; // ИНН компании
                $sql1 = "SELECT `sell_comp` FROM `inncompany` WHERE `inn`=$inn";
                $fQuery= $mysqli->query($sql1);
                if ($fQuery -> num_rows > 0) {
                  while ($row = $fQuery -> fetch_assoc()) 
                  {
                   $second_sell = $row["sell_comp"]; // признак, что ранее продавали этой компании
                   echo  "SECkbd_sell =".$second_sell."<br>";
                   }
               }

// берем последнюю запись, которую только что добавили
               $sql1 ="SELECT * FROM `reestrkp` ORDER BY id DESC LIMIT 1";
               $fQuery= $mysqli->query($sql1);
               if ($fQuery -> num_rows > 0) {
                 while ($row = $fQuery -> fetch_assoc()) 
                 {
                  $id = $row["id"]; // признак, что ранее продавали этой компании
                  echo  "Id_zakup =".$id."<br>";
                  }
              }
// Добавляем признак в новую строку, что уже продавали в эту компанию
              if ($second_sell == 1 ) {
                $sql1 ="UPDATE `reestrkp` SET `second_sell`=1 WHERE  id =$id";
                $fQuery= $mysqli->query($sql1);
              }
                if (!$query){
                         echo "WE ARE DIE <br>";
                         die(mysqli_error($mysqli) );
                         printf("Соединение не удалось: ");
                  }
              $i++;
              }
              
          }
          fclose($handle);
          
          echo "<br>ВСЕ ДАННЫЕ ВВЕДЕНЫ....... <br>";
          echo "<br>Файл с первичными данными удален <br>";
          unlink ("../myfile1.txt");
}
?>