
<?php
 require_once ("connect_db.php"); // подключение к БД
 
 if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) // Проверяем зарегистрирован ли пользователь
     {
        $sql = "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1";
        $query = $mysqli->query($sql);
        $userdata = mysqli_fetch_assoc($query);
    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
         {
             setcookie("id", "", time() - 3600*26, "/");
             setcookie("hash", "", time() - 3600*26, "/", null, null, true); // httponly !!!
             header("Location: login.php"); exit();
         }
         else
         {
           $user = $userdata['user_login'];
           $userType = $userdata['userType'];
             
           require_once ("bodyparts/header.php"); // header HTML
       //  require_once ("connect_db.php");
           require_once ("functions/select_from_db.php");
           require_once ("functions/make_arr_from_obj.php");
           require_once ("functions/print_our_table.php");

           $summa=0;           
 Echo "Продано с 01.04.2022 по 31.05.2022 <br><br>";
 $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
 $sql = "SELECT * FROM `reestrkp` WHERE `Responsible`='Штыбко' AND `date_sell` > '2022-04-01'";
 $query= $mysqli->query($sql);
 $arr_user = MakeArrayFromObj($query);               
 printOurTable($arr_user, $FinishContract,0,10000);
 // Высчитываем сумму проданных КП
 foreach ($arr_user as $key => $value) {
  foreach ($value as $key1 => $value1) {
    if ($key1 == 'KpSum') {
      $summa = $summa + $value1;
    }
  }
}
echo "СУММА ПРОДАЖ = ". number_format($summa)."<br>";

Echo "<br>Коммерческие предложения компаниям, которым продавали ранее <br>";
$FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
$sql = "SELECT * FROM `reestrkp` WHERE `Responsible`='Штыбко' AND `second_sell`=1 AND `FinishContract` =0";
$query= $mysqli->query($sql);
$arr_user = MakeArrayFromObj($query);               
if (isset($arr_user[0]['idKp'])) {printOurTable($arr_user, $FinishContract,0,10000);}


            $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
            $sql = "SELECT * FROM `reestrkp` WHERE `Responsible`='Штыбко' AND `KpData` >= '2022-04-01' AND `KpData` <= '2022-05-31' ORDER BY `KpNumber` DESC, `KpData` DESC";
            $query= $mysqli->query($sql);
            $arr_user = MakeArrayFromObj($query);               
    
$date_now = date('Y-m-d');
$Date_call=0;
$Close_KP=0;
 
foreach ($arr_user as $key => $value) {
  foreach ($value as $key1 => $value1) {
//Считаем сумму выбранных КП
   if ($key1 == 'KpSum') 
      {
     $summa = $summa + $value1;
       }
// Считаем количество просроченных КП
    if ($key1 == 'DateNextCall') 
    {
      if (($date_now > $value1) && ($value1 <>'0000-00-00') && ($value['FinishContract'] ==0 ))
            {
             $Date_call++;
             }
     }
 // Считаем количество закрытых КП
 if ($key1 == 'FinishContract')  {
   if (($value['KpCondition'] <> 'Купили у нас') && ($value['FinishContract'] == '1'))
      {
       $Close_KP++;
    }
            
  }                       
 }
 }
/// Выводим информацию на экран
echo "<br>с 01.04.2022 по 31.05.2022 <br> Сформировано :".count($arr_user)." КП <br> Звонок просрочен в " .$Date_call. " КП;";
echo "<br>Пропало ". $Close_KP." КП<br>";
echo "<br>Сформировано КП на сумму = ". number_format($summa)."<br><br>";

             printOurTable($arr_user, $FinishContract,0,10000);

       require_once ("bodyparts/footer.php"); // подвал страниы
      }
     }
 else
 {
      header("Location: login.php"); exit();
 }
 ?>


