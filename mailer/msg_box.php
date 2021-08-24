<?php
require_once ("../connect_db.php"); // подключение к БД
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


$emails = str_replace(';', '', $email_from_kp);
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
$ZakupNameTemp = str_replace(' ', '%20', $ZakupNameTemp);
// echo "@@@@<br>". $ZakupNameTemp;
if ($real_file) {
// Форма Для отправки, Если МЫ нашли в каталоге файл
echo <<<HTML


<form enctype="multipart/form-data" action="sender_letter.php"  method="post">
        <!-- <p>
          email :
           <input type="text" name="email_from_kp" value ="$email_from_kp"/>
      </p> -->
      <br>
      <br>
HTML;

require_once ("modul/email_spisok.php");

// for ($i=0; $i<count($emails); $i++) {   
// echo "<input type=\"radio\" name=\"email_from_kp\" value=\"$emails[$i]\">$emails[$i]<Br>";
// }
// echo "<br> Новый Email:";
// echo "<input type=\"email\" name=\"email_from_kp\" value=\"\"><br>";
   echo <<<HTML
<br>

      Наименование Закупки :
          <select size="1" name="ZakupName">
              <option>$ZakupName</option>
          </select>
        <p>
         к Письму подгрузиться файл: <br>
         <select size="1" name="link_pdf">
              <option value ="$link_pdf">$link_pdf_text</option>
          </select>
        <p>
          <div><a href="msg_box_new_files.php?email_from_kp=$email_from_kp&ZakupName=$ZakupNameTemp"> Подгрузить другие файлы </a></div>
        <p><input type="submit" value="Отправить"></p>
</form>
HTML;
}
// Форма Для отправки, Если МЫ **** НЕЕЕЕЕ ******* нашли в каталоге файл
else {
 echo <<< HTML
 <form enctype="multipart/form-data" action="sender_letter_many.php"  method="post">
 HTML;
 require_once ("modul/email_spisok.php");     
 
 echo <<<HTML
 <!-- <p>
          email :
           <input type="text" id="email_from_kp" name="email_from_kp" value ="$email_from_kp"/>
      </p> -->
    файл $link_pdf_text на сервере отсутствует. <br><br> подгрузите файл(ы) для отправки :
  <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>   
  <input name="upload_file[]" type="file" multiple>
  <p>
  <p><input type="submit" value="Отправить"></p>

HTML;
}

?>