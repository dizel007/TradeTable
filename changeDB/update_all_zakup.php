<?php
require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";
require_once "../functions/get_user.php";

// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_POST['id'];
$id=htmlspecialchars($id);

$user_login = GetUser($mysqli); // Получаем имя пользователья

$sql = "SELECT * FROM reestrkp where id = '$id'";
  $fQuery = $mysqli->query($sql);
  $my_id_arr = makeArrayFromObj($fQuery) ;


// $ContactCustomer = $_POST['ContactCustomer'];
// $ContactCustomer=htmlspecialchars($ContactCustomer);
$KpImportance = $_POST ['KpImportance'] ;
$Responsible = $_POST['Responsible'];
$Comment = htmlspecialchars($_POST['Comment']); 
$Comment = trim ( $Comment , $character_mask = " \t\n\r\0\x0B");  // убипаем все лишние пробелы и переносы
 if ($Comment !='')  {
      $dateForComment = date('Y-m-d')."(".$user_login."): "; // добавление в виде даты и логина пользователя
      $oldPerem = str_replace("@!".$dateForComment, '' ,$my_id_arr[0]['Comment'] ); // удаляем 
      $Comment ="@!" . $dateForComment. $Comment."||+ ".$oldPerem; // цепляем дату внесения комметнария
    } else {
      $Comment = $my_id_arr[0]['Comment'];
    }

// $Comment=htmlspecialchars($Comment);

$DateNextCall = $_POST['DateNextCall'] ;
$KpCondition = $_POST['KpCondition'] ;
$KpSum = $_POST['KpSum'] ;
$FinishContract =$_POST['FinishContract'] ;
$Adress = htmlspecialchars($_POST['Adress']);
$dateContract = $_POST['dateContract'] ;
$procent_work = $_POST['procent_work'] ;
$dateFinishContract = $_POST['dateFinishContract'] ;
$today = date("Y-m-d"); 
//Проверяем если закупка закупка продана или закрыта, то добаляем дату продажи или закрытия;
if (($KpCondition == "Не требуется") || ($KpCondition == "Уже купили") || $FinishContract == 1) 
    {
      $date_close = date('Y-m-d');
      $FinishContract = 1;
    } else {$date_close = "";}

if ($KpCondition == "Купили у нас") 
    {
      $date_sell = date('Y-m-d');
      $date_close = date('Y-m-d');
      $FinishContract = 1;
    } else {$date_sell = "";}

if ($KpCondition == "В работе") { $FinishContract = 0; $date_sell = ""; $date_close = "";}
if (($KpCondition == "") && ($FinishContract == 0)) { $FinishContract = 0; $date_sell = ""; $date_close = "";}
if (($KpCondition == "") && ($FinishContract == 1)) { $FinishContract = 1;$date_sell = "";$date_close = date('Y-m-d');}

// Формируем АПдейт в БД
$sql = "UPDATE `reestrkp` SET 
       `KpImportance`= '$KpImportance', 
       `Responsible`= '$Responsible',
       `Comment`= '$Comment',
       `DateNextCall`= '$DateNextCall',
       `KpCondition`= '$KpCondition',
       `KpSum`= '$KpSum',
       `FinishContract`= '$FinishContract',
       `Adress`= '$Adress',
       `dateContract`='$dateContract',
       `date_sell`='$date_sell',
       `date_close`='$date_close',
       `date_write` = '$today',
       `dateFinishContract`='$dateFinishContract',
       `procent_work` = '$procent_work'
        WHERE `id`='$id'";

$query = $mysqli->query($sql);

if (!$query){
  printf("Соединение не удалось: ");
  die();

} 

// Формируем массив для возврата в AJAX  запрос
$backArr = array ("id" => $id, 
             "KpImportance" => $KpImportance,
             "Responsible" => $Responsible,
             "Comment" => $Comment,
             "DateNextCall" => $DateNextCall,
             "KpCondition" => $KpCondition,
             "KpSum" => $KpSum,
             "FinishContract" => $FinishContract,
             "Adress" => $Adress,
             "dateContract" => $dateContract,
             "procent_work" => $procent_work,
             "dateFinishContract" => $dateFinishContract,            
            );






// $fileLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
// $file = "../logs/".$fileLogName.".txt";
// $fileUser = "../logs/user/".$user_login.".txt";
//        $fileAll = '../log.txt';
       $now_date = date('Y-m-d H:i:s');
      //  $temp_var = $now_date." ID=".$id;
      //  $temp_var .= ": Автор: ".$user_login;
      //  $temp_var.="; Важность :".$KpImportance;
      //  $temp_var.="; Ответственный :".$Responsible;
      //  $temp_var.="; Комментарий :".$Comment;
      //  $temp_var.="; Состояние КП :".$KpCondition;
      //  $temp_var.="; Сумма КП = :".$KpSum;
      //  $temp_var.="; Контракт Заключен :".$dateContract;
      //  $temp_var.="; Контракт Закрыт :".$FinishContract;
      //  $temp_var.="; Адрес :".$Adress;
      //  $temp_var.=";\n";

//  Форсурием переменную для записи в ЛОГфайл
//       // Пишем содержимое в файл,
//       // используя флаг FILE_APPEND для дописывания содержимого в конец файла
//       // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время

 
      //  file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // логи по датам
      //  file_put_contents($fileAll, $temp_var, FILE_APPEND | LOCK_EX); // Все логи подряд
      //  file_put_contents($fileUser, $temp_var, FILE_APPEND | LOCK_EX); // Все логи подряд
//// Формируем комментарий в таблицу reports
$db_comment="";
if ($my_id_arr[0]['KpImportance'] != $KpImportance) { $db_comment.="важность :".$KpImportance.";";}
if ($my_id_arr[0]['Responsible']  != $Responsible)     { $db_comment.=" ответств :".$Responsible.";";}
if ($my_id_arr[0]['Comment']  != $Comment)     { $db_comment.=" коммент :".$Comment.";";}
if (($my_id_arr[0]['DateNextCall']  != $DateNextCall) && $DateNextCall !="" )   { $db_comment.=" дата сл.зв. :".$DateNextCall.";";}
if ($my_id_arr[0]['KpCondition']  != $KpCondition)     { $db_comment.=" сост. КП :".$KpCondition.";";}
if ($my_id_arr[0]['KpSum']  != $KpSum)     { $db_comment.=" Сумма КП :".$KpSum.";";}
if (($my_id_arr[0]['dateContract']  != $dateContract) && $dateContract !="") { $db_comment.=" дата закл. конт. :".$dateContract.";";}
if ($my_id_arr[0]['procent_work']  != $procent_work)     { $db_comment.=" проц. вып. конт. :".$procent_work.";";}
if (($my_id_arr[0]['dateFinishContract']  != $dateFinishContract) && $dateFinishContract !=""   ) { $db_comment.=" дата окон. конт. :".$dateFinishContract.";";}
if ($my_id_arr[0]['FinishContract']  != $FinishContract)     { $db_comment.=" Закр. КП :".$FinishContract.";";}
if ($my_id_arr[0]['Adress']  != $Adress)     { $db_comment.=" Адрес :".$Adress.";";}






$date_change = $now_date;
$id_item = $id;
$what_change = 1; 
$comment_change = $db_comment; 
$author = $user_login;
//    require "update_reports.php";
  
$sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
  VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
$query = $mysqli->query($sql);
if (!$query){
printf("Соединение не удалось: ");
die();
} 

// header ("Location: ..?id=".$id);  // перенаправление на нужную страницу
// exit();    // прерываем работу скрипта, чтобы забыл о прошлом
echo json_encode($backArr, JSON_UNESCAPED_UNICODE);
