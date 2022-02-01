<?php
$sql= "SELECT * FROM `users`";
$query = $mysqli->query($sql);
$arr_users = MakeArrayFromObjUsers($query);

  if (isset($_GET["typeQuery"])) {
    $typeQuery= $_GET['typeQuery'];
   } else {
    $typeQuery= "";
  }

if (isset($_GET["user_login"])) {
    $user_login= $_GET['user_login'];
   } else {
    $user_login= "";
  }
  if (isset($_GET["date_start"])) {
    $date_start= $_GET['date_start'];
  } else {
    $date_start= "";
  }

  if (isset($_GET["date_end"])) {
    $date_end= $_GET['date_end'];
  } else {
    $date_end= "";
  }

$date_now=date('Y-m-d');

if ($typeQuery == 1) {
  $sql = "SELECT * FROM `reports` WHERE `author` = '$user_login' AND `date_change` >= '$date_start' AND
  `date_change` <= '$date_end' ORDER BY `date_change`";
}
if ($typeQuery == 2) {
  $sql = "SELECT * FROM `reports` WHERE `date_change` >= '$date_start' AND
  `date_change` <= '$date_end' ORDER BY `date_change`";
}
$query= $mysqli->query($sql);
$arr_user_reports = MakeArrayFromReportsData($query);
//   echo "<pre>";
// var_dump($arr_user_reports);
//   echo "<pre>";





echo <<<HTML
  <p class="center">Начало периода: $date_start | Конец периода : $date_end</p>
<h2 class="center">
<h2 class="center">Статистика текущих работ</h2> 
<div class="card-body">
  <div class="table-responsive">
      <table class="table table-striped table-bordered" id="dataTable" width="100%" cellspacing="0">
          <thead>
              <tr>
              <th>пп</th>    
              <th>Фамилия</th>
                  <th>Дата изменения</th>
                  <th>Ссылка на изменения</th>
                  <th>Изменения</th>

              </tr>
          </thead>
          <tbody>
HTML;      
$i=0;      
foreach ($arr_user_reports as $value) {
  $i++;


    $what_change = $value["what_change"];
    $date_change = $value["date_change"];
    $comment_change = $value["comment_change"];
    $id_item = $value["id_item"];
    $author = $value["author"]; 
    // Подбираем пользователя
  foreach ($arr_users as $user) {
    if ($author == $user["user_login"]) {$user_name = $user["user_name"];}
  }
//  смотрим тип изменения 
if ($what_change == 1) {
$sql = "SELECT * from `reestrkp` WHERE id = $id_item";
$query= $mysqli->query($sql);
$arr_for_kp_num = MakeArrayFromObj($query);
$kp_num = $arr_for_kp_num[0]["KpNumber"];
$kp_date = $arr_for_kp_num[0]["KpData"];
$link = $kp_num." от ".$kp_date;
$get_link = "index.php?id=$id_item";
}
elseif ($what_change == 2){
  $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObjINN($query);
  $link = $arr_for_inn[0]["inn"];
  $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
  $query= $mysqli->query($sql);
  // echo "<br> ---- ".$sql."<br> ---- ";
  $arr_for_inn = MakeArrayFromObj($query);
  $id_inn_comp = $arr_for_inn[0]["id"];
  // echo "<br> ---- ".$id_inn_comp."<br> ---- ";
  $get_link = "index.php?id=$id_inn_comp";
  $link = "ИНН:".$link;
  // $name_comp = $arr_for_inn[0]["name"];
}
elseif ($what_change == 3){
  $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObjINN($query);
  $link = $arr_for_inn[0]["inn"];
  $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObj($query);
  $id_inn_comp = $arr_for_inn[0]["id"];
  $get_link = "index.php?id=$id_inn_comp";
  $link = "Изм. телеф. ИНН:".$link;
}
elseif ($what_change == 4){
  $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObjINN($query);
  $link = $arr_for_inn[0]["inn"];
  $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObj($query);
  $id_inn_comp = $arr_for_inn[0]["id"];
   $get_link = "index.php?id=$id_inn_comp";
  $link = "Нов. телеф. ИНН:".$link;
}
elseif ($what_change == 5){
  $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObjINN($query);
  $link = $arr_for_inn[0]["inn"];
  $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObj($query);
  $id_inn_comp = $arr_for_inn[0]["id"];
   $get_link = "index.php?id=$id_inn_comp";
  $link = "Изм. почты ИНН:".$link;
}
elseif ($what_change == 6){
  $sql = "SELECT * from `inncompany` WHERE inn = $id_item";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObjINN($query);
  $link = $arr_for_inn[0]["inn"];
  $sql = "SELECT * from `reestrkp` WHERE InnCustomer = $link LIMIT 1";
  $query= $mysqli->query($sql);
  $arr_for_inn = MakeArrayFromObj($query);
  $id_inn_comp = $arr_for_inn[0]["id"];
   $get_link = "index.php?id=$id_inn_comp";
  $link = "Нов. почта ИНН:".$link;
}
echo <<<HTML
     <tr>
          <td>$i</td>
          <td>$user_name</td>
          <td>$date_change</td>
          <th><a href="$get_link">$link</a></th>
          <td>$comment_change</td>
     </tr>
HTML;
}
echo <<<HTML

  
              </tbody>                                
</table>
</div>
</div>
HTML;
?>