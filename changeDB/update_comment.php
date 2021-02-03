<?php
// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_GET['id'];
$typeQuery=$_GET['typeQuery'];
// echo "typeQuery =".$typeQuery."<br>";
// Выбираем какой столбец редактируем 
    if ($typeQuery==11) {
      $changeColumn = 'Comment';
          if (isset($_POST['text'])) 
          { 
            $newPerem = $_POST['text'];
          }
      }

    if  ($typeQuery==12) {
      $changeColumn = 'DateNextCall';
      $newPerem = $_POST['nextdate'];
    }

    if  ($typeQuery==13) { 
      $changeColumn = 'KpCondition';
      $newPerem = $_POST['ChangeCondition'];
    }
// echo "ID = ".$id."<br>";
// echo "Our TExt =".$newPerem."<br>";
require_once "../bodyparts/connect_DB.php";
$sql = "UPDATE `reestrkp` SET `$changeColumn`= '$newPerem' WHERE `id`='$id'";
$query = $mysqli->query($sql);

if (!$query){
die();
printf("Соединение не удалось: ");
}
;
//echo "UPDATE COMMENT <br>";
header ("Location: ..?id=".$id."&typeQuery=".$typeQuery);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом

?>