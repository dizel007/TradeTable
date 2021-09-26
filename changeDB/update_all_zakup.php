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

$Comment = $_POST['Comment'] ; 
 $Comment =  trim ( $Comment , $character_mask = " \t\n\r\0\x0B");  // убипаем все лишние пробелы и переносы
 if ($Comment !='')  {
      
      $dateForComment = date('Y-m-d')."(".$user_login."): "; // добавление в виде даты и логина пользователя
      $oldPerem = str_replace("@!".$dateForComment, '' ,$my_id_arr[0]['Comment'] ); // удаляем 
      $Comment ="@!" . $dateForComment. $Comment."||+ ".$oldPerem; // цепляем дату внесения комметнария
    } else {
      $Comment = $my_id_arr[0]['Comment'];
    }

$Comment=htmlspecialchars($Comment);

$DateNextCall = $_POST['DateNextCall'] ;
$KpCondition = $_POST['KpCondition'] ;
$KpSum = $_POST['KpSum'] ;
$FinishContract =$_POST['FinishContract'] ;
$Adress = $_POST['Adress'];
$Adress = htmlspecialchars($Adress);



$sql = "UPDATE `reestrkp` SET 
       `KpImportance`= '$KpImportance', 
       `Responsible`= '$Responsible',
       `Comment`= '$Comment',
       `DateNextCall`= '$DateNextCall',
       `KpCondition`= '$KpCondition',
       `KpSum`= '$KpSum',
       `FinishContract`= '$FinishContract',
       `Adress`= '$Adress'
        WHERE `id`='$id'";

$backArr = array ("id" => $id, 
             "KpImportance" => $KpImportance,
             "Responsible" => $Responsible,
             "Comment" => $Comment,
             "DateNextCall" => $DateNextCall,
             "KpCondition" => $KpCondition,
             "KpSum" => $KpSum,
             "FinishContract" => $FinishContract,
             "Adress" => $Adress            
            );



// $sql = "UPDATE `reestrkp` SET 
//       `ContactCustomer`= '$ContactCustomer' ,
//       `KpImportance`= '$KpImportance', 
//       `Responsible`= '$Responsible' ,
//       `Comment`= '$Comment' ,
//       `KpSum`= '$KpSum' ,
//       `DateNextCall`= '$DateNextCall' ,
//       `KpCondition`= '$KpCondition' ,
//       `FinishContract`= '$FinishContract' ,
//       `Adress`= '$Adress'       
//       WHERE `id`='$id'";

$query = $mysqli->query($sql);

if (!$query){
die();
printf("Соединение не удалось: ");
} 



//       $fileLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
      
//       $file = "../logs/".$fileLogName.".txt";
       $fileAll = '../log.txt';
       $now_date = date('Y-m-d H:i:s');
       $temp_var = $now_date." ID=".$id;
       $temp_var.="; Важность :".$KpImportance;
       $temp_var.="; Ответственный :".$Responsible;
       $temp_var.="; Комментарий :".$Comment;
       $temp_var.="; Состояние КП :".$KpCondition;
       $temp_var.="; Сумма КП = :".$KpSum;
       $temp_var.="; Контракт Закрыт :".$FinishContract;
       $temp_var.="; Адрес :".$Adress;
       $temp_var.=";\n";

//  // Форсурием переменную для записи в ЛОГфайл

// $temp_var = $now_date." Автор: ".$user_login." ID=".$id;
//       if ($my_id_arr[0]['ContactCustomer']== $ContactCustomer) { $ContactCustomer='';} 
//             else { $temp_var.="; Контакты Заказчика :".$ContactCustomer;}
      
//       if ($my_id_arr[0]['KpImportance']== $KpImportance) { $KpImportance='';}
//             else { $temp_var.="; Важность :".$KpImportance;}

//       if ($my_id_arr[0]['Responsible']== $Responsible) { $Responsible='';}
//             else { $temp_var.="; Ответственный :".$Responsible;}
      
//       if ($my_id_arr[0]['Comment']== $Comment) { $Comment='';}
//             else { $temp_var.="; Комментарий :".$Comment;}

//       if ($my_id_arr[0]['KpSum']== $KpSum) { $KpSum='';}
//             else { $temp_var.="; Сумма КП = :".$KpSum;}
                        
//       if ((string)$my_id_arr[0]['DateNextCall'] == (string)$DateNextCall || (string)$my_id_arr[0]['DateNextCall'] == '') { $DateNextCall = '';}
//             else { $temp_var.="; Дата след.Звонка :".$DateNextCall;}
      
//       if ($my_id_arr[0]['KpCondition']== $KpCondition) { $KpCondition='';}
//             else { $temp_var.="; Состояние КП :".$KpCondition;}
      
//       if ($my_id_arr[0]['FinishContract']== $FinishContract) { $FinishContract='';}
//             else { $temp_var.="; Контракт Закрыт :".$FinishContract;}

//       if ($my_id_arr[0]['Adress']== $Adress) { $Adress='';}
//             else { $temp_var.="; Адрес :".$Adress;}
//       $temp_var.=";\n";
      
//       // Пишем содержимое в файл,
//       // используя флаг FILE_APPEND для дописывания содержимого в конец файла
//       // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время

//       file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // логи по датам

       file_put_contents($fileAll, $temp_var, FILE_APPEND | LOCK_EX); // Все логи подряд


// header ("Location: ..?id=".$id);  // перенаправление на нужную страницу
// exit();    // прерываем работу скрипта, чтобы забыл о прошлом
echo json_encode($backArr, JSON_UNESCAPED_UNICODE);

?>
