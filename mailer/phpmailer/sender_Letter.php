<?php
require_once('phpmailer/PHPMailerAutoload.php'); // link PHPMailer


$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                               // Enable verbose debug output

$mail->isSMTP();                                      // Set mailer to use SMTP
$mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
$mail->SMTPAuth = true;                               // Enable SMTP authentication
$mail->Username = 'Resetki2020@yandex.ru';                 // Наш логин
$mail->Password = 'EVtyzTcnmRcthjrc';                 // Наш пароль от ящика
$mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
$mail->Port = 465;                                    // TCP port to connect to
 
$mail->setFrom('Resetki2020@yandex.ru', 'Коммерческое предложение');   // От кого письмо 
$mail->addAddress($email_from_kp);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->addAttachment($link_pdf);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'Данные';
$mail->Body    = '
	<b> Добрый день!</b> <br> 
	Имя: ' . "GHBDNT" . ' <br>
	Номер телефона: ' . "TLE <FKJHDF"  . '<br>
	E-mail: ' . $email_from_kp . '';

if(!$mail->send()) {
    return false;
    echo "ОШИБКА ОТПРАВКИ";
} else {
    return true;
    echo "СООБЩЕНИЕ ОТПРАВЛЕНО";
}





?>
