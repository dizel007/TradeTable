<?php
require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";
$id = $_GET['id'];
$marker = $_GET['marker'];
//echo ("Hello logger Ajax");

$sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
$user = $mysqli->query($sql);
while ($row = $user -> fetch_assoc()) 
{
       $user_login = $row["user_login"];
   }

   $fileLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
   $file = "../logs/".$fileLogName.".txt";
   $fileAll = '../log.txt';
   $now_date = date('Y-m-d H:i:s');
   $temp_var = $now_date." Автор: ".$user_login." ID=".$id;
   $temp_var.="; Смена маркета :".$marker;
   $temp_var.=";\n";
      
      // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
      file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // логи по датам
      file_put_contents($fileAll, $temp_var, FILE_APPEND | LOCK_EX); // Все ло

 ?>