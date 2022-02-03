<?php 
date_default_timezone_set('Europe/Moscow');

$date_change = date('Y-m-d');
 
$sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
  VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
$query = $mysqli->query($sql);
if (!$query){
printf("Соединение не удалось: ");
die();
}

?>