<?php
require_once ("connect_db.php");
$sql = "SELECT * FROM `users`";
$query = $mysqli->query($sql);
$arr_users = MakeArrayFromObjUsers($query);
for ($i=0; $i<count($arr_users); $i++) {
  if ($arr_users[$i]['user_login'] == $user) {
    $userName = $arr_users[$i]['user_name'];
  }
}
$sql = "SELECT * FROM `users` WHERE `user_active`= 1";
$query = $mysqli->query($sql);
$arr_users_active = MakeArrayFromObjUsers($query);
?>