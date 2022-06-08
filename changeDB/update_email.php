<?php

require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";
// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать

 
  $id_email = $_POST["id_email_cor"];

  // достаем данные о записи из таблицы // В Дальнейшем для комментариев
$sql = "SELECT * FROM `email` where `id` = '$id_email'";
$fQuery = $mysqli->query($sql);
$my_inn_arr = MakeArrayFromObjEmail($fQuery) ;
$inn = $my_inn_arr[0]["inn"];
$real_email = $my_inn_arr[0]["email"];

  $id = $_POST["id"];
  $actual = $_POST["actual_email"];
  $commentEmail = $_POST["commentEmail"];
  $commentEmail=htmlspecialchars($commentEmail);
  $today = date("Y-m-d H:i:s");       
  
$sql = "UPDATE `email` SET 
      `comment`= '$commentEmail' ,
      `actual`= '$actual' ,
      `date_write` = '$today' 

      WHERE `id`='$id_email'";

$query = $mysqli->query($sql);

if (!$query){
die();
printf("Соединение не удалось: ");
};



$sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
//$sql = "SELECT * FROM reestrkp where InnCustomer = '$inn';
$user = $mysqli->query($sql);

while ($row = $user -> fetch_assoc()) 
{
       $user_login = $row["user_login"];
   }


$now_date = date('Y-m-d');
   
$db_comment="Изм.почты. :$real_email :";
$db_comment.=" коммент :".$commentEmail.";";
$db_comment.=" актуал :".$actual.";";
  
   
   $id_item = $inn;
   $what_change = 5; 
   $comment_change = $db_comment; 
   $author = $user_login;
   require "update_reports.php";
     
  //  $sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
  //    VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
  //  $query = $mysqli->query($sql);
  //  if (!$query){
  //   die("Соединение не удалось: (Добавление в реестр изменений) ");
  //  }


header ("Location: ../index.php?id=".$id);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом


?>
