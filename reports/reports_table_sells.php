<?php
// Формируем аналитика по Пользователям
$date_now=date('Y-m-d');
$date_start = "";
$date_end=date('Y-m-d');
$some_days=0;
if (isset($_GET['some_days'])) {$some_days = $_GET['some_days'];}
$days_after_new  = strtotime("$some_days days");
$date_start = date('Y-m-d', $days_after_new);
if (isset($_GET['date_start'])) {$date_start = $_GET['date_start'];}
if (isset($_GET['date_end']))  {$date_end = $_GET['date_end']; }
if (isset($_GET['date_end']))  
    {
      if (($_GET['date_end']==""))  {$date_end = $date_now;}
    }
// echo "Start date:".$date_start." End_date: ".$date_end;
$sql_plus =""; // формируем пустую строку для SQL запроса

if ((isset($date_start) or (isset($date_end)))) {
    if (($date_start <> "") and ($date_end == "")) { 
      $sql_plus = " AND KpData >= '$date_start'  ORDER BY KpData DESC , KpNumber DESC";
    }  elseif (($date_start == "") and ($date_end <> "")) {
      $sql_plus = " AND KpData <= '$date_end'  ORDER BY KpData DESC , KpNumber DESC";
    } else {
      $sql_plus = " AND (KpData >= '$date_start' AND KpData <= '$date_end')  ORDER BY KpData DESC , KpNumber DESC";
    }
}

$sql="SELECT * FROM `reestrkp` WHERE `Responsible` = '' $sql_plus";
$query = $mysqli->query($sql);
$arr_info_user = MakeArrayFromObj($query);

// Получаем количество нераспределенных Заявок за выбранный период
$not_obrabot_kp=0;
if (isset($arr_info_user[0]["Responsible"])) {$not_obrabot_kp = count($arr_info_user);}
// echo "<br>---".$sql."---<br>";


// ФОрмируем массив по всем активным пользователям
for ($i=0; $i<count($arr_users_active); $i++) {
   $user_name = $arr_users_active[$i]['user_name']; // берем первого активного пользоватея
   $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$user_name' $sql_plus";
    // echo "<br>---".$sql."---<br>";
     $query = $mysqli->query($sql);
    $arr_info_user = MakeArrayFromObj($query);
  

// Формируем массив с данными по Ответственному, без дат, чтобы получить кол-во проданных КУПИЛИ

// Находим количество Заявок в работе
  $count_new_kp=0;
  $count_work=0;
  $count_buy=0;
  $kp_summa=0;
  $kp_close=0;
  $overdue_kp=0;
  
//   echo "<pre>";
// var_dump($arr_info_user);
// echo "<pre>";
  for ($j=0; $j<count($arr_info_user); $j++) {
// кол-во новых КП 
    if ((isset($arr_info_user[0]["KpCondition"])) && ($arr_info_user[$j]["KpCondition"] == "") && ($arr_info_user[$j]["FinishContract"] <>1 ))  {$count_new_kp++;} 
// количество взятых в работы  
    if (($arr_info_user[$j]["KpCondition"] == "В работе" ) && ($arr_info_user[$j]["FinishContract"] <>1 )) {$count_work++;} 
// количество и сумма купленных КП
  }
   $arr_kpcond_new_kp[$i] = $count_new_kp;  // массив с данными по КП новым КП
   $arr_kpcond_in_work[$i] = $count_work;  // массив с данными по КП которые в работе
   if (isset($arr_info_user[0]["KpCondition"])) {$arr_all_new_kp[$i] = $j;}
   else  {$arr_all_new_kp[$i] = 0;}// полное количество поступивших Заявок



// ******************************************************* ПРОДАЖИ  + ПРОСРОЧЕННЫЕ КП**************************
$sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$user_name'";
$query = $mysqli->query($sql);
// && ($arr_info_user[$j]["FinishContract"] <>1
$arr_info_user_for_sell = MakeArrayFromObj($query);
for ($j=0; $j<count($arr_info_user_for_sell); $j++) {
      if (($arr_info_user_for_sell[$j]["KpCondition"] == "Купили у нас")  && 
          ( $date_end >= $arr_info_user_for_sell[$j]["date_sell"] )  &&
          ( $date_start <= $arr_info_user_for_sell[$j]["date_sell"] ))
              {
                  $count_buy++;
                  $kp_summa = $kp_summa + $arr_info_user_for_sell[$j]["KpSum"];
              }
      if (($arr_info_user_for_sell[$j]["DateNextCall"] < $date_now) && ($arr_info_user_for_sell[$j]["DateNextCall"] <>'0000-00-00') && ($arr_info_user_for_sell[$j]["FinishContract"] <>1)  ) 
      { 
        $overdue_kp++;
      }
  }
  $arr_kpcond_buy[$i] = $count_buy;  // массив с данными по КП которые в работе
  $arr_kp_summa[$i] = $kp_summa; // сумма продаж за период
  if (isset($arr_info_user_for_sell[0]["KpCondition"])) {$arr_overdue_kp[$i] = $overdue_kp;}
  else  {$arr_overdue_kp[$i] = 0;}// полное количество поступивших Заявок
  ;  // массив с данными по КП которые в работе
 // ******************************************************* ПРОДАЖИ КОНЕЦ **************************
// ************************ ПРОСРОЧЕННЫЕ КП *********************************





// ************************ КОНЕЦ ПРОСРОЧЕННЫЕ КП *********************************
}
// echo "<pre>";
// var_dump($arr_kpcond_new_kp);
// echo "<pre>";


$yesturday_date = date('Y-m-d', strtotime('yesterday'));
echo <<<HTML
<p class="center">Начало периода: $date_start | Конец периода : $date_end</p>
<h2 class="center">
<a href="reports.php?some_days=0">СЕГОДНЯ</a> |
<a href="reports.php?date_start=$yesturday_date&date_end=$yesturday_date">ВЧЕРА</a> |
<a href="reports.php?some_days=-7">НЕДЕЛЮ</a> |
<a href="reports.php?some_days=-30">МЕСЯЦ</a>
<h2 class="center">Статистика текущих работ</h2> 
<p>Количество нераспределенных <a href="index.php?typeQuery=552&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=">Заявок</a> : $not_obrabot_kp</p>
<div class="card-body">
  <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">Фамилия</th>
                  <th class="text-center">Новых заявок<br>поступило</th>
                  <th class="text-center">Новвых заявок<br>ожидает</th>
                  <th class="text-center">Взято заявок<br>в работе</th>
                  <th class="text-center">КП продано</th>
                  
                  <th class="text-center">Сумма продаж<br>за период</th>
                  <th class="text-center">Просроченные КП</th>
                  <th class="text-center">Закрытые КП</th>
              </tr>
          </thead>
          <tbody>
HTML;

for ($i=0; $i<count($arr_users_active); $i++) {

 $count_all_new_kp = $arr_all_new_kp[$i];
 $count_new_kp = $arr_kpcond_new_kp[$i];
 $user_name = $arr_users_active[$i]['user_name'];
 $kp_in_work = $arr_kpcond_in_work[$i];
 $count_buy = $arr_kpcond_buy[$i];
 $overdue_kp = $arr_overdue_kp[$i];
 $kp_summa = number_format($arr_kp_summa[$i], 0, ',', ' '); 

//  <td><a href="reports_show_table.php?typeQuery=1&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=">$count_all_new_kp</a></td>

 echo <<<HTML
  <tr class="text-center">
                  <td>$user_name</td>
                  <td ><a href="index.php?typeQuery=551&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=">$count_all_new_kp</a></td>
                  
                  
         
                  <td><a href="index.php?typeQuery=552&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0">$count_new_kp</a></td>
                  <td><a href="index.php?typeQuery=521&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=В работе&FinishContract=0">$kp_in_work</a></td>
                  <td><a href="index.php?typeQuery=553&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinishContract=1">$count_buy</a></td>
                  
                  <td class="text-end">$kp_summa</td>
                  <td><a href="index.php?typeQuery=554&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0">$overdue_kp</a></td>
                  <td><a href="#">###</a></td>
              </tr>
HTML;
}
$sum_all_new_kp = array_sum($arr_all_new_kp) + $not_obrabot_kp;
$sum_kpcond_new_kp = array_sum($arr_kpcond_new_kp);
$sum_kpcond_in_work = array_sum($arr_kpcond_in_work);
$sum_kpcond_buy = array_sum($arr_kpcond_buy);
$sum_overdue_kp = array_sum($arr_overdue_kp);

$sum_kp_summa = array_sum($arr_kp_summa);
$sum_kp_summa = number_format($sum_kp_summa,0, ',', ' ');
echo <<<HTML
<tr class="fs-4 text-center">
             
                <td>Итого</tdass=>
                <td><a href="index.php?typeQuery=555&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=">$sum_all_new_kp</a></td>
                <td><a href="index.php?typeQuery=556&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0">$sum_kpcond_new_kp</a></td>
                <td><a href="index.php?typeQuery=557&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=В работе&FinishContract=0">$sum_kpcond_in_work</a></td>
                <td><a href="index.php?typeQuery=558&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinishContract=1">$sum_kpcond_buy</a></td>
               
                <td class="text-end">$sum_kp_summa</td>

                <td><a href="index.php?typeQuery=559&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0">$sum_overdue_kp</a></td>
                <td><a href="#">###</a></td>
              
            </tr>
HTML;
echo <<<HTML
          </tbody>                                
</table>


<h2 class="center">Таблица изменений</h2>
HTML;
// ********************************* ТАБЛИЦА ИЗМЕНЕНИЙ ЗА ПЕРИОД
$sql_plus =""; // формируем пустую строку для SQL запроса

if ((isset($date_start) or (isset($date_end)))) {
    if (($date_start <> "") and ($date_end == "")) { 
      $sql_plus = " AND date_change >= '$date_start'  ORDER BY date_change DESC";
    }  elseif (($date_start == "") and ($date_end <> "")) {
      $sql_plus = " AND date_change <= '$date_end'  ORDER BY date_change DESC";
    } else {
      $sql_plus = " AND (date_change >= '$date_start' AND date_change <= '$date_end')  ORDER BY date_change DESC";
    }
}

$sum_all_changes = 0;
$sql = "SELECT * FROM `reports` WHERE `id`<>''  $sql_plus";
// echo "<br>***".$sql."<br>";
$query = $mysqli->query($sql);
// && ($arr_info_user[$j]["FinishContract"] <>1
$arr_items_changes = MakeArrayFromReportsData($query);

if (isset($arr_items_changes[0]["id"])) {$sum_all_changes = count($arr_items_changes);}
// echo "<pre>";
// var_dump($arr_items_changes);
// echo "<pre>";

echo <<<HTML

<table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th>Фамилия</th>
                  <th>кол-во изменений</th>

              </tr>
          </thead>
          <tbody>
HTML;


$sql= "SELECT * FROM `users`";
$query = $mysqli->query($sql);
$arr_users = MakeArrayFromObjUsers($query);

$i=0;
$arr_users_items_changes[]="";
foreach ($arr_users as $value){
  $kolvo_change=0;
    foreach ($arr_items_changes as $key => $value1 ){
          // var_dump ($value);
        if ($value["user_login"] == $value1["author"]) {
          $author =$value1["author"];
          $arr_users_items_changes[$author][$i] = $value1;
          $kolvo_change = count($arr_users_items_changes[$author]);
          $i++;
          // echo $value1["author"]. "<br>";
        }
   }
$user_name=$value["user_name"];
$user_login=$value["user_login"];
// reports_show_changes.php
 echo <<<HTML
  <tr>
                  <td>$user_name($user_login)</td>
                  <td><a href="reports_show_changes.php?typeQuery=1&user_login=$user_login&date_start=$date_start&date_end=$date_end">$kolvo_change</a></td>
        
              </tr>
HTML;
}

echo <<<HTML
<tr class="fs-4">
             
                <td >Итого</td>
                <td><a href="reports_show_changes.php?typeQuery=2&date_start=$date_start&date_end=$date_end">$sum_all_changes</a></td>
 
              
            </tr>
HTML;


// echo "<pre>";
// var_dump($arr_users_items_changes["guts"]);
// echo "<pre>";


echo <<<HTML
          </tbody>                                
</table>



   </div>
</div>


HTML;


?>