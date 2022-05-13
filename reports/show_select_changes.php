<?php
date_default_timezone_set('Europe/Moscow');

$sql = "SELECT * FROM `users`";
$query = $mysqli->query($sql);
$arr_users = MakeArrayFromObjUsers($query);

if (isset($_GET["typeQuery"])) {
  $typeQuery = $_GET['typeQuery'];
} else {
  $typeQuery = "";
}
if (isset($_GET["id_kp"])) {
  $id_kp = $_GET['id_kp'];
} else {
  $id_kp = "";
}
if (isset($_GET["whatChange"])) {
  $whatChange = $_GET['whatChange'];
} else {
  $whatChange = "";
}

if (isset($_GET["user_login"])) {
  $user_login = $_GET['user_login'];
} else {
  $user_login = "";
}
if (isset($_GET["date_start"])) {
  $date_start = $_GET['date_start'];
} else {
  $date_start = "";
}

if (isset($_GET["date_end"])) {
  $date_end = $_GET['date_end'];
} else {
  $date_end = "";
}

$date_now = date('Y-m-d');
// выбираем все изменения по выбранному пользователю
if ($typeQuery == 1) {
  $sql = "SELECT * FROM `reports` WHERE `author` = '$user_login' AND `date_change` >= '$date_start' AND
  `date_change` <= '$date_end' ORDER BY `time_change` ASC";
}
// выбираем все изменения 
if ($typeQuery == 2) {
  $sql = "SELECT * FROM `reports` WHERE `date_change` >= '$date_start' AND
  `date_change` <= '$date_end' ORDER BY `time_change` ASC";
}
// выбираем все изменения по выбранному пользователю, где были изменения в КП / отправленные ЕМАЙЛы
if ($typeQuery == 3) {
  $sql = "SELECT * FROM `reports` WHERE `author` = '$user_login' AND `what_change`='$whatChange'  AND `date_change` >= '$date_start' AND `date_change` <= '$date_end' ORDER BY `time_change` ASC";
}
// выбираем все изменения по выбранному пользователю, где были изменения по данным компании
if ($typeQuery == 4) {
  $sql = "SELECT * FROM `reports` WHERE `author` = '$user_login' AND 
  (`what_change`='2' OR `what_change`='3' OR `what_change`='4' OR `what_change`='5' OR `what_change`='6')  
  AND `date_change` >= '$date_start' AND
  `date_change` <= '$date_end' ORDER BY `time_change` ASC";
}
// выбираем все изменения по выбранному КП
if ($typeQuery == 5) {
  $sql = "SELECT * FROM `reports` WHERE `id_item` = '$id_kp' ORDER BY `time_change` DESC";
}

$query = $mysqli->query($sql);
$arr_user_reports = MakeArrayFromReportsData($query);
//   echo "<pre>";
// var_dump($arr_user_reports);
//   echo "<pre>";

require_once("change_date_format.php");


echo <<<HTML
 <p class="center">Начало периода: <u>$date_start1</u> | Конец периода : <u>$date_end1</u></p>
<h2 class="center">
<h2 class="center">Статистика текущих работ</h2> 
<div class="card-body">
  <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr class="text-center" >
                  <th>пп</th>    
                  <th>Фамилия</th>
                  <th>Дата изменения</th>
                  <th>Ссылка на изменения</th>
                  <th>Изменения</th>
                  <th>Сумма КП</th>
                  <th>История КП</th>

              </tr>
          </thead>
          <tbody>
HTML;
$i = 0;
foreach ($arr_user_reports as $value) {
  $i++;


  $what_change = $value["what_change"];
  $date_change = $value["date_change"];
  $time_change = $value["time_change"];
  $comment_change = $value["comment_change"];

  $comment_change  = str_replace( "@!", "<br>" , $comment_change);
  $comment_change  = str_replace( "||+", ";" , $comment_change);



  $id_item = $value["id_item"];
  $author = $value["author"];
  
  // Подбираем пользователя
  foreach ($arr_users as $user) {
    if ($author == $user["user_login"]) {
      $user_name = $user["user_name"];
    }
  }
  //  смотрим тип изменения 
  // Меняем данные в КП
  $cor_kp=0;
  if ($what_change == 1) {
    $sql = "SELECT * from `reestrkp` WHERE id = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_kp_num = MakeArrayFromObj($query);
    $id_kp = $arr_for_kp_num[0]["id"];
    $kp_num = $arr_for_kp_num[0]["KpNumber"];
    $kp_date = $arr_for_kp_num[0]["KpData"];
    $link = $kp_num . " от " . $kp_date;
    $kp_summa =$TenderSum = number_format($arr_for_kp_num[0]["KpSum"]);
    $get_link = "index.php?id=$id_item";
    $cor_kp=1;

// Меняем данные к компании из КП
  } elseif ($what_change == 2) {
    $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObjINN($query);
    $link = $arr_for_inn[0]["inn"];
    $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
    $query = $mysqli->query($sql);
    // echo "<br> ---- ".$sql."<br> ---- ";
    $arr_for_inn = MakeArrayFromObj($query);
    $id_inn_comp = $arr_for_inn[0]["id"];
    // echo "<br> ---- ".$id_inn_comp."<br> ---- ";
    $get_link = "index.php?id=$id_inn_comp";
    $link = "ИНН:" . $link;
    // $name_comp = $arr_for_inn[0]["name"];
// добавляем телефон
  } elseif ($what_change == 3) {
    $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObjINN($query);
    $link = $arr_for_inn[0]["inn"];
    $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObj($query);
    $id_inn_comp = $arr_for_inn[0]["id"];
    $get_link = "index.php?id=$id_inn_comp";
    $link = "Изм. телеф. ИНН:" . $link;
// Изменяем телефон
  } elseif ($what_change == 4) {
    $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObjINN($query);
    $link = $arr_for_inn[0]["inn"];
    $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObj($query);
    $id_inn_comp = $arr_for_inn[0]["id"];
    $get_link = "index.php?id=$id_inn_comp";
    $link = "Нов. телеф. ИНН:" . $link;
// Дбоавляем ЕМАЙЛ
  } elseif ($what_change == 5) {
    $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObjINN($query);
    $link = $arr_for_inn[0]["inn"];
    $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObj($query);
    $id_inn_comp = $arr_for_inn[0]["id"];
    $get_link = "index.php?id=$id_inn_comp";
    $link = "Изм. почты ИНН:" . $link;
// Изменяем ЕМАЙЛ
  } elseif ($what_change == 6) {
    $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObjINN($query);
    $link = $arr_for_inn[0]["inn"];
    $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
    $query = $mysqli->query($sql);
    $arr_for_inn = MakeArrayFromObj($query);
    $id_inn_comp = $arr_for_inn[0]["id"];
    $get_link = "index.php?id=$id_inn_comp";
    $link = "Нов. почта ИНН:" . $link;
  }
// ОТправляем ЕМАЙЛ с формы сайта
  if ($what_change == 7) {
    $sql = "SELECT * from `reestrkp` WHERE id = $id_item";
    $query = $mysqli->query($sql);
    $arr_for_kp_num = MakeArrayFromObj($query);
    $kp_num = $arr_for_kp_num[0]["KpNumber"];
    $kp_date = $arr_for_kp_num[0]["KpData"];
    $link = $kp_num . " от " . $kp_date . "( E-MAIL)";
    $get_link = "index.php?id=$id_item";
    $kp_summa =$TenderSum = number_format($arr_for_kp_num[0]["KpSum"]);
  }

  echo <<<HTML
     <tr>
          <td width="20">$i</td>
          <td>$user_name</td>
          <td width="180" class="text-center">$time_change</td>
          <td width="240" class="text-center"><a href="$get_link">$link</a></td>
          <td>$comment_change</td>


HTML;
// eсли нет суммы КП то выводим пустую ячейку
if (isset($kp_summa)) 
{
  echo "<td class =\"text-center\"><b>$kp_summa</b></td>";
} else {
  echo "<td></td>";
}

if ($cor_kp==1) {
 echo  "<td class=\"text-center\"><a href=\"reports_show_changes.php?typeQuery=5&id_kp=$id_kp\">$kp_num</a></td>";
}else {
  echo  "<td></td>";
}


echo <<<HTML
          
     </tr>
HTML;
}
echo <<<HTML

  
              </tbody>                                
</table>
</div>
</div>
HTML;
