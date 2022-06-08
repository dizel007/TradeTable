<?php
// Формируем аналитика по Пользователям
$date_now=date('Y-m-d');
$date_end=date('Y-m-d');
if (!isset($some_days)) {$some_days=0;}
if (isset($_GET['some_days'])) {$some_days = $_GET['some_days'];}
$days_after_new  = strtotime("$some_days days");
$date_start = date('Y-m-d', $days_after_new);
if (isset($_GET['date_start'])) {$date_start = $_GET['date_start'];}
if (isset($_GET['date_start']))  
    {
      if (($_GET['date_start']==""))  {$date_start = $date_now;}
    }
if (isset($_GET['date_end']))  {$date_end = $_GET['date_end']; }
if (isset($_GET['date_end']))  
    {
      if (($_GET['date_end']==""))  {$date_end = $date_now;}
    }

$summa=0;
$active_people = count($arr_users_active); // 


// формируем массив выбранных пользователей
for ($i=0; $i< $active_people; $i++) {
  $name_temp= 'user'.$i;
  if (isset($_GET["$name_temp"])) {
      $rep_arr_users[] = $_GET["$name_temp"];
  }
}
if (!isset($rep_arr_users)) {
  die ("Не выбран ни один пользователь");
}
// ФОрмируем массив по всем активным пользователям
echo "Выбранные пользователи: ";
foreach($rep_arr_users as $value) {
  echo $value." ,";
  $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible`='$value' AND `date_sell` >= '$date_start' 
  AND `date_sell` <= '$date_end' ORDER BY `date_sell` DESC";
  // echo $sql."<br>";
  $query= $mysqli->query($sql);
  $arr_users_kp = MakeArrayFromObj($query);               
  
  if (isset($arr_users_kp[0]['id'])) { // Проверяем есть ли строки в массиве
    $arr_users_kp_change[] = $arr_users_kp;
  }
 
} 
// echo "<pre>";
// var_dump ($rep_arr_users);
// echo "<pre>";
if (!isset($arr_users_kp_change)) {
  die ("Нет Проданных КП");
}
echo "КП, проданные за период с ".$date_start." по ".$date_end;
// уменьшаем уровень вложенности
  $outArray = call_user_func_array('array_merge', $arr_users_kp_change);

  printOurTable($outArray, $FinishContract,0,10000);


  
?>