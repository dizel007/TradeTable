<?php

if (!empty($_POST['id'])) {
  $id = $_POST['id'];
} 
if (!empty($_POST['Zakazchik'])) {
  $Zakazchik = $_POST['Zakazchik'];
  $Zakazchik = str_replace('%20',' ', $Zakazchik); // чтобы передавать длинные пути с пробелами
} 

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

  /// Имя пользователя
  if (!empty($_POST['user_mail'])) {
    $user_mail = $_POST['user_mail'];
  }
// Наименование закупки
if (!empty($_POST['ZakupName'])) {
    $ZakupName = $_POST['ZakupName'];
  }
// текст письма
if (!empty($_POST['bodypost'])) {
    $body_post = $_POST['bodypost'];
  }
 
if (!empty($email_from_kp_new)) {
  $email_from_kp = $email_from_kp_new;
}


require_once "valid_email.php";

?>