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
    $date_change = $value["date_change"];
    $comment_change = $value["comment_change"];
    $id_item = $value["id_item"];
    $author = $value["author"];  
    

    foreach ($arr_users as $user) {
      if ($author == $user["user_login"]) {$user_name = $user["user_name"];}
    }



$sql = "SELECT * from `reestrkp` WHERE id = $id_item";
$query= $mysqli->query($sql);
$arr_for_kp_num = MakeArrayFromObj($query);
$kp_num = $arr_for_kp_num[0]["KpNumber"];
$kp_date = $arr_for_kp_num[0]["KpData"];


echo <<<HTML
     <tr>
          <td>$i</td>
          <td>$user_name</td>
          <td>$date_change</td>
          <th><a href="index.php?id=$id_item">$kp_num от $kp_date</a></th>
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