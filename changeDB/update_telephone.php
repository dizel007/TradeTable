<?php

require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";
// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать

 
  $id_phone = $_POST["id_phone_cor"];

  // достаем данные о записи из таблицы
$sql = "SELECT * FROM `telephone` where `id` = '$id_phone'";
$fQuery = $mysqli->query($sql);
$my_inn_arr = MakeArrayFromObjTelephone($fQuery) ;
$inn = $my_inn_arr[0]["inn"];
$tel_phone = $my_inn_arr[0]["telephone"];

  $id = $_POST["id"];
  $telephone = $_POST["telefon"];
  $telephone=htmlspecialchars($telephone);
  $whatsapp = $_POST["whatsapp"];
  $viber = $_POST["viber"];
  $actual = $_POST["actual_phone"];
  $commentPhone = $_POST["commentPhone"];
  $commentPhone=htmlspecialchars($commentPhone);
  $contactName = $_POST["contactName"];
  $contactName=htmlspecialchars($contactName);
  $today = date("Y-m-d H:i:s");       
  
$sql = "UPDATE `telephone` SET 
      `comment`= '$commentPhone' ,
      `whatsapp`= '$whatsapp' ,
      `viber`= '$viber' ,
      `name`= '$contactName' ,
      `actual`= '$actual' ,
      `date_write` = '$today' 

      WHERE `id`='$id_phone'";

$query = $mysqli->query($sql);

if (!$query){
die("Соединение не удалось: ");
};



$sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
$user = $mysqli->query($sql);
while ($row = $user -> fetch_assoc()) 
{
       $user_login = $row["user_login"];
   }

      $now_date = date('Y-m-d');
   
      $db_comment="Изм. тел. :$tel_phone :";
$db_comment.="контакт :".$contactName.";";
$db_comment.=" коммент :".$commentPhone.";";
$db_comment.=" актуал :".$actual.";";
     
      $date_change = $now_date;
      $id_item = $inn;
      $what_change = 3; 
      $comment_change = $db_comment; 
      $author = $user_login;
      //    require "update_reports.php";
        
      $sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
        VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
      $query = $mysqli->query($sql);
      if (!$query){
       die("Соединение не удалось: (Добавление в реестр изменений) ");
      }      
header ("Location: ..?id=".$id);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом


?>
