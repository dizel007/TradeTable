<?php
require_once ("functions/get_name_user.php");
require_once ("functions/get_condition_kp.php");
echo <<<HTML
             <div class = "aboutUser">
                  Пользователь :$user
                  (<a href="index.php?date_start=&date_end=&value=$userName&id=&typeQuery=10">$userName</a>)
             <br>
            </div>
HTML;
// }

// Если загружали Файл, то при успешной загрузке появится эта надпись
                 
 if ($userType ==  1) {  // если админ
     echo <<<HTML
     <!-- выборка того, что продали -->
     <div class = "aboutUser">
 
     <a href="reports.php" target="_blank">Аналитика</a>
 
     </div>
HTML;
}
?>