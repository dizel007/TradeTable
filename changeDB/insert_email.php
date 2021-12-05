<?php

require_once "../connect_db.php";
require_once "../functions/telephone_make.php";
 
$id = $_POST["id"];
$inn = $_POST["inn"];
$new_email = $_POST["new_email"];
$new_email=htmlspecialchars($new_email);
$email_from_kp = $new_email;
require_once("../mailer/modul/valid_email.php"); // Проверяем валидный ли емайл
$actual_email = $_POST["actual_email"];
$commentEmail = $_POST["commentEmail"];
$commentEmail=htmlspecialchars($commentEmail);
$today = date("Y-m-d H:i:s"); 


// Вычитываем все телефоны с таким ИНН
$sql = "SELECT email FROM email WHERE inn = '$inn'";
$query = $mysqli->query($sql);
$i = 0;
while ($row = $query->fetch_assoc()) {
  $email_db[] = $row["email"];
  $i++;
}
$priz = 0;
if (isset($email_db)) {
  
    foreach ($email_db as $key => $email_) {
      
      if ($new_email == $email_) { 
        $priz = 1;
        echo "<b>".$new_email."  =  ".$email_,"</b><br>";
       } else {
      echo "".$new_email."   |   ".$email_,"<br>";
       }
    }
  }
 
 
  if ($priz <> 1) {
    $sql_insert_email  = "INSERT INTO `email`(`id`, `inn`, `email`, `comment`,`date_write`, `actual`)
                                      VALUES ('','$inn','$new_email','$commentEmail','$today','$actual_email')";
    $query = $mysqli->query($sql_insert_email);
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
