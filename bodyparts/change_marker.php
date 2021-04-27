<?php

/// Устарело   перешел на AJAX запросы

require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";

if (!empty($_GET['id']))  {
  $id = $_GET['id'];
}

//echo "our_id=".$id."<br>";

  $sql = "SELECT * FROM reestrkp where id='$id'";
  $fQuery = $mysqli->query($sql);
  $arr_name = makeArrayFromObj($fQuery) ;
 
//var_dump($arr_name);



  foreach ($arr_name as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'marker') {
            $marker = $value1;
         }
      }
   }
//echo "#3333-".$marker."===88888888888";

if ($marker == 0 ) {
  $marker=1;}
  else {
    $marker = 0;
  }

//echo "#3333-".$marker."===88888888888";

$sql = "UPDATE reestrkp SET marker = '$marker' WHERE id = '$id'";
$fQuery = $mysqli->query($sql);

//header("Location: ../index.php#".$id); exit();
header("Location: ../index.php?id=".$id); exit();

?>