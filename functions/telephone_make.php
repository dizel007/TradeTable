<?php


  // ИНН  и проверяем есть ли он в базе данных с таким ИНН
function InsertOurTelephoneInDB ($mysqli,$inn, $new_telephone){
 
//
  $new_telephone = DeleteFirstSymbol(telephoneMake($new_telephone));
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

  ?>

