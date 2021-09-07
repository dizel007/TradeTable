<?php

$mail->Host = 'smtp.timeweb.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'anmaks@anmaks.ru';                 // Наш логин
$mail->Password = '8VQQ7VyN';                 // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465; 
$mail->setFrom('anmaks@anmaks.ru', 'Торговый дом АНМАКС');   // От кого письмо 

?>
