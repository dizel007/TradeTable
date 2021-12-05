<?php
if (preg_match("/^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$/i", $email_from_kp))
{
  //все ОК, email правильный
}
else
{
  exit("ЕМАЙЛ (".$email_from_kp.") НЕ ВАЛИДНЫЙ"); 
//проверка email на правильность НЕ пройдена
}
?>