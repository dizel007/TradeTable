<?php
require_once ("functions/get_name_user.php");
require_once ("functions/get_condition_kp.php");
echo <<<HTML
             <div class = "aboutUser">
                  Пользователь :$user
                  (<a href="?date_start=&date_end=&value=$userName&id=&typeQuery=10">$userName</a>)
                  (<a href="?min_sum=0&max_sum=100000&id=&typeQuery=601"> ВСЕ КП до 100 000 руб</a>)
             <br>
            </div>
HTML;
// }

// Если загружали Файл, то при успешной загрузке появится эта надпись
  if (!empty($_GET['fullload']))  {
       echo "Файлы был успешно загружены <br>";
    };
                
 if ($userType ==  1) {  // если админ
     echo <<<HTML
     <!-- выборка того, что продали -->
     <div class = "aboutUser">
     <div>
     <a href="select_what_your_sell.php" target="_blank">Выборка проданных КП  </a>
      ****
     <a href="register.php" target="_blank">   Ввод нового пользователя</a>
     ****
     <a href="reports.php" target="_blank">   Аналитика</a>
     </div>
       <div class ="adminButton">
                    <a href="changedb/insert_raw_in_bd.php">Ввод данных в БД</a>
                    | |  
                    <a href="changedb/insert_raw_comp_inn.php">Ввод ИНН</a>
                    
        <br> <br>
   
<!-- ФОРМА ДЛЯ ЗАГРУЗКИ ФАЙЛОВ НА САЙТ -->

            <form enctype="multipart/form-data" action="functions/loadfiles.php" method="POST">
                
                <input type="hidden" name="MAX_FILE_SIZE" value="500000" multiple>
                            <select size="1" name="adres">
                                    <option disabled>Загружать</option>
                                    <option value="/EXCEL/">КП</option>
                                    <option value="/">в БД</option>
                            </select>    
                файл: <input name="upload_file[]" type="file" multiple>
                <input type="submit" value="Отправить" >
            </form>
</div>
</div>
HTML;
}
?>