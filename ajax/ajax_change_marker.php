<?php
require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";

 $id = $_GET['id'];
           
 $sql = "SELECT * FROM reestrkp where id='$id'";
 $fQuery = $mysqli->query($sql);
 $arr_name = makeArrayFromObj($fQuery) ;
 
  foreach ($arr_name as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'marker') {
            $marker = $value1;
         }
      }
   }

if ($marker == 0 ) {
  $marker=1;}
  else {
    $marker = 0;
  }

$sql = "UPDATE reestrkp SET marker = '$marker' WHERE id = '$id'";
$fQuery = $mysqli->query($sql);



$sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
$user = $mysqli->query($sql);
while ($row = $user -> fetch_assoc()) 
{
       $user_login = $row["user_login"];
   }
echo $marker;
