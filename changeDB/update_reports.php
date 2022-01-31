<?php 
$sql_u = "INSERT INTO `reports`(`id`, `date_change`, `id_item`, `what_change`, `comment_change`, `author`) VALUES ('', $date_change,$id_item, $what_change, $comment_change, $author)";
$query_u = $mysqli->query($sql_u);
if (!$$query_u){
  die();
  printf("Соединение не удалось: ");
}

?>