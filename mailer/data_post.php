<?php

$mail->Host = 'mail.netangels.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'send@anmaks.online';                 // Наш логин
$mail->Password = 'yww@cP8TDf88Kr6';                 // Наш пароль от ящика
// $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 25; 
$mail->setFrom('send@anmaks.online', 'Торговый дом АНМАКС');   // От кого письмо 

?>
