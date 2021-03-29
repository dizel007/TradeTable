<?php
require_once "connect_DB.php";
require_once "functions/makeArrFromObj.php";

 $id = $_GET['id'];
            
 $sql = "SELECT * FROM reestrkp where id='$id'";
 $fQuery = $mysqli->query($sql);
 $arr_name = makeArrayFromObj($fQuery) ;
 
//var_dump($arr_name);

  foreach ($arr_name as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'marker') {
            $marker = $value1;
         }
      }
   }

if ($marker == 0 ) {
  $marker=1;}
  else {
    $marker = 0;
  }

$sql = "UPDATE reestrkp SET marker = '$marker' WHERE id = '$id'";
$fQuery = $mysqli->query($sql);



$sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
$user = $mysqli->query($sql);
while ($row = $user -> fetch_assoc()) 
{
       $user_login = $row["user_login"];
   }

      $fileLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
      $file = "logs/".$fileLogName.".txt";
      $fileAll = '../log.txt';
      $now_date = date('Y-m-d H:i:s');
      $temp_var = $now_date." Автор: ".$user_login." ID=".$id;
      $temp_var.="; Смена маркета :".$marker;
      

// $fOpen = fopen($file,'a'); //Открываем файл или создаём если его нет
// fwrite($fOpen, $temp_var); //Записываем
// fclose($fOpen); //Закрываем файл

      // // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
      // file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // логи по датам
      // file_put_contents($fileAll, $temp_var, FILE_APPEND | LOCK_EX); // Все ло

echo $marker;
