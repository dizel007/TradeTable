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


// Получаем количество нераспределенных Заявок за все время 
$sql="SELECT * FROM `reestrkp` WHERE `Responsible`='' AND `FinishContract`= 0";
$query = $mysqli->query($sql);
$arr_info_user = MakeArrayFromObj($query);
$not_obrabot_kp_all=0;
if (isset($arr_info_user[0]["Responsible"])) {$not_obrabot_kp_all = count($arr_info_user);}


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
  $count_all_not_work=0;
  $count_all_work=0;
  $count_buy=0;
  $kp_summa=0;
  $kp_close=0;
  $overdue_kp=0;
  $count_close_kp=0;
  $count_all_close_kp=0;
  $count_all_work_neutral=0;
  $count_all_work_important=0;  
  $count_all_work_very_important=0;  
//   echo "<pre>";
// var_dump($arr_info_user);
// echo "<pre>";
  for ($j=0; $j<count($arr_info_user); $j++) {
// кол-во новых КП 
    if ((isset($arr_info_user[0]["KpCondition"])) && ($arr_info_user[$j]["KpCondition"] == "") && ($arr_info_user[$j]["FinishContract"] <>1 ))  {$count_new_kp++;} 





// количество взятых в работы  
    if (($arr_info_user[$j]["KpCondition"] == "В работе" ) && ($arr_info_user[$j]["FinishContract"] <>1 )) {$count_work++;} 
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
    // кол-во невзятых в работу КП за все время 
    if (($arr_info_user_for_sell[$j]["Responsible"] ==$user_name)&& ($arr_info_user_for_sell[$j]["KpCondition"] <> "В работе") && ($arr_info_user_for_sell[$j]["FinishContract"] == 0) )  {$count_all_not_work++;} 
  // Ищем Все КП которые Продали  **********************
     if (($arr_info_user_for_sell[$j]["KpCondition"] == "Купили у нас")  && 
          ( $date_end >= $arr_info_user_for_sell[$j]["date_sell"] )  &&
          ( $date_start <= $arr_info_user_for_sell[$j]["date_sell"] ))
              {
                  $count_buy++;
                  $kp_summa = $kp_summa + $arr_info_user_for_sell[$j]["KpSum"];
              }

  // Ищем Все КП которые закрыты за опредеоенный период  **********************
  if (($arr_info_user_for_sell[$j]["FinishContract"] == 1)  && 
  ($arr_info_user_for_sell[$j]["KpCondition"] <> "Купили у нас") &&
  ( $date_end >= $arr_info_user_for_sell[$j]["date_close"] )  &&
  ( $date_start <= $arr_info_user_for_sell[$j]["date_close"] ))
      { $count_close_kp++;}
  // Ищем Все КП которые закрыты за все время  **********************
  if (($arr_info_user_for_sell[$j]["FinishContract"] == 1)  && 
  ($arr_info_user_for_sell[$j]["KpCondition"] <> "Купили у нас"))
      { $count_all_close_kp++;}

      
// Ищем Все КП которые в Работе**********************
      if (($arr_info_user_for_sell[$j]["KpCondition"] == "В работе")  && ($arr_info_user_for_sell[$j]["FinishContract"] == 0 ))
          {
            $count_all_work++; // количество взятых в работу
 // Если в работе и статус Кп "НЕЙТРАЛЬН"
            if ($arr_info_user_for_sell[$j]["KpImportance"] == "Нейтрально") {$count_all_work_neutral++;}
            if ($arr_info_user_for_sell[$j]["KpImportance"] == "") {$count_all_work_neutral++;}
 // Если в работе и статус Кп "ВАЖНО"
            if ($arr_info_user_for_sell[$j]["KpImportance"] == "Важно") {$count_all_work_important++;}
// Если в работе и статус Кп "VERY ВАЖНО"
            if ($arr_info_user_for_sell[$j]["KpImportance"] == "Очень важно") {$count_all_work_very_important++;}
              
          }
 // Ищем Все КП которые Просрoчены**********************         
      if (($arr_info_user_for_sell[$j]["DateNextCall"] < $date_now) && ($arr_info_user_for_sell[$j]["DateNextCall"] <>'0000-00-00') && ($arr_info_user_for_sell[$j]["FinishContract"] <>1)  ) 
      { 
        $overdue_kp++;
      }
  }
  $arr_kpcond_buy[$i] = $count_buy;  // массив с данными по КП которые проланы
  $arr_kp_summa[$i] = $kp_summa; // сумма продаж за период
  $arr_kp_not_work[$i] = $count_all_not_work;
  $arr_kp_work[$i] = $count_all_work;  // массив с данными по КП которые в работе
  $arr_kp_work_neutral[$i] = $count_all_work_neutral;  // массив с данными по КП которые в работе НЕЙТРАЛЬН
  $arr_kp_work_important[$i] = $count_all_work_important;  // массив с данными по КП которые в работе ВАЖНО
  $arr_kp_work_very_important[$i] = $count_all_work_very_important;  // массив с данными по КП которые в работе ОЧЕНЬ ВАЖНО
  $arr_kp_close_period[$i] = $count_close_kp; // // массив с данными по КП которые закрыты
  $arr_all_kp_close_period[$i] = $count_all_close_kp; // // массив с данными по КП которые закрыты за весь период
  if (isset($arr_info_user_for_sell[0]["KpCondition"])) {$arr_overdue_kp[$i] = $overdue_kp;}
  else  {$arr_overdue_kp[$i] = 0;}// полное количество поступивших Заявок
  ;  // массив с данными по КП которые в работе
 // ******************************************************* ПРОДАЖИ КОНЕЦ **************************

}
// echo "<pre>";
// var_dump($arr_kpcond_new_kp);
// echo "<pre>";


$yesturday_date = date('Y-m-d', strtotime('yesterday'));
require_once ("change_date_format.php");

echo <<<HTML
<p class="text-center date_label">Начало периода: <u>$date_start1</u> | Конец периода : <u>$date_end1</u></p>

<div class="center">
    <a class="btn btn-outline-primary btn-sm m-1" href="reports.php?some_days=0">СЕГОДНЯ</a> 
    <a class="btn btn-outline-primary btn-sm m-1" href="reports.php?date_start=$yesturday_date&date_end=$yesturday_date">ВЧЕРА</a> 
    <a class="btn btn-outline-primary btn-sm m-1"  href="reports.php?some_days=-7">НЕДЕЛЮ</a>
    <a class="btn btn-outline-primary btn-sm m-1"  href="reports.php?some_days=-30">МЕСЯЦ</a>
    <div class="center">Статистика текущих работ</div> 
</div>



<div class="ms-3">
<a class="btn btn-outline-danger btn-sm " href="index.php?typeQuery=568&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0">Неразобранные КП : <b>$not_obrabot_kp_all</b> за все время </a>
</div>
<br>
<div class="ms-3">
<a class="btn btn-outline-warning btn-sm" href="index.php?typeQuery=552&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=">Неразобранные КП : <b>$not_obrabot_kp</b> за выбранный период </a>
</div>
<div class="card-body">
  <div class="table-responsive">

  <!-- *************************Y START  N******************************************************** -->

  <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
                  <th class="text-center">Фамилия</th>
                  <th class="text-center">Новых КП<br>назначено</th>
                  <th class="text-center">Новых КП<br>ожидает</th>
                  <th class="text-center">КП "НЕ в работе"<br>всего</th>
                  <th class="text-center">КП "в работе"<br>за период</th>
                  <th class="text-center">КП "в работе"<br>всего</th>
                  <th class="text-center">КП проданы<br>за период</th>
                  <th class="text-center">Сумма продаж<br>за период</th>
                  <th class="text-center">Просроченные КП<br>за период</th>
                  <th class="text-center">Закрытые КП<br>за период</th>
                  <th class="text-center">Закрытые КП<br>всего</th>
              </tr>
          </thead>
          <tbody>
HTML;

for ($i=0; $i<count($arr_users_active); $i++) {

 $count_all_new_kp = $arr_all_new_kp[$i];
 $count_new_kp = $arr_kpcond_new_kp[$i];
 $count_all_not_work = $arr_kp_not_work[$i]; 
 $user_name = $arr_users_active[$i]['user_name'];
 $kp_in_work = $arr_kpcond_in_work[$i];
 $count_buy = $arr_kpcond_buy[$i];
 $overdue_kp = $arr_overdue_kp[$i];
 $kp_summa = number_format($arr_kp_summa[$i], 0, ',', ' '); 
 $count_all_work = $arr_kp_work[$i];
 $count_close_kp = $arr_kp_close_period[$i];
 $count_all_close_kp_ = $arr_all_kp_close_period[$i];
 $count_all_work_neutral = $arr_kp_work_neutral[$i];
 $count_all_work_important = $arr_kp_work_important[$i];
 $count_all_work_very_important = $arr_kp_work_very_important[$i];
 // сумммы
$sum_all_new_kp = array_sum($arr_all_new_kp) + $not_obrabot_kp;
$sum_kpcond_new_kp = array_sum($arr_kpcond_new_kp);
$sum_kp_not_work = array_sum($arr_kp_not_work);
$sum_kpcond_in_work = array_sum($arr_kpcond_in_work);
$sum_kpcond_all_in_work = array_sum($arr_kp_work);
$sum_kpcond_buy = array_sum($arr_kpcond_buy);
$sum_overdue_kp = array_sum($arr_overdue_kp);
$sum_close_period_kp = array_sum($arr_kp_close_period);
$count_all_close_kp = array_sum($arr_all_kp_close_period);
$sum_kp_summa = array_sum($arr_kp_summa);
$sum_kp_summa = number_format($sum_kp_summa,0, ',', ' ');
 echo <<<HTML
  <tr class="text-center">
                  <td>$user_name</td>
                  <td >
<!-- всего новых КП за период получил -->
                    <a class="btn btn-outline-primary btn-sm" href="index.php?typeQuery=551&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=">$count_all_new_kp</a>
                    <!-- <a class="link_all_td" href="index.php?typeQuery=551&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=">$count_all_new_kp</a> -->
                  </td>
                  <td >
 <!-- КП за период которые нужно взять в работу -->
                    <a class="btn btn-outline-primary btn-sm" href="index.php?typeQuery=552&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=&FinContr=0">$count_new_kp</a>
                  </td>
                  <td >
 <!-- ******************************************************************** -->
  <!-- КП за все время которые нужно взять в работу -->
                    <a class="btn btn-primary btn-sm" href="index.php?typeQuery=569&Responsible=$user_name&date_start=&date_end=&KpCondition=В работе&FinContr=0">$count_all_not_work</a>
                  </td>
  <!-- ******************************************************************** -->
                  <td>
<!-- КП за период, которые были взяты в работу -->
                    <a class="btn btn-outline-primary btn-sm" href="index.php?typeQuery=552&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=В работе&FinContr=0">$kp_in_work</a>
                  </td>
                  <td class="">
<!-- КП за все время, которые были взяты в работу -->                    
                    <a class ="btn btn-success btn-sm" href="index.php?typeQuery=560&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=В работе& FinContr=0">$count_all_work</a>
                    &nbsp
                    <!-- НЕЙТРАЛЬНО -->
                    <a class ="btn btn-outline-primary btn-sm" href="index.php?typeQuery=567&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=В работе&KpImportance=Нейтрально&FinContr=0">
                       $count_all_work_neutral
                    </a>
                    &nbsp
                    <!-- ВАЖНО -->
                    <a class ="btn btn-outline-warning btn-sm" href="index.php?typeQuery=566&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=В работе&KpImportance=Важно&FinContr=0">
                       $count_all_work_important
                    </a>
                    &nbsp
                    <!-- ОЧЕНЬ ВАЖНО -->
                    <a class ="btn btn-outline-danger btn-sm" href="index.php?typeQuery=566&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=В работе&KpImportance=Очень важно&FinContr=0">
                       $count_all_work_very_important
                    </a>

                  </td>
                  <td>
  <!-- КП за период, которые КУПИЛИ У НАС --> 
                    <a class="btn btn-outline-primary btn-sm" href="index.php?typeQuery=553&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinContr=1">$count_buy</a></td>
  <!--Сумма КП за период, которые КУПИЛИ У НАС --> 
                  <td class="text-end">$kp_summa</td>
                  <td>
  <!-- КП за все время, которые ПРосроченные -->                    
                    <a class="btn btn-outline-danger btn-sm" href="index.php?typeQuery=554&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=&FinContr=0">$overdue_kp</a>
                  </td>
                  <td>
 <!-- КП за период, которые были Закрыты, кроме которых КУПИЛИ У НАС -->   
                    <a class="btn btn-outline-secondary btn-sm" href="index.php?typeQuery=562&Responsible=$user_name&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinContr=1">$count_close_kp</a>
                    </td>
                    <td>
 <!-- КП за все время, которые были Закрыты, кроме которых КУПИЛИ У НАС -->  
                    <a class="btn btn-outline-secondary btn-sm" href="index.php?typeQuery=564&Responsible=$user_name&KpCondition=Купили у нас&FinContr=1">$count_all_close_kp_</a>
                    
                  </td>
              </tr>
HTML;
}



echo <<<HTML
<tr class="fs-4 text-center">
             
                <td>Итого</td>
                <td>
                  <a class="btn btn-outline-primary" href="index.php?typeQuery=555&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract="><b>$sum_all_new_kp</b></a>
                  </td>
                  <td>
                  <a class="btn btn-outline-primary" href="index.php?typeQuery=556&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0"><b>$sum_kpcond_new_kp</b></a>    
                 </td>
<!--  ***КП НЕ В РАБОТЕ ЗА ВСЕ ВРЕМЯ **********************************************-->
                <td>
                  <a class="btn btn-primary" href="index.php?typeQuery=570&Responsible=&date_start=&date_end=&KpCondition=В работе&FinishContract=0"><b>$sum_kp_not_work</b></a>    
                 </td>
<!--  *************************************************-->
                <td>
                  <a class="btn btn-outline-primary" href="index.php?typeQuery=557&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=В работе&FinishContract=0">
                    <b>$sum_kpcond_in_work</b></a>
                </td>
                <td>
                  <a class="btn btn-outline-primary" href="index.php?typeQuery=561&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=В работе&FinishContract=0">
                    <b>$sum_kpcond_all_in_work</b></a>
                 
                </td>
                <td><a class="btn btn-outline-primary" href="index.php?typeQuery=558&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinishContract=1">
                  <b>$sum_kpcond_buy</b></a></td>
               
                <td class="text-end"><b>$sum_kp_summa</b></td>

                <td><a class="btn btn-outline-danger" href="index.php?typeQuery=559&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=&FinishContract=0">
                  <b>$sum_overdue_kp</b></a></td>
                <td>
                  <a class="btn btn-outline-secondary"href="index.php?typeQuery=563&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinContr=1">
                    <b>$sum_close_period_kp</b></a>
                </td>
                <td>
                  <a class="btn btn-outline-secondary" href="index.php?typeQuery=565&Responsible=&date_start=$date_start&date_end=$date_end&KpCondition=Купили у нас&FinishContract=1">
                    <b>$count_all_close_kp</b></a>
                </td>
              
            </tr>
HTML;
echo <<<HTML
          </tbody>                                
</table>






  <!-- ********************************************************************************** -->



<h2 class="center">Таблица изменений</h2>
HTML;


// ********************************* ТАБЛИЦА ИЗМЕНЕНИЙ ЗА ПЕРИОД


$sql_plus =""; // формируем пустую строку для SQL запроса


if ((isset($date_start) or (isset($date_end)))) {
    if (($date_start <> "") and ($date_end == "")) { 
      $sql_plus = " AND date_change >= '$date_start'  ORDER BY time_change DESC";
    }  elseif (($date_start == "") and ($date_end <> "")) {
      $sql_plus = " AND date_change <= '$date_end'  ORDER BY time_change DESC";
    } else {
      $sql_plus = " AND (date_change >= '$date_start' AND date_change <= '$date_end')  ORDER BY time_change DESC";
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
                  <th>изменений в КП</th>
                  <th>отправленных email</th>
                  <th>изменений в данных о компании</th>
                  <th>всего изменений</th>
                  <th>КП с изменениями</th>
              </tr>
          </thead>
          <tbody>
HTML;


$sql= "SELECT * FROM `users`";
$query = $mysqli->query($sql);
$arr_users = MakeArrayFromObjUsers($query);

$i=0;
$j=0;

$arr_users_items_changes[]="";
$arr_users_id_kp[]="";

foreach ($arr_users as $value){
  $j1=0;
  $kolvo_change=0;
  $kolvo_kp_change = 0;
  $kolvo_send_emails = 0;
  $kolvo_change_about_company=0;
  $kp_with_change =0;  // КП в которых были изменения за период
  $arr_users_id_kp = null;
  $author="";

    // перебираем все изменения и при совпадении пользователя формируем массив изменений по пользователю
    foreach ($arr_items_changes as $key => $value1 ){
    
         if ($value["user_login"] == $value1["author"]) {
          $author =$value1["author"];
          
          //ищем только изменения в КП и делаем массив этих изменений
          if ($value1['what_change'] == 1) {
              $arr_user_change_kp[$author][$j] = $value1;
              $kolvo_kp_change = count($arr_user_change_kp[$author]);
         // будем формировать массив с id по всем КП (только уникальные значения)
             $arr_users_id_kp[$author][$j] = $value1['id_item'];
              $j++;
           }
          //ищем количество отправленных писем
          if ($value1['what_change'] == 7) {
            $arr_user_send_email[$author][$j] = $value1;
            $kolvo_send_emails = count($arr_user_send_email[$author]);
            $j++;
         }
          //ищем количество изменений в данных о компании
          if (($value1['what_change'] == 3) OR ($value1['what_change'] == 2) OR 
              ($value1['what_change'] == 5) OR ($value1['what_change'] == 4) OR
              ($value1['what_change'] == 6)) {
          $arr_change_about_company[$author][$j] = $value1;
          $kolvo_change_about_company = count($arr_change_about_company[$author]);
          $j++;
        }

          
          $arr_users_items_changes[$author][$i] = $value1;
          $kolvo_change = count($arr_users_items_changes[$author]);
          $i++;
        
        }
      
   }

$user_name=$value["user_name"];
$user_login=$value["user_login"];
$whatChange=$value1['what_change'];
    // echo "<pre>";
    // var_dump($arr_users_id_kp);
    // echo "<pre>";
if ($arr_users_id_kp[$author]>0) {
  // оставляем только уникальные значения id
$arr_users_id_kp[$author] = array_unique($arr_users_id_kp[$author], SORT_REGULAR);
$kp_with_change = count($arr_users_id_kp[$author]);


$get_string_changeKp=(string)(implode(";", $arr_users_id_kp[$author]));
}
// reports_show_changes.php

 if ($kolvo_change>0) { //показываем только тех, кто делал изменения
 echo <<<HTML
          <tr>
              <td>$user_name($user_login)</td>
HTML;             

if ($kolvo_kp_change>0) {
echo <<<HTML
<!--количество изменений в КП -->
             <td><a class="btn btn-outline-primary btn-sm" href="reports_show_changes.php?typeQuery=3&whatChange=1&user_login=$user_login&date_start=$date_start&date_end=$date_end">$kolvo_kp_change</a></td>
HTML;
} else {
  echo <<<HTML
  <td><i class="btn btn-outline-primary btn-sm">$kolvo_kp_change</i></td>
  HTML;
}

if ($kolvo_send_emails>0) {
echo <<<HTML
              <!--количество отправленных email -->
              <td><a class="btn btn-outline-primary btn-sm" href="reports_show_changes.php?typeQuery=3&whatChange=7&user_login=$user_login&date_start=$date_start&date_end=$date_end">$kolvo_send_emails</a></td>
  HTML;
  } else {
    echo <<<HTML
    <td><i class="btn btn-outline-primary btn-sm">$kolvo_send_emails</i></td>
    HTML;
  }

  if ($kolvo_change_about_company>0) {
    echo <<<HTML
                <!--количество изменений данных о компании -->
                  <td><a class="btn btn-outline-primary btn-sm" href="reports_show_changes.php?typeQuery=4&user_login=$user_login&date_start=$date_start&date_end=$date_end"> $kolvo_change_about_company</a></td>
      HTML;
      } else {
        echo <<<HTML
        <td><i class="btn btn-outline-primary btn-sm">$kolvo_change_about_company</i></td>
        HTML;
      }


echo <<<HTML
<!-- общее количество изменений-->
<td><a class="btn btn-outline-primary btn-sm" href="reports_show_changes.php?typeQuery=1&user_login=$user_login&date_start=$date_start&date_end=$date_end">$kolvo_change</a></td>
           
HTML;

echo <<<HTML
<!-- выаодим КП в которых были изменения-->
<td><a class="btn btn-outline-primary btn-sm" href="index.php?typeQuery=602&author=$author&idKP=$get_string_changeKp">$kp_with_change</a></td>
           </tr>
HTML;

 }
}

echo <<<HTML
<tr class="fs-4">
             
                <td >Итого</td>
                <td ></td>
                <td ></td>
                <td ></td>
                <td><a class="btn btn-outline-primary"href="reports_show_changes.php?typeQuery=2&date_start=$date_start&date_end=$date_end"><b>$sum_all_changes</b></a></td>
 
              
            </tr>
HTML;

echo <<<HTML
     </tbody>                                
</table>

   </div>
</div>
HTML;
?>