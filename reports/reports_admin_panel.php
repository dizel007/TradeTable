<?php
require_once ("functions/get_name_user.php");
require_once ("functions/get_condition_kp.php");
echo <<<HTML
             <div class = "aboutUser">
                  Пользователь :$user
                  ($userName)
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