<?php
require_once "../connect_DB.php";

// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_GET['id'];
$id=htmlspecialchars($id);
$typeQuery=$_GET['typeQuery'];
$typeQuery=htmlspecialchars($typeQuery);
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

$newPerem=htmlspecialchars($newPerem);


// echo "ID = ".$id."<br>";
// echo "Our TExt =".$newPerem."<br>";

$sql = "UPDATE `reestrkp` SET `$changeColumn`= '$newPerem' WHERE `id`='$id'";
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
    $file = "../logs/".$fileLogName.".txt";
    $fileAll = '../log.txt';
  //    $file = '../log.txt';
      $now_date = date('Y-m-d H:i:s');
      //$temp_var = $now_date." ID=".$id." Столбец: ".$changeColumn."; Изменения :".$newPerem.";\n";
      $temp_var = $now_date." Автор: ".$user_login." ID=".$id." Столбец: ".$changeColumn."; Изменения :".$newPerem.";\n";
      // Пишем содержимое в файл,
      // используя флаг FILE_APPEND для дописывания содержимого в конец файла
      // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
      file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // логи по датам
      file_put_contents($fileAll, $temp_var, FILE_APPEND | LOCK_EX); // Все логи подряд

//echo "UPDATE COMMENT <br>";
header ("Location: ..?id=".$id."&typeQuery=".$typeQuery);  // перенаправление на нужную страницу
exit();    // прерываем работу скрипта, чтобы забыл о прошлом

?>