<?php

require_once("connect_db.php");
$i = 0;
$today = date("Y-m-d H:i:s"); 

$sql = ("SELECT * FROM inncompany");
$user = $mysqli->query($sql);
while ($row = $user->fetch_assoc()) {
  $id = $row['id'];
  $inn = $row["inn"];
  $email = $row["email"];
  
  echo $email . "<br>";
  $sql= "SELECT * FROM inncompany WHERE inn='$inn'";
  $query1 = $mysqli->query($sql);
  if ($query1-> num_rows>1) {
    echo "MANY INN";
    continue;
   
  }
  $email = str_replace(";", ",", $email);
  $arr_email = explode(",", $email);
  $i++;

echo "<br>";
echo "ID=".$id."<br>";
echo "ИНН=".$inn."<br>";

foreach ($arr_email as $key => $value) 
  {
    echo "EMAIL = ".$value."<br>";
    $tel[] = ($value);
  }

// Вычитываем все телефоны с таким ИНН
$sql = "SELECT email FROM `email` WHERE `inn` = '$inn'";
$query = $mysqli->query($sql);

$i = 0;
  while ($row = $query->fetch_assoc()) {
  $email_db[$i] = $row["email"];
  $i++;
}

foreach ($tel as $tel => $val) {
  $priz = 0;
  $new_email = $val;
  echo "tel[$tel]=" . $val . "<br>";

  if (isset($email_db)) {
  
    foreach ($email_db as $key => $email_) {
      echo "email_old_=" . $email_ . "===" . $new_email . "<br>";
      if ($new_email == $email_) { $priz = 1; }
    }
  }
  if ($priz <> 1) {
    $sql_update_email  = "INSERT INTO `email`(`id`, `inn`, `email`, `comment`, `date_write`, `actual`) 
    VALUES ('','$inn','$new_email','','$today','')";
    
    $query = $mysqli->query($sql_update_email);
    echo "ADD EMAIL<br>";
    if (!$query) {
      echo "WE ARE DIE <br>";
      die(mysqli_error($mysqli));
      printf("Соединение не удалось: ");
    }
  }
}
unset($tel);
echo  "<br>";
}