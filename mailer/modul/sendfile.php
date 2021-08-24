<?php
if(!$mail->send()) {
  echo "ОШИБКА ОТПРАВКИ";
  return false;
 
 
} else {
  echo "СООБЩЕНИЕ ОТПРАВЛЕНО на адрес : ". $email_from_kp;
  return true;
}
?>