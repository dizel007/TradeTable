<?php

require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";
// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать

 
  $id_phone = $_POST["id_phone_cor"];

  // достаем данные о записи из таблицы
$sql = "SELECT * FROM `telephone` where `id` = '$id_phone'";
$fQuery = $mysqli->query($sql);
$my_inn_arr = MakeArrayFromObjTelephone($fQuery) ;

  $id = $_POST["id"];
  $telephone = $_POST["telefon"];
  $telephone=htmlspecialchars($telephone);
  $whatsapp = $_POST["whatsapp"];
  $actual = $_POST["actual_phone"];
  $commentPhone = $_POST["commentPhone"];
  $commentPhone=htmlspecialchars($commentPhone);
  $contactName = $_POST["contactName"];
  $contactName=htmlspecialchars($contactName);
  $today = date("Y-m-d H:i:s");       
  
$sql = "UPDATE `telephone` SET 
      `comment`= '$commentPhone' ,
      `whatsapp`= '$whatsapp' ,
      `name`= '$contactName' ,
      `actual`= '$actual' ,
      `date_write` = '$today' 

      WHERE `id`='$id_phone'";

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

   //printf($user_login);
      $fileLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
      
      $file = "../logs/inn/"."ИНН_".$fileLogName.".txt";
      $fileAll = '../logs/inn/log.txt';
      $now_date = date('Y-m-d H:i:s');
      //$temp_var = $now_date." ID=".$id." Столбец: ".$changeColumn."; Изменения :".$newPerem.";\n";
// Форсурием переменную для записи в ЛОГфайл
      $temp_var = $now_date." Автор: ".$user_login." ID=".$id;
      
      // if ($my_inn_arr[0]['telefon']== $telefon) { $telefon='';} 
      //       else { $temp_var.="; Телефон :".$telefon;}
      
      // if ($my_inn_arr[0]['email']== $email) { $email='';}
      //       else { $temp_var.="; Емайл :".$email;}

      // if ($my_inn_arr[0]['contactFace']== $contactFace) { $contactFace='';}
      //       else { $temp_var.="; Контактное лицо :".$contactFace;}
      
      // if ($my_inn_arr[0]['comment']== $comment) { $comment='';}
      //       else { $temp_var.="; Комментарий :".$comment;}

      $temp_var.=";\n";
      
      // Пишем содержимое в файл,
      // используя флаг FILE_APPEND для дописывания содержимого в конец файла
      // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время

      file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // логи по датам

      file_put_contents($fileAll, $temp_var, FILE_APPEND | LOCK_EX); // Все логи подряд


//echo "UPDATE COMMENT <br>";
header ("Location: ..?id=".$id);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом


?>
