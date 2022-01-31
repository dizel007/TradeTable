<?php
  if (isset($_GET["typeQuery"])) {
    $typeQuery= $_GET['typeQuery'];
   } else {
    $typeQuery= "";
  }

if (isset($_GET["Responsible"])) {
    $Responsible= $_GET['Responsible'];
   } else {
    $Responsible= "";
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
  if (isset($_GET["KpCondition"])) {
    $KpCondition= $_GET['KpCondition'];
  } else {
    $KpCondition= "";
  }
  if (isset($_GET["FinishContract"])) {
    $FinishContract= $_GET['FinishContract'];
  } else {
    $FinishContract= "";
  }
$date_now=date('Y-m-d');

if ($typeQuery == 1) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end'";
}
if ($typeQuery == 2) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end'";
}
if ($typeQuery == 21) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `KpCondition` = '$KpCondition' AND `KpData` >= '$date_start' AND `KpData` <= '$date_end' AND `FinishContract` = '$FinishContract'";
}
if ($typeQuery == 3) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `date_sell` >= '$date_start' AND
  `date_sell` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract'";
}
if ($typeQuery == 4) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$Responsible' AND `DateNextCall` <= '$date_now'
     AND `DateNextCall` <> '' AND `FinishContract` <>1";
}
if ($typeQuery == 5) {
  $sql = "SELECT * FROM `reestrkp` WHERE `KpData` >= '$date_start' AND
  `KpData` <= '$date_end'";
}
if ($typeQuery == 6) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract'";
}
if ($typeQuery == 7) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `KpData` >= '$date_start' AND
  `KpData` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract'";
}
if ($typeQuery == 8) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `date_sell` >= '$date_start' AND
  `date_sell` <= '$date_end' AND `KpCondition` = '$KpCondition' AND `FinishContract` = '$FinishContract'";
}
if ($typeQuery == 9) {
  $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` <> '' AND `DateNextCall` <= '$date_now'
     AND `DateNextCall` <> '' AND `FinishContract` <>1";
}
// echo "<br>***".$sql."<br>";

$query= $mysqli->query($sql);
$arr_items = MakeArrayFromObj($query);
   printOurTable($arr_items, 1, 1, 200) ;
   
?>