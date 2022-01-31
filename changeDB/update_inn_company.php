<?php
require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";
// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_POST['id'];
$inn = $_POST['inn'];

$sql = "SELECT * FROM inncompany where inn = '$inn'";
  $fQuery = $mysqli->query($sql);
  $my_inn_arr = MakeArrayFromObjINN($fQuery) ;

  $inn = $_POST['inn'];
//   $telefon = $_POST['telefon'];
//   $email = $_POST['email'];
  $contactFace = $_POST['contactFace'];
  $contactFace =  trim ( $contactFace , $character_mask = " \t\n\r\0\x0B");  // убипаем все лишние пробелы и переносы
  $comment = $_POST['comment'];
  $comment =  trim ( $comment , $character_mask = " \t\n\r\0\x0B");  // убипаем все лишние пробелы и переносы

// $telefon=htmlspecialchars($telefon);
// $email=htmlspecialchars($email);
$contactFace=htmlspecialchars($contactFace);
$comment=htmlspecialchars($comment);



$sql = "UPDATE `inncompany` SET 
      
      `contactFace`= '$contactFace' ,
      `comment`= '$comment' 

     
      WHERE `inn`='$inn'";

$query = $mysqli->query($sql);

if (!$query){
die();
printf("Соединение не удалось: ");
}
;
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
      // $temp_var = $now_date." Автор: ".$user_login." ID=".$id;
      $db_comment="";      if ($my_inn_arr[0]['contactFace'] != $contactFace) { $db_comment.="конт.лицо :".$contactFace.";";}
      if ($my_inn_arr[0]['comment'] != $comment)    { $db_comment.=" комент :".$comment.";";}
      // if ($my_inn_arr[0]['telefon']== $telefon) { $telefon='';} 
      //       else { $temp_var.="; Телефон :".$telefon;}
      
      // if ($my_inn_arr[0]['email']== $email) { $email='';}
      //       else { $temp_var.="; Емайл :".$email;}

      // if ($my_inn_arr[0]['contactFace']== $contactFace) { $contactFace='';}
      //       else { $temp_var.="; Контактное лицо :".$contactFace;}
      
      // if ($my_inn_arr[0]['comment']== $comment) { $comment='';}
      //       else { $temp_var.="; Комментарий :".$comment;}

      
$date_change = $now_date;
$id_item = $inn;
$what_change = 2; 
$comment_change = $db_comment; 
$author = $user_login;
//    require "update_reports.php";
  
$sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
  VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
// echo $sql_u."<br>";

$query = $mysqli->query($sql);

if (!$query){
  die();
  printf("Соединение не удалось: ");
}


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
<!-- 
$KpCondition = $_POST['KpCondition'] ;
                 //  echo $arr_name[$i]['KpSum'] ;
                //   echo $arr_name[$i]['TenderSum'] ;
$FinishContract = ['FinishContract'] ;
                  // echo $arr_name[$i]['LinkKp'] ;
$Adress = $_POST['Adress']; -->