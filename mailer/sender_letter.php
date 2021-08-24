<?php
require_once('phpmailer/PHPMailerAutoload.php'); // link PHPMailer

if (!empty($_POST['email_from_kp'])) {
    $email_from_kp = $_POST['email_from_kp'];
  }
if (!empty($_POST['link_pdf'])) {
    $link_pdf = $_POST['link_pdf'];
  }
if (!empty($_POST['ZakupName'])) {
    $ZakupName = $_POST['ZakupName'];
  }
 

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

$mail->addAddress($email_from_kp);    

// Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
$mail->addAttachment($link_pdf);         // Add attachments
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'КП от ТД АНМКАКС';
$mail->Body    = "
	<b> Добрый день!</b> <br> 
    Предлагаем рассмотреть приобретение следующей продукции, для гос.закупки <br>
    <b> $ZakupName</b>  <br><br>
	На всю предлагаемую продукцию имеются сертификаты. <br><br>
    Если у Вас есть более интересное предложение, то напишите нам, возможно мы сможешь улучшить наше КП. <br><br>
    Стоимость доставки рассчитана приблизительно, и может быть уточнена.<br><br>
    <br><br>
    С уважением<br>
    ООО ТД АНМАКС<br>
    по всем вопросам можете получить консультацию<br>
    по телефону 8-495-787-24-05<br>

                                       ";
// Запускаем отправку письма
require_once ("modul/sendfile.php");

?>
