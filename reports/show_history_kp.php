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


// выбираем все изменения по выбранному КП
if ($typeQuery == 5) {
  $sql = "SELECT * FROM `reports` WHERE `id_item` = '$id_kp' ORDER BY `time_change` DESC";
}

$query = $mysqli->query($sql);
$arr_user_reports = MakeArrayFromReportsData($query);
//   echo "<pre>";
// var_dump($arr_user_reports);
//   echo "<pre>";


echo <<<HTML

<h2 class="center">История КП</h2> 
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

if (isset($user_name)) {
echo <<<HTML
     <tr>
          <td width="20">$i</td>
          <td>$user_name</td>
          <td width="180" class="text-center">$time_change</td>
          <td width="240" class="text-center"><a href="$get_link">$link</a></td>
          <td>$comment_change</td>


HTML;
} else {

  echo "<h2>История отсутствует</h2>";
}
// eсли нет суммы КП то выводим пустую ячейку
if (isset($kp_summa)) 
{
  echo "<td class =\"text-center\"><b>$kp_summa</b></td>";
} else {
  echo "<td></td>";
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
<h3 class="center"><a href="index.php?id=$id_kp">перейти к КП</a></h3> 
HTML;
