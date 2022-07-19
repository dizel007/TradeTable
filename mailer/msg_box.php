<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href="../css/bootstrap/css/bootstrap.css">
  <link rel = "stylesheet" href="../css/mailsend.css">

  <title>Форма для отправки письма клиенту</title>
</head>
<body>
  <div class="container">
    <div class="row">
<?php
// require_once ("../connect_db.php"); // подключение к БД
require_once ("../functions/make_arr_from_obj.php"); // подключение к БД

$fquery="";
$ZakupName="";
if (!empty($_GET['InnCustomer'])) {
  $InnCustomer = $_GET['InnCustomer'];
}
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
}

// находим по ИНН Емайл отправителя
$sql = "SELECT * FROM `inncompany` WHERE `inn` = $InnCustomer";
$fQuery = $mysqli->query($sql);
$arr_comp = MakeArrayFromObjINN($fQuery) ;
$email_from_kp = $arr_comp[0]['email'];

// $emails = str_replace(';', ',', $email_from_kp);
// $emails = str_replace(' ', '', $email_from_kp);
// $emails = explode(",", $emails);
// $email_count = count($emails);

//  БЕРЕM ЕМАЙЛЫ ИЗ БАЗЫ ИНН
$sql = "SELECT * FROM `email` WHERE `inn` = $InnCustomer";
$fQuery = $mysqli->query($sql);
$arr_emails = MakeArrayFromObjEmail ($fQuery);

// находим по ID закупки наименование файла, который будем отправлять
$sql = "SELECT * FROM `reestrkp` WHERE `id` = $id";
$fQuery = $mysqli->query($sql);
$arr_kp = MakeArrayFromObj($fQuery) ;

// формируем путь к загружаемому файлу
$link_pdf = substr($arr_kp[0]['LinkKp'], 0,-4);
$link_pdf = $link_pdf."pdf";
$link_pdf ="../".$link_pdf;
// проверяемя существует ли файл на сервере
$real_file =file_exists($link_pdf);

$link_pdf_text = substr($arr_kp[0]['LinkKp'], 6,-4)."pdf"; // формируем для вывода на экран имя файла
$link_pdf_excel = "../".$arr_kp[0]['LinkKp']; // делаем путь для ексель файла


if (file_exists($link_pdf_excel)) require_once ("excel_pars_for_send.php"); // шапка файила

$ZakupNameTemp = str_replace('"', '', $ZakupName);
$ZakupNameTemp = str_replace(' ', '%20', $ZakupNameTemp); // чтобы передавать длинные пути с пробелами
$link_pdf = str_replace(' ', '%20', $link_pdf); // чтобы передавать длинные пути с пробелами


$pos_N = strpos($ZakupName, "№");
$ZakupName = substr($ZakupName,$pos_N);

// Форма Для отправки, Если МЫ нашли в каталоге файл
echo "<div class=\"col-12 shadow-lg up-page\">";
echo "<h5 class=\"center\"> ФОРМА ДЛЯ ОТПРАВКИ ПИСЬМА КЛИЕНТУ</h5>";
// 
// 
// 
// if ($real_file) {

if (file_exists($link_pdf_excel)) { /// если есть Ексель файл, то выводим данне с него
echo <<<HTML
     <b>$ZakupName</b><br>
		 <b>Заказчик : $Zakazchik </b><br>
		 <b>EMAIL из КП : $Email</b>
HTML;
} else { // Если ексель файла нет
  echo "<h5 class =\"text-danger\">КП в формате EXCEL отсутствует на сервере </h5>";
}
echo "</div>";
if (isset($Zakazchik)) {
    $Zakazchik = str_replace(' ', '%20', $Zakazchik); // чтобы передавать длинные пути с пробелами
  } else {
    $Zakazchik="";
  }

echo <<<HTML

<form enctype="multipart/form-data" action="sender_letter_many.php"  method="post">
<!-- передаем ID  закупки -->
<select hidden size="1" name="id">
            <option value=$id>$id</option>
</select>
<!-- передаем ID  закупки -->
<select hidden size="1" name="Zakazchik">
            <option value=$Zakazchik>$Zakazchik</option>
</select>
      <!-- имя пользователя : --> 
<select hidden size="1" name="user_mail">
          <option value=$user_mail>$user_mail</option>
</select>

HTML;
require_once ("modul/email_spisok.php"); // Выводим список емайлов из БД
echo "<div class =\"col-6 shadow-lg link-file\" >";
echo <<<HTML
      <!-- Наименование Закупки : -->
      
       <select hidden size="1" name="ZakupName" value = $ZakupName></select>
       
HTML;
// Когда нужно отправить файл загруженный на сервер
if ($real_file) {
echo <<<HTML
  <h5>Подгрузиться либо предложенный файл с сервера, либо подцепите новые файлы</h5>
      к письму подгрузиться файл: <a href="$link_pdf" target="_blank"><img src="../icons/table/pdf.png"></a><b>$link_pdf_text</b>
    <!-- <select hidden size="1" name="link_pdf" value= $link_pdf></select> -->
      <select hidden size="1" name="link_pdf">
            <option value=$link_pdf>$link_pdf_text</option>
      </select>

      <br><br>Либо подгрузить другие файлы с КП  <b>(макс. размер 0,5 Мб каждый)</b> <br> подгрузите файл(ы) для отправки :
      <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>   
      <input name="upload_file[]" type="file" multiple>
  
          
        <!-- <div><a href="msg_box_new_files.php?email_from_kp=$email_from_kp&ZakupName=$ZakupNameTemp"> Подгрузить другие файлы </a></div> -->
HTML;
} else {
// Когда нужно отправить файл новый файл
echo <<<HTML
  <b class="text-danger">файл $link_pdf_text на сервере отсутствует.</b> <br><br> подгрузите файл(ы) для отправки :
 <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>   
 <input name="upload_file[]" type="file" multiple>
HTML;
}
echo "</div>";
echo <<<HTML
<div></div>
<div class = "col-12 post-data">

<h4>Предмет письма</h4>
<p>
<input type="text"  name="subject_theme"  size="150" value = "КП от ТД АНМАКС" placeholder="КП от ТД АНМАКС">
</p>
<h5>ТЕКСТ ПИСЬМА (Можно править все, что угодно, только следить за стилистическими тэгами)</h5>

   <textarea name="bodypost" cols="150" rows="14">
   <b>Добрый день!</b> <br> 
    Предлагаем рассмотреть приобретение следующей продукции, для гос.закупки <br>
    <b>
       $ZakupName
    </b>  <br><br>
    На всю предлагаемую продукцию имеются сертификаты. <br><br>
    Если у Вас есть более интересное предложение, сообщите нам, пожалуйста, мы постараемся улучшить условия нашего КП.<br><br>
    <br><br>
    С уважением<br>
    ООО ТД АНМАКС<br>
    по всем вопросам можете получить консультацию<br>
    по телефону 8 (495) 787-24-05<br>
    <img border=0 src="https://tradestorm.ru/images/tovar.jpg" useMap=#FPMap0>
    <img border=0 src="https://tradestorm.ru/images/logo.jpg" useMap=#FPMap0>
    </textarea>

HTML;

echo <<<HTML
        <p><input type="submit" value="Отправить"></p>
</form>

</div> <!--  конец post-data- -->
</div>
</div>
HTML;

?>