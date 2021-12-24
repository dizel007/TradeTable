<?php
// require_once("../changedb/insert_telephone.php");

  // ИНН  и проверяем есть ли он в базе данных с таким ИНН
function InsertOurTelephoneInDB ($mysqli,$inn, $new_telephone){
 
//
  $new_telephone = telephoneMake($new_telephone);
  $new_telephone = DeleteFirstSymbol($new_telephone);
  $new_telephone = substr($new_telephone, 0, 17);
 
  $commentPhone="";
  $whatsapp=0;
  $today = date("Y-m-d H:i:s"); 
  $contactName="";
  $actual="";

  $sql_insert_phone  = "INSERT INTO `telephone`(`id`, `inn`, `telephone`, `comment`, `whatsapp`, `date_write`, `name`, `old_phone`, `actual`) VALUES ('','$inn','$new_telephone','$commentPhone','$whatsapp', '$today','$contactName','','$actual')";
    $query = $mysqli->query($sql_insert_phone);
    if (!$query) {
      echo "WE ARE DIE <br>";
      die(mysqli_error($mysqli));
      printf("Соединение не удалось: ");
    }
 
}

function InsertOurEmailInDB ($mysqli,$inn, $new_email){
  // Вычитываем все телефоны с таким ИНН
   
  $commentEmail="";
  $today = date("Y-m-d H:i:s"); 
  $actual_email="";

  $sql_insert_email  = "INSERT INTO `email`(`id`, `inn`, `email`, `comment`,`date_write`, `actual`)
  VALUES ('','$inn','$new_email','$commentEmail','$today','$actual_email')";
$query = $mysqli->query($sql_insert_email);
if (!$query) {
echo "WE ARE DIE <br>";
die(mysqli_error($mysqli));
printf("Соединение не удалось: ");
}
 
}

function telephoneMake($value) {
  $value = preg_replace('/[^0-9]/', '', $value);
  $value = preg_replace('/[D]/', '', $value);
  $value = substr_replace($value, " ", 1, 0);
  $value = substr_replace($value, "(", 2, 0);
  $value = substr_replace($value, ")", 6, 0);
  $value = substr_replace($value, " ", 7, 0);
  $value = substr_replace($value, "-", 11, 0);
  $value = substr_replace($value, "-", 14, 0);
return $value;
  }

function DeleteFirstSymbol($value) {
 $toDelete = 1; // сколько знаков надо убрать
mb_internal_encoding("UTF-8");
$value = mb_substr( $value, $toDelete);
$value = trim($value);
$value = "7 ".$value;
return $value;
}
?>