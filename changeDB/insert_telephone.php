<?php

require_once "../connect_db.php";
require_once "../functions/telephone_make.php";
 
$id = $_POST["id"];
$inn = $_POST["inn"];
$new_telephone = $_POST["telefon"];
$new_telephone=htmlspecialchars($new_telephone);
$new_telephone = telephoneMake($new_telephone); // приводит телефон к стандартному виду
$new_telephone =  DeleteFirstSymbol($new_telephone);
$whatsapp = $_POST["whatsapp"];
$actual = $_POST["actual_phone"];
$commentPhone = $_POST["commentPhone"];
$commentPhone=htmlspecialchars($commentPhone);
$contactName = $_POST["contactName"];
$contactName=htmlspecialchars($contactName);
$today = date("Y-m-d H:i:s"); 


// Вычитываем все телефоны с таким ИНН
$sql = "SELECT telephone FROM telephone WHERE inn = '$inn'";
$query = $mysqli->query($sql);
$i = 0;
while ($row = $query->fetch_assoc()) {
  $phone_db[] = $row["telephone"];
  $i++;
}
$priz = 0;
if (isset($phone_db)) {
  
    foreach ($phone_db as $key => $phone_) {
      $phone_ =  DeleteFirstSymbol($phone_);
      if ($new_telephone == $phone_) { 
        $priz = 1;
        echo "<b>8 ".$new_telephone."  =  8 ".$phone_,"</b><br>";
       } else {
      echo "8 ".$new_telephone."   |   8 ".$phone_,"<br>";
       }
    }
  }
 
  $new_telephone = "8 ".$new_telephone;
  if ($priz <> 1) {
    $sql_insert_phone  = "INSERT INTO `telephone`(`id`, `inn`, `telephone`, `comment`, `whatsapp`, `date_write`, `name`, `old_phone`) VALUES ('','$inn','$new_telephone','$commentPhone','$whatsapp', '$today','$contactName','')";
    $query = $mysqli->query($sql_insert_phone);
    if (!$query) {
      echo "WE ARE DIE <br>";
      die(mysqli_error($mysqli));
      printf("Соединение не удалось: ");
    }
  } else {
     exit("ТАКОЙ НОМЕР УЖЕ СУЩЕСТВУЕТ");
  }

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
