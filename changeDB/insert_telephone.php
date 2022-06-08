<?php
require_once "../connect_db.php";
require_once "../functions/telephone_make.php";
 
$id = $_GET["id"];
$inn = $_GET["inn"];
$new_telephone = $_GET["telefon"];
$new_telephone=htmlspecialchars($new_telephone);

$new_telephone = telephoneMake($new_telephone); // приводит телефон к стандартному виду

$new_telephone =  DeleteFirstSymbol($new_telephone);
$whatsapp = $_GET["whatsapp"];
$viber = $_GET["viber"];
$actual = $_GET["actual_phone"];
$commentPhone = $_GET["commentPhone"];
$commentPhone=htmlspecialchars($commentPhone);
$contactName = $_GET["contactName"];
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
        // echo "<b>".$new_telephone."  =  ".$phone_,"</b><br>";
       } 
      //  else {
      // echo "".$new_telephone."   |   ".$phone_,"<br>";
      //  }
    }
  }
 
 
  if ($priz <> 1) {
    $sql_insert_phone  = "INSERT INTO `telephone`(`id`, `inn`, `telephone`, `comment`, `whatsapp`, `date_write`, `name`, `old_phone`, `actual` ,`viber`) VALUES ('','$inn','$new_telephone','$commentPhone','$whatsapp', '$today','$contactName','','$actual','$viber')";
    $query = $mysqli->query($sql_insert_phone);
    if (!$query) {
      // echo "WE ARE DIE <br>";
      die(mysqli_error($mysqli));
    }
  } else {
    die("ТАКОЙ НОМЕР УЖЕ СУЩЕСТВУЕТ");
  }

  $sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
  $user = $mysqli->query($sql);
  while ($row = $user -> fetch_assoc()) 
  {
         $user_login = $row["user_login"];
     }


  $now_date = date('Y-m-d');
   
$db_comment="Нов. тел. :$new_telephone :";
$db_comment.="контакт :".$contactName.";";
$db_comment.=" коммент :".$commentPhone.";";
$db_comment.=" актуал :".$actual.";";
 

  $date_change = $now_date;
  $id_item = $inn;
  $what_change = 4; 
  $comment_change = $db_comment; 
  $author = $user_login;
  //    require "update_reports.php";
    
  $sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
    VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
  $query = $mysqli->query($sql);
  if (!$query){
   die("Соединение не удалось: (Добавление в реестр изменений) ");
  }

header ("Location: ../index.php?id=".$id);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом




