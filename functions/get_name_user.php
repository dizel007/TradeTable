<?php
function getNameUser($user) {
$name="";
  if ($user == "guts") {
    $name = "Гуц";
  }
  if ($user == "zeld") {
    $name = "Зелизко";
  }
  if ($user == "man") {
    $name = "Мандрыкин";
  }
  if ($user == "sti") {
    $name = "Штыбко";
  }
  return $name;
}
?>