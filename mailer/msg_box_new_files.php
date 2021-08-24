<?php
require_once ("../connect_db.php"); // подключение к БД
require_once ("../functions/make_arr_from_obj.php"); // подключение к БД

$fquery="";
$ZakupName="";
if (!empty($_GET['email_from_kp'])) {
  $email_from_kp = $_GET['email_from_kp'];
}
if (!empty($_GET['ZakupName'])) {
  $ZakupName = $_GET['ZakupName'];
}


$emails = str_replace(';', '', $email_from_kp);
$emails = str_replace(' ', '', $email_from_kp);
$emails = explode(",", $emails);
$email_count = count($emails);


// Форма Для отправки, Если МЫ нашли в каталоге файл
echo <<<HTML
<form enctype="multipart/form-data" action="sender_letter_many.php"  method="post">

<p>Наименование Закупки :
          <!-- <select size="1" name="ZakupName"> -->
              $ZakupName</p>
          <!-- </select> -->


<br>

HTML;
require_once ("modul/email_spisok.php"); 

   echo <<<HTML
<br>
  <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>   
  <input name="upload_file[]" type="file" multiple>
  <p>
  <p><input type="submit" value="Отправить"></p>



</form>
HTML;


?>