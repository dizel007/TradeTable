<?php
require_once ("../bodyparts/header.php"); // header HTML
require_once ("../connect_db.php");
require_once ("../functions/telephone_make.php");

$filename = "../myinn_file2.txt";
if (!file_exists($filename)) {
  echo "Файл с ИНН команий НЕ существует";
  die();
} else {
  
echo "СТАРТ ЗАГРУЗКИ ДАННЫХ в БАЗУ ДАННЫХ ............................. <br>";
$handle = fopen ("../myinn_file2.txt", "r");
$lines = file('../myinn_file2.txt');

$i=0;
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
      $buffer = substr($buffer, 0, -3);
      $buffer =  trim ( $buffer , $character_mask = "﻿");

      $arr = explode(",", $buffer); // 
      $inn = $arr[2]; // выгребаем ИНН из массива
      $inn = substr($inn, 1,-1);  // убираем галочки с ИНН
  /// проверяем, нет ли случайно этого ИНН в БД
      $sql = "SELECT * from inncompany WHERE inn = '$inn'";
      $query = $mysqli->query($sql);
      if (!$query)
        {
                echo "WE ARE DIE <br>";
                die(mysqli_error($mysqli) );
                printf("Соединение не удалось: ");
        }

       if ($query->num_rows <> 0) {
         echo "ИНН уже существуует <br>";
       }else {
        echo "Такого ИНН нет<br>";
////// ЕСЛИ ТАКОГО ИНН НЕТ, ТО ЗАГРУЖАЕМ ЕГО В БД   
              $today = ",'".date("Y-m-d H:i:s")."'";
              // echo "<br>=====".$buffer."===<br>";

              $buffer = substr_replace($buffer, $today, strlen($buffer)-1, 0);                     
              // echo "<br>=====".$buffer."===<br>";
              $sql = "INSERT INTO `inncompany`(`id`, `pp`, `inn`, `name`, `fullName`, `telefon`, `email`, `adress`, `contactFace`, `comment`,`date_write`) VALUES $buffer";
              echo "<br>=".$i."========================================(SQL)===================================<br>".$sql.
              "<br>====================================================(SQL)====================================<br><br>";
              $query = $mysqli->query($sql);
                    if (!$query){
                              echo "WE ARE DIE <br>";
                              die(mysqli_error($mysqli) );
                              printf("Соединение не удалось: ");
                      }

                /// достаем      
                $arr = explode(",", $buffer);
                $sql = "SELECT * FROM inncompany WHERE `inn` = $inn LIMIT 1";
                $query = $mysqli->query($sql);
                while ($row = $query->fetch_assoc()) {
                    $phone_db[] = $row["telefon"];
                    $new_telephones = explode("," , $phone_db[$i]);
                    $k=0;
                        while ($k < count($new_telephones))
                        {
                          /// добавляем телефоны в свою таблицу
                          InsertOurTelephoneInDB($mysqli, $inn, $new_telephones[$k]);
                          $k++;
                        }
                  $email_db[] = $row["email"];
                  $new_emails = explode("," , $email_db[$i]);
                  $k=0;
                        while ($k < count($new_emails))
                        {
                          /// добавляем емайлы в свою таблицу
                          InsertOurEmailInDB($mysqli, $inn, $new_emails[$k]);
                          $k++;
                        }
                  
                }
                $i++;
        }
  }
}
unset($buffer);
fclose($handle);
  echo "<br>ВСЕ ДАННЫЕ ВВЕДЕНЫ....... <br>";
  echo "<br>Файл с первичными данными удален <br>";
  unlink ("../myinn_file2.txt");
}
?>