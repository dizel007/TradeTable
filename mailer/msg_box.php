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


$emails = str_replace(';', ',', $email_from_kp);
$emails = str_replace(' ', '', $email_from_kp);
$emails = explode(",", $emails);
$email_count = count($emails);


// echo "<pre>";
// var_dump($emails);
// echo "<pre>";
// echo $email_count;

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

// Форма Для отправки, Если МЫ нашли в каталоге файл
echo "<h2> ФОРМА ДЛЯ ОТПРАВКИ ПИСЬМА КЛИЕНТУ</h2>	 <hr>";

// if ($real_file) {

if (file_exists($link_pdf_excel)) { /// если есть Ексель файл, то выводим данне с него
echo <<<HTML
     <h3>$ZakupName</h3>
		 <b>Заказчик : $Zakazchik </b><br>
		 <b>EMAIL из КП : $Email</b><br>
		 <br>
		 <hr>
HTML;
} else { // Если ексель файла нет
  echo "<h4>КП в формате EXCEL отсутствует на сервере </h4>";
}

$Zakazchik = str_replace(' ', '%20', $Zakazchik); // чтобы передавать длинные пути с пробелами

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
echo "<hr>";
echo <<<HTML
      <!-- Наименование Закупки : -->
       <select hidden size="1" name="ZakupName" value = $ZakupName></select>

HTML;
// Когда нужно отправить файл загруженный на сервер
if ($real_file) {
echo <<<HTML
  <h4>Подгрузиться либо предложенный файл с сервера, либо подцепите новые файлы</h4>
      к письму подгрузиться файл: <b>$link_pdf_text</b>
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
  <b>файл $link_pdf_text на сервере отсутствует.</b> <br><br> подгрузите файл(ы) для отправки :
 <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>   
 <input name="upload_file[]" type="file" multiple>
HTML;
}

echo <<<HTML
<hr>
<h4>Предмет письма</h4>
<p>
<input type="text"  name="subject_theme"  size="175" value = "КП от ТД АНМКАКС" placeholder="КП от ТД АНМКАКС">
</p>
<h4>ТЕКСТ ПИСЬМА</h4>
<h4>Можно править все, что угодно, только следить за стилистическими тэгами</h4>
   <textarea name="bodypost" cols="175" rows="14">
   <b>Добрый день!</b> <br> 
    Предлагаем рассмотреть приобретение следующей продукции, для гос.закупки <br>
    <b>
       $ZakupName
    </b>  <br><br>
    На всю предлагаемую продукцию имеются сертификаты. <br><br>
    Если у Вас есть более интересное предложение, то напишите нам, возможно мы сможешь улучшить наше КП. <br><br>
    Стоимость доставки рассчитана приблизительно, и может быть уточнена.<br><br>
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
HTML;
// }
// Форма Для отправки, Если МЫ **** НЕЕЕЕЕ ******* нашли в каталоге файл
// else {
//  echo <<< HTML
 
//  <form enctype="multipart/form-data" action="sender_letter_many.php"  method="post">
//  HTML;
//  require_once ("modul/email_spisok.php");     
 
//  echo <<<HTML
//  <!-- <p>
//           email :
//            <input type="text" id="email_from_kp" name="email_from_kp" value ="$email_from_kp"/>
//       </p> -->
//    файл $link_pdf_text на сервере отсутствует. <br><br> подгрузите файл(ы) для отправки :
//   <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>   
//   <input name="upload_file[]" type="file" multiple>
//   <p>
//   <p><input type="submit" value="Отправить"></p>

// HTML;
// }

?>