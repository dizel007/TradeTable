<?php
// require_once "../connect_DB";
require_once ("../bodyparts/header.php"); // header HTML
require_once ("../connect_db.php");

function delStringByNum($fileName, $num){
  // Открываем файл
  $file = @file($fileName);
  // если файл не найден, выводим ошибку
  if(!$file){
      trigger_error("File '$fileName' not found!");
      return false;
  }
  // если номер строки не корректный, сообщим об этом
  if(!isset($file[$num-1])){
      trigger_error("Incorrect number string: ($num)");
      return false;
  }
  // удаляем строку
  $num = intval($num)-1;
  unset($file[$num]);
  // открываем файл для записи
  $fileOpen = @fopen($fileName,"w"); 
  // если файл невозможно редактировать, сообщаем об этом
  if(!$file){
      trigger_error("File '$fileName' is not writable!");
      return false;
  }
  // перезаписываем файл
  fputs($fileOpen,implode("",$file)); 
  fclose($fileOpen);
  return true;
}
// пример использования функции
// mb_internal_encoding("UTF-8");  // не работает
$filename = "../myinn_file2.txt";
if (!file_exists($filename)) {
  echo "Файл с ИНН команий НЕ существует";
  die();
} else {
  
echo "СТАРТ ЗАГРУЗКИ ДАННЫХ в БАЗУ ДАННЫХ ............................. <br>";
$handle = fopen ("../myinn_file2.txt", "r");

$lines = file('../myinn_file2.txt');

//$array = null;


$i=0;
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {
      $buffer = substr($buffer, 0, -3);
      $buffer =  trim ( $buffer , $character_mask = "﻿");
     
$sql = "INSERT INTO `inncompany`(`id`, `pp`, `inn`, `name`, `fullName`, `telefon`, `email`, `adress`, `contactFace`, `comment`) VALUES $buffer";



echo "<br>=".$i."========================================(SQL)===================================<br>".$sql.
"<br>====================================================(SQL)====================================<br><br>";

       $query = $mysqli->query($sql);


       

       if (!$query){
                echo "WE ARE DIE <br>";
                die(mysqli_error($mysqli) );
                printf("Соединение не удалось: ");
        }
        $i++;  
  }
}
unset($buffer);
fclose($handle);
  echo "<br>ВСЕ ДАННЫЕ ВВЕДЕНЫ....... <br>";
  echo "<br>Файл с первичными данными удален <br>";
  unlink ("../myinn_file2.txt");
}
?>