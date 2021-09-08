<?php
// echo "+++1<br>";
require_once('phpmailer/PHPMailerAutoload.php'); // link PHPMailer
// echo "+++2<br>";
require_once("modul/get_data.php"); // Заполняем наши переменные
// echo "+++3<br>";
$Files_count = 0;
$i=0;



// echo "<pre>";
// var_dump($_FILES['upload_file']);
// echo "<pre>";
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
// echo "---------------------------------------------------<br>";
// echo "<pre>";
// var_dump($link_pppdf);
// echo "<pre>";
// echo "---------------------------------------------------<br>";

// echo "+++4<br>";


$mail = new PHPMailer;
$mail->CharSet = 'utf-8';

// $mail->SMTPDebug = 3;                               // Enable verbose debug output
$mail->isSMTP(); 
require("data_post.php");
// $mail->Host = 'smtp.yandex.ru';  // Specify main and backup SMTP servers
// $mail->SMTPAuth = true;                               // Enable SMTP authentication
// $mail->Username = 'Resetki2020@yandex.ru';                 // Наш логин
// $mail->Password = 'EVtyzTcnmRcthjrc';                 // Наш пароль от ящика
// $mail->SMTPSecure = 'ssl';                            // Enable TLS encryption, `ssl` also accepted
// $mail->Port = 465;                                   // TCP port to connect to
// $mail->setFrom('Resetki2020@yandex.ru', 'Коммерческое предложение');   // От кого письмо 

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
        // echo "МЫ ИУИ БЫЛИ";
        $mail->addAttachment($link_pdf);
    }



    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
$mail->isHTML(true);                                  // Set email format to HTML

$mail->Subject = $subject_theme; // тема письма
$mail->Body    = $body_post;
// $mail->Body    = "
//     <b> Добрый день!</b> <br> 
//     Предлагаем рассмотреть приобретение следующей продукции, для гос.закупки <br>
//     <b> $ZakupName</b>  <br><br>
//     На всю предлагаемую продукцию имеются сертификаты. <br><br>
//     Если у Вас есть более интересное предложение, то напишите нам, возможно мы сможешь улучшить наше КП. <br><br>
//     Стоимость доставки рассчитана приблизительно, и может быть уточнена.<br><br>
//     <br><br>
//     С уважением<br>
//     ООО ТД АНМАКС<br>
//     по всем вопросам можете получить консультацию<br>
//     по телефону 8-495-787-24-05<br>

//                                        ";
// echo "0000000000000000-".$subject_theme."<br>";
// echo $email_from_kp."<br>";
// Запускаем отправку письма

// echo "+++5<br>";
require_once ("modul/mail_logger.php");
require_once ("modul/sendfile.php");
// echo "+++6<br>";
?>