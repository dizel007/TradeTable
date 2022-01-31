<?php
require_once ("functions/get_name_user.php");
require_once ("functions/get_condition_kp.php");
echo <<<HTML
             <div class = "aboutUser">
                  Пользователь :$user
                  (<a href="?date_start=&date_end=&value=$userName&id=&typeQuery=10">$userName</a>)
             <br>
            </div>
HTML;
// }

// Если загружали Файл, то при успешной загрузке появится эта надпись
                 
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
     </div>
HTML;
}
?>