<?php

if ($emails[0] <> "") { // смотрим чтобы емайл был не пустой
    echo "Email из Базы Данных:<br>";
    for ($i=0; $i<count($emails); $i++) {   
    echo "<input type=\"radio\" name=\"email_from_kp\" value=\"$emails[$i]\">$emails[$i]<Br>";
    }
}
echo "<br> Новый Email:";
echo "<input type=\"email\" name=\"email_from_kp\" value=\"\"><br>";

?>