<?php

require_once("connect_db.php");
$i = 0;
$today = date("Y-m-d H:i:s"); 

$sql = ("SELECT * FROM inncompany");
$user = $mysqli->query($sql);
while ($row = $user->fetch_assoc()) {
  $id = $row['id'];
  $inn = $row["inn"];
  $phone = $row["telefon"];
  
  echo $phone . "<br>";
  $phone = str_replace(";", ",", $phone);
  $arr_phones = explode(",", $phone);
  $i++;

echo "<br>";
echo "ID=".$id."<br>";
echo "ИНН=".$inn."<br>";

foreach ($arr_phones as $key => $value) {
  if (strlen($value) > 4) {
  $value = preg_replace('/[^0-9]/', '', $value);
  $value = preg_replace('/[D]/', '', $value);
  $value = substr_replace($value, " ", 1, 0);
  $value = substr_replace($value, "(", 2, 0);
  $value = substr_replace($value, ")", 6, 0);
  $value = substr_replace($value, " ", 7, 0);
  $value = substr_replace($value, "-", 11, 0);
  $value = substr_replace($value, "-", 14, 0);
  echo "ТЕЛЕФ=".$value."<br>";
  $tel[] = ($value);
  }
}
// Вычитываем все телефоны с таким ИНН
$sql = "SELECT telephone FROM telephone WHERE inn = '$inn'";
$query = $mysqli->query($sql);
$i = 0;

while ($row = $query->fetch_assoc()) {
  $phone_db[] = $row["telephone"];
  $i++;
}



foreach ($tel as $tel => $val) {
  $priz = 0;
  $new_phone = substr($val, 0, 17);

  // echo "tel[$tel]=" . $new_phone . "<br>";

  if (isset($phone_db)) {
  
    foreach ($phone_db as $key => $phone_) {
      // echo "phone__=" . $phone_ . "===" . $new_phone . "<br>";
      if ($new_phone == $phone_) { $priz = 1; }
    }
  }
  if ($priz <> 1) {
    $sql_update_phone  = "INSERT INTO `telephone`(`id`, `inn`, `telephone`, `comment`, `whatsapp`, `date_write`, `name`, `old_phone`) VALUES ('','$inn','$new_phone','',0, '$today','','$val')";
    $query = $mysqli->query($sql_update_phone);
    echo "ADD NUMBER<br>";
    if (!$query) {
      echo "WE ARE DIE <br>";
      die(mysqli_error($mysqli));
      printf("Соединение не удалось: ");
    }
  }
}
unset($tel);
}