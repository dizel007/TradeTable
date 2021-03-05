<?php
require_once "../connect_DB.php";

// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_GET['id'];
$typeQuery=$_GET['typeQuery'];
// echo "typeQuery =".$typeQuery."<br>";
// Выбираем какой столбец редактируем 
// если Изменяем комментарий
    if ($typeQuery==11) {
      $changeColumn = 'Comment';
          if (isset($_POST['text'])) 
          { 
            $newPerem = $_POST['text'];
          }
      }

  // если Изменяем контакты Заказчика
  if ($typeQuery==6) {
    $changeColumn = 'ContactCustomer';
        if (isset($_POST['text'])) 
        { 
          $newPerem = $_POST['text'];
        }
    }
// если Изменяем дату следующего звонка
    if  ($typeQuery==12) {
      $changeColumn = 'DateNextCall';
      $newPerem = $_POST['nextdate'];
    }
// если Изменяем состояние КП
    if  ($typeQuery==13) { 
      $changeColumn = 'KpCondition';
      $newPerem = $_POST['ChangeCondition'];
    }
    // если Изменяем ответственного за КП работника
    if  ($typeQuery==10) { 
      $changeColumn = 'Responsible';
      $newPerem = $_POST['ChangeCondition'];
    }
    if  ($typeQuery==9) { 
      $changeColumn = 'KpImportance';
      $newPerem = $_POST['ChangeCondition'];
    }
    // емли изменяет контракт закрыт/открыт
    if  ($typeQuery==16) { 
      $changeColumn = 'FinishContract';
      $newPerem = $_POST['ChangeCondition'];
    }



// echo "ID = ".$id."<br>";
// echo "Our TExt =".$newPerem."<br>";

$sql = "UPDATE `reestrkp` SET `$changeColumn`= '$newPerem' WHERE `id`='$id'";
$query = $mysqli->query($sql);

if (!$query){
die();
printf("Соединение не удалось: ");
}
;
      $file = '../log.txt';
      $now_date = date('Y-m-d H:i:s');

      $temp_var = $now_date." ID=".$id." Столбец: ".$changeColumn."; Изменения :".$newPerem.";\n";
      // Пишем содержимое в файл,
      // используя флаг FILE_APPEND для дописывания содержимого в конец файла
      // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
      file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX);

//echo "UPDATE COMMENT <br>";
header ("Location: ..?id=".$id."&typeQuery=".$typeQuery);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом

?>