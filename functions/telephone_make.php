<?php
  function telephoneMake($value) {
  $value = preg_replace('/[^0-9]/', '', $value);
  $value = preg_replace('/[D]/', '', $value);
  $value = substr_replace($value, " ", 1, 0);
  $value = substr_replace($value, "(", 2, 0);
  $value = substr_replace($value, ")", 6, 0);
  $value = substr_replace($value, " ", 7, 0);
  $value = substr_replace($value, "-", 11, 0);
  $value = substr_replace($value, "-", 14, 0);
return $value;
  }

function DeleteFirstSymbol($value) {
 $toDelete = 1; // сколько знаков надо убрать
mb_internal_encoding("UTF-8");
$value = mb_substr( $value, $toDelete);
$value = trim($value);
return $value;
}



  ?>

