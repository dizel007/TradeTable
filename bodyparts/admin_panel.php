<?php
echo <<<HTML
             <div class = "aboutUser">
                  Пользователь :$user
             <br>
            </div>
HTML;

        //  <<<HTML
        //      <div class = "aboutUser">
        //           Пользователь :$user
        //      <br>
        //  HTML;
 // Если загружали Файл, то при успешной загрузке появится эта надпись
 
  if (!empty($_GET['fullload']))  {
       echo "Файлы был успешно загружены <br>";
    };
                
 if ($userType ==  1) {  // если админ
     echo <<<HTML
     <!-- выборка того, что продали -->
     <div class = "aboutUser">
     <div>
     <a href="select_what_your_sell.php" target="_blank">Выборка проданных КП</a>
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