<?php
require_once ("functions/get_name_user.php");
require_once ("functions/get_condition_kp.php");

// Ищем Все КП которые Просрoчены**********************
    $sql = "SELECT * FROM `reestrkp` WHERE `Responsible` = '$userName'";
    $query = $mysqli->query($sql);
    $overdue_kp=0;
    $overdue_now=0;
    $arr_overdue_kp = MakeArrayFromObj($query);
    $date_now=date('Y-m-d');
if (isset($arr_overdue_kp[0]["Responsible"])) {
    for ($j=0; $j<count($arr_overdue_kp); $j++) {
      // Просроченных ВСЕГО
       if (($arr_overdue_kp[$j]["DateNextCall"] < $date_now) && ($arr_overdue_kp[$j]["DateNextCall"] <>'0000-00-00') && ($arr_overdue_kp[$j]["FinishContract"] <>1)  ) 
        { $overdue_kp++;}
    // ОТЛОЖЕННЫХ НА СЕГОДНЯ
    if (($arr_overdue_kp[$j]["DateNextCall"] == $date_now) && ($arr_overdue_kp[$j]["FinishContract"] <>1)  ) 
        { $overdue_now++;}

      }
    }


echo <<<HTML

             <div class = "aboutUser">
                    <div class="admin_box" >Пользователь :$user 
                        <a href="?date_start=&date_end=&value=$userName&id=&typeQuery=10">($userName)</a>
                    </div>
                    <div class="admin_box" >
     <a href="reports.php" target="_blank">Аналитика</a>
     </div>
                    <div class="admin_box" >
                        <a href="?min_sum=0&max_sum=100000&id=&typeQuery=601"> ВСЕ КП до 100 000 руб</a>
                    </div>
HTML;
// Если есть КП по которым нужно позвонить сегодня , то выводим блок
if ($overdue_now > 0) {
echo <<<HTML
                    <div class="admin_box admin_box_alarm">
                       <a href="index.php?typeQuery=571&Responsible=$userName&KpCondition=&FinContr=0">Сегодня нужно набрать по $overdue_now КП</a>
                     </div>
HTML;
}
if ($overdue_kp > 0) {
  // Если есть просроченные КП, то выводим блок
echo <<<HTML
                    <div class="admin_box admin_box_alarm" >
                    <a href="index.php?typeQuery=554&Responsible=$userName&KpCondition=&FinContr=0">Просроченных КП = $overdue_kp</a>
                  </div>
          
HTML;
}
// Если загружали Файл, то при успешной загрузке появится эта надпись
  if (!empty($_GET['fullload']))  {
       echo "Файлы был успешно загружены <br>";
    };
                
 if ($userType ==  1) {  // если админ
     echo <<<HTML
     <!-- выборка того, что продали -->
    
     <div class="admin_box" >
     <a href="select_what_your_sell.php" target="_blank">Выборка проданных КП  </a>
     </div>
     <div class="admin_box" >
     <a href="register.php" target="_blank">Ввод нового пользователя</a>
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

HTML;
}
echo "</div>";// закрывает блок AboutUser
?>