<?php
require_once ("functions/get_name_user.php");
require_once ("functions/get_condition_kp.php");
echo <<<HTML
             <div class = "aboutUser">
                  Пользователь :$user ($userName)
               <a class="btn btn-outline-primary btn-sm ms-5" href="reports.php" target="_blank">Аналитика</a>
            </div>
HTML;
                 

?>