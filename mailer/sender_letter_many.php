<?php
require_once('phpmailer/PHPMailerAutoload.php'); // link PHPMailer

if (!empty($_POST['email_from_kp'])) {
    $email_from_kp = $_POST['email_from_kp'];
  }
 
  if (!empty($_POST['ZakupName'])) {
    $ZakupName = $_POST['ZakupName'];
  }




// echo "<pre>";
// var_dump($_FILES['upload_file']['name']);
// echo "<pre>";

  $Files_count = 0;
  // echo "КОЛИЧЕСТВО ФАЙЛОВ NN = ".count($_FILES['upload_file']['name']). "<br>";
$i=0;
for ($i=0; $i < count($_FILES['upload_file']['name']); $i++ ){
$uploadfile = "../EXCEL/" . basename($_FILES['upload_file']['name'][$i]);
// echo "------------".$uploadfile."----2333==<br>";
$file_name = basename($_FILES['upload_file']['name'][$i]);
$link_pppdf[$i] = "../EXCEL/". basename($_FILES['upload_file']['name'][$i]);
// echo "333333333===".$file_name."3eeeeeeeeeeeeee<br>";
//  echo "3333--" . $uploadfile;
// echo "<br>888==".$_FILES['upload_file']['tmp_name']."<br>";

      if (move_uploaded_file($_FILES['upload_file']['tmp_name'][$i], $uploadfile)) {
          // echo "Файл корректен и был успешно загружен.\n";
          $Files_count++;
           if ($Files_count == count($_FILES['upload_file']['name'])) {
            //   header("Location: ../index.php?fullload=777"); exit();
           }
           

      } else {
          echo '<pre>';
              
              echo "Некоторая отладочная информация:\n";
                  print_r($_FILES);

                  print "</pre>";
      }

}
// echo "---------------------------------------------------<br>";
// echo "<pre>";
// var_dump($link_pppdf);
// echo "<pre>";





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
for ($i=0; $i < count($link_pppdf); $i++) {
$mail->addAttachment($link_pppdf[$i]);         // Add attachments
}
//$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = 'КП от ТД АНМКАКС';
$mail->Body    = "
	<b> Добрый день!</b> <br> 
    Предлагаем рассмотреть приобретение систем водоотвода, для гос.закупки <br>
    На всю предлагаемую продукцию имеются сертификаты. <br><br>
    Если у Вас есть более интересное предложение, то напишите нам, возможно мы сможешь улучшить наше КП. <br><br>
    Стоимость доставки рассчитана приблизительно, и может быть уточнена.<br><br>
    <br><br>
    С уважением<br>
    ООО ТД АНМАКС<br>
    по всем вопросам можете получить консультацию<br>
    по телефону 8-495-787-24-05<br>

                                       ";

if(!$mail->send()) {
    echo "ОШИБКА ОТПРАВКИ";
    return false;
   
   
} else {
    echo "СООБЩЕНИЕ ОТПРАВЛЕНО";
    return true;
  
}

?>
