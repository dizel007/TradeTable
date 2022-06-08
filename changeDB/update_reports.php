<?php 
date_default_timezone_set('Europe/Moscow');

$date_change = date('Y-m-d');

// Проверяем если ли какой нибуль комментарий, если нет, то не добавляем строку
if ($comment_change<>"") { 
$sql = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`)
  VALUES ('', '$date_change', '$id_item', '$what_change', '$comment_change', '$author')";
$query = $mysqli->query($sql);

if (!$query){
printf("Какой то облом, с записью в таблицу reports(): ". $sql);
die();
}
}

?>