<?php

if ($emails[0] <> "") { // смотрим чтобы емайл был не пустой
    echo "<h4>Email из Базы Данных: (Выберите один EMAIL , либо введите новый)</h4>";
            for ($i=0; $i<count($emails); $i++) {   
            echo "<input type=\"radio\" name=\"email_from_kp\" value=\"$emails[$i]\">$emails[$i]<Br>";
            } 
    } else {
        echo "<b>В базе данных отсутствует EMAIL!!!</b><br>";
    
}
echo <<<HTML
<b>Новый EMAIL для отправки КП</b>  <br>
<input type="email"  name="email_from_kp_new" value=""><Br>
<br>
HTML;

?>