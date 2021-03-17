<?php
setcookie("id", "", time() - 3600*24*30*12, "/");
setcookie("hash", "", time() - 3600*24*30*12, "/",null,null,true); // httponly !!!
// Переадресовываем браузер на страницу проверки нашего скрипта

echo '<button id="button-list" onclick="window.location=\'login.php\'" class="button-on-form">Войти</button>';


?>
