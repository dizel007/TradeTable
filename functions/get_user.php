<?php

function GetUser ($mysqli) {
  $sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
$user = $mysqli->query($sql);
while ($row = $user -> fetch_assoc()) 
   {
       $user_login = $row["user_login"];
   }
return $user_login;
 }

?>