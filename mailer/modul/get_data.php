<?php

if (!empty($_POST['email_from_kp'])) {
    $email_from_kp = $_POST['email_from_kp'];
  } 
  
if (!empty($_POST['email_from_kp_new'])) {
    $email_from_kp_new = $_POST['email_from_kp_new'];
    $email_from_kp_new = str_replace(' ','', $email_from_kp_new); // удаляем случайные пробелы
}
// если не выбран ни один Емайл
if ((empty($_POST['email_from_kp'])) and (empty($_POST['email_from_kp_new'])))
 {
  die("EMAIL  не выбран!!!!!!");
};

if (!empty($_POST['subject_theme'])) {
  $subject_theme = $_POST['subject_theme'];
}

if (!empty($_POST['link_pdf'])) {
    $link_pdf = $_POST['link_pdf'];
    $link_pdf = str_replace('%20', ' ', $link_pdf);
  }


if (!empty($_POST['ZakupName'])) {
    $ZakupName = $_POST['ZakupName'];
  }

if (!empty($_POST['bodypost'])) {
    $body_post = $_POST['bodypost'];
  }
 
if (!empty($email_from_kp_new)) {
  $email_from_kp = $email_from_kp_new;
}

if (preg_match("/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i", $email_from_kp))
{
  //все ОК, email правильный
}
else
{
  exit("ЕМАЙЛ (".$email_from_kp.") НЕ ВАЛИДНЫЙ"); 
//проверка email на правильность НЕ пройдена
}
?>