<?php
require_once "../connect_DB.php";
require_once "../functions/makeArrFromObj.php";
// Обновляем данные в талиблице. $typeQuery - выбоо столбца, который будем редактировать. $id -  ИД строки которую будем редактировать
$id = $_POST['id'];
$id=htmlspecialchars($id);
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
$Comment =" ". date('Y-m-d').": ". $_POST['Comment'] ;
$Comment=htmlspecialchars($Comment);

$DateNextCall = $_POST['DateNextCall'] ;
$KpCondition = $_POST['KpCondition'] ;
                 //  echo $arr_name[$i]['KpSum'] ;
                //   echo $arr_name[$i]['TenderSum'] ;
$FinishContract =$_POST['FinishContract'] ;
                  // echo $arr_name[$i]['LinkKp'] ;
$Adress = $_POST['Adress'];
$Adress=htmlspecialchars($Adress);
                  // echo $arr_name[$i]['id'] ;
$id=htmlspecialchars($id);

// echo "ID = ".$id."<br>";
// echo "Our TExt =".$newPerem."<br>";

$sql = "SELECT * FROM reestrkp where id = '$id'";
  $fQuery = $mysqli->query($sql);
  $my_id_arr = makeArrayFromObj($fQuery) ;

// $sql = "SELECT * FROM 'reestrkp' WHERE 'id' = $id";
// $query=$mysqli->query($sql);
// $my_id_arr = MakeArrayFromObj($query);


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
      $fileLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
      
      $file = "../logs/".$fileLogName.".txt";
      $fileAll = '../log.txt';
      $now_date = date('Y-m-d H:i:s');
      //$temp_var = $now_date." ID=".$id." Столбец: ".$changeColumn."; Изменения :".$newPerem.";\n";
      $temp_var = $now_date." Автор: ".$user_login." ID=".$id;
      if ($my_id_arr[0]['ContactCustomer']== $ContactCustomer) { $ContactCustomer='';} 
            else { $temp_var.="; Контакты Заказчика :".$ContactCustomer;}
      
      if ($my_id_arr[0]['KpImportance']== $KpImportance) { $KpImportance='';}
            else { $temp_var.="; Важность :".$KpImportance;}

      if ($my_id_arr[0]['Responsible']== $Responsible) { $Responsible='';}
            else { $temp_var.="; Ответственный :".$Responsible;}
      
            if ($my_id_arr[0]['Comment']== $Comment) { $Comment='';}
      else { $temp_var.="; Комментарий :".$Comment;}
      
      if ($my_id_arr[0]['DateNextCall'] == $DateNextCall) { $DateNextCall='';}
      else { $temp_var.="; Дата след.Звонка :".$DateNextCall;}
      
      if ($my_id_arr[0]['KpCondition']== $KpCondition) { $KpCondition='';}
      else { $temp_var.="; Состояние КП :".$KpCondition;}
      
      if ($my_id_arr[0]['FinishContract']== $FinishContract) { $FinishContract='';}
            else { $temp_var.="; Контракт Закрыт :".$FinishContract;}

      if ($my_id_arr[0]['Adress']== $Adress) { $Adress='';}
      else { $temp_var.="; Адрес :".$Adress;}
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