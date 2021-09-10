<?php

require 'phpmailer/PHPMailer.php';
require 'phpmailer/SMTP.php';
require 'phpmailer/Exception.php';
require_once("modul/get_data.php"); // Заполняем наши переменные

$Files_count = 0;
$i=0;


// Если у нас НЕ БЫЛ подгружен файл то загружаем файлы на сервер и добавим дальше их в письмо
if ($_FILES['upload_file']['name'][0] <> "") {
        for ($i=0; $i < count($_FILES['upload_file']['name']); $i++ ){
        $uploadfile = "../EXCEL/" . basename($_FILES['upload_file']['name'][$i]);
        $file_name = basename($_FILES['upload_file']['name'][$i]);
        $link_pppdf[$i] = "../EXCEL/". basename($_FILES['upload_file']['name'][$i]);

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
                echo "</pre>";
            }

        }
}

// Настройки PHPMailer
$mail = new PHPMailer\PHPMailer\PHPMailer();
try {

$mail->CharSet = 'utf-8';
// $mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP(); 
require_once("data_post.php");
$mail->addAddress($email_from_kp);     // Add a recipient
//$mail->addAddress('ellen@example.com');               // Name is optional
//$mail->addReplyTo('info@example.com', 'Information');
//$mail->addCC('cc@example.com');
//$mail->addBCC('bcc@example.com');
// Здесь делаем вилку, один ранее загруженный файл высылаем, или новые только что загруженные
if ($_FILES['upload_file']['name'][0] <> "") { 
        for ($i=0; $i < count($link_pppdf); $i++) {
        $mail->addAttachment($link_pppdf[$i]);         // Add attachments
        }
    } else { // если файл уже был на сервере
        $mail->addAttachment($link_pdf);
    }
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject_theme; // тема письма
$mail->Body    = $body_post;

require_once ("modul/mail_logger.php"); // логирование отправки

    if ($mail->send()) 
        {
            $result = "success";
            echo "СООБЩЕНИЕ ОТПРАВЛЕНО на адрес : ". $email_from_kp;
            $status ="OK";
        } else {
            $result = "error";
            echo "ОШИБКА ОТПРАВКИ";
            $status ="ERROR";
        }

}
 catch (Exception $e) {
    $result = "error";
    $status = "Сообщение не было отправлено. Причина ошибки: {$mail->ErrorInfo}";
}
echo json_encode(["result" => $result, "status" => $status]);

?>