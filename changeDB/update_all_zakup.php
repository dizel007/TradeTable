<?php
require_once "../connect_DB.php";

// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_POST['id'];
                 //  echo $arr_name[$i]['pp'];
                  //  echo $arr_name[$i]['KpNumber'];
                //    echo $arr_name[$i]['KpData'];
                //    echo $arr_name[$i]['InnCustomer'];
                  //  echo $arr_name[$i]['NameCustomer'];
$ContactCustomer = $_POST['ContactCustomer'];
$ContactCustomer=htmlspecialchars($ContactCustomer);
                 //   echo $arr_name[$i]['idKp'];
//$StatusKp = $_POST['StatusKp'];
$KpImportance = $_POST ['KpImportance'] ;
$Responsible = $_POST['Responsible'];
$Comment = $_POST['Comment'] ;
$Comment=htmlspecialchars($Comment);

$DateNextCall = $_POST['DateNextCall'] ;
$KpCondition = $_POST['KpCondition'] ;
                 //  echo $arr_name[$i]['KpSum'] ;
                //   echo $arr_name[$i]['TenderSum'] ;
$FinishContract = ['FinishContract'] ;
                  // echo $arr_name[$i]['LinkKp'] ;
$Adress = $_POST['Adress'];
$Adress=htmlspecialchars($Adress);
                  // echo $arr_name[$i]['id'] ;








$id=htmlspecialchars($id);
$typeQuery=$_GET['typeQuery'];
$typeQuery=htmlspecialchars($typeQuery);
// echo "typeQuery =".$typeQuery."<br>";
// Выбираем какой столбец редактируем 
// если Изменяем комментарий
    
$newPerem=htmlspecialchars($newPerem);


// echo "ID = ".$id."<br>";
// echo "Our TExt =".$newPerem."<br>";

$sql = "UPDATE `reestrkp` SET 
      `ContactCustomer`= '$ContactCustomer' ,
      `KpImportance`= '$KpImportance' ,
      `Responsible`= '$Responsible' ,
      `Comment`= '$Comment' ,
      `DateNextCall`= '$DateNextCall' ,
      `KpCondition`= '$KpCondition' ,
      `FinishContract`= '$FinishContract' ,
      `Adress`= '$Adress'       
      WHERE `id`='$id'";

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

      $file = '../log.txt';
      $now_date = date('Y-m-d H:i:s');
      //$temp_var = $now_date." ID=".$id." Столбец: ".$changeColumn."; Изменения :".$newPerem.";\n";
      $temp_var = $now_date." Автор: ".$user_login." ID=".$id.
      "; Контакты Заказчика: ".$ContactCustomer.
      "; Важность :".$KpImportance.
      "; Ответственный :".$Responsible.
      "; Комментарий :".$Comment.
      "; Дата след.Звонка :".$DateNextCall.
      "; Состояние КП :".$KpCondition.
      "; Контракт Закрыт :".$FinishContract.
      "; Адрес :".$Adress.";\n";
      // Пишем содержимое в файл,
      // используя флаг FILE_APPEND для дописывания содержимого в конец файла
      // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
      file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX);

//echo "UPDATE COMMENT <br>";
header ("Location: ..?id=".$id);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом

?>

$KpCondition = $_POST['KpCondition'] ;
                 //  echo $arr_name[$i]['KpSum'] ;
                //   echo $arr_name[$i]['TenderSum'] ;
$FinishContract = ['FinishContract'] ;
                  // echo $arr_name[$i]['LinkKp'] ;
$Adress = $_POST['Adress'];