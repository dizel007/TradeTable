<?php
require_once ("../connect_db.php"); // подключение к БД
require_once ("../functions/make_arr_from_obj.php"); // подключение к БД

$fquery="";

if (!empty($_GET['InnCustomer'])) {
  $InnCustomer = $_GET['InnCustomer'];
}
if (!empty($_GET['id'])) {
  $id = $_GET['id'];
}

// echo "333=", $InnCustomer;
// echo "id=", $id;

$sql = "SELECT * FROM `inncompany` WHERE `inn` = $InnCustomer";
// echo "<br>". $sql;
$fQuery = $mysqli->query($sql);
$arr_comp = MakeArrayFromObjINN($fQuery) ;
$email_from_kp = $arr_comp[0]['email'];
// echo $email_from_kp;

$sql = "SELECT * FROM `reestrkp` WHERE `id` = $id";
$fQuery = $mysqli->query($sql);
$arr_kp = MakeArrayFromObj($fQuery) ;
$link_pdf = substr($arr_kp[0]['LinkKp'], 0,-4);

$link_pdf_text = substr($arr_kp[0]['LinkKp'], 6,-4)."pdf";
$link_pdf = $link_pdf."pdf";
$link_pdf ="../".$link_pdf;
$real_file =file_exists($link_pdf);

// echo "Существует ли выбранный файл=".$real_file." ХХХ";
// echo "<br>".$link_pdf;

require_once ("excel_pars_for_send.php"); // шапка файила


echo <<<HTML

<form  action="sender_letter.php"  method="post">
        <p>
          email :
           <input type="text" id="email_from_kp" name="email_from_kp" value ="$email_from_kp"/>
      </p>
           Наименование Закупки :
          <select size="1" name="ZakupName">
              <option>$ZakupName</option>
          </select>

HTML;
if ($real_file) {
  echo <<<HTML
        <p>
         к Письму подгрузиться файл: <br>
         <select size="1" name="link_pdf">
              <option value ="$link_pdf">$link_pdf_text</option>
          </select>
        <p>
HTML;
}
else {
 echo <<< HTML
  <p>
  файл $link_pdf_text на сервере отсутствует. <br> подгрузите файл(ы) для отправки :
   <input type="text" id="link_pdf" name="link_pdf" value =""/>
  <p>
              
              

HTML;
}
echo  <<<HTML
<p><input type="submit" value="Отправить"></p>
</form>
HTML;

?>