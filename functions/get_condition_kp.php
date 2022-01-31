<?php
require_once ("connect_db.php");
$sql = "SELECT * FROM `condition_kp`";
$query = $mysqli->query($sql);
$arr_condition_kp = MakeArrayFromObjConditionKp($query);
?>