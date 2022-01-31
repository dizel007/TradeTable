<div class="col-6 shadow-lg db-mail ">
<?php
if (count($arr_emails) > 0) { // смотрим чтобы емайл был не пустой
    echo "<h5>Email из Базы Данных: (Выберите один EMAIL , либо введите новый)</h5>";
            for ($i=0; $i<count($arr_emails); $i++) { 
                    $r_email=$arr_emails[$i]['email'];  
            echo "<input type=\"radio\" name=\"email_from_kp\" value=\"$r_email\">$r_email<Br>";
            } 
    } else {
        echo "<b class=\"text-danger\">В базе данных отсутствует EMAIL!!!</b><br>";
    
}
echo <<<HTML
<b>Новый EMAIL для отправки КП</b><br>  
<input type="email"  name="email_from_kp_new" value=""><Br>
HTML;
?>
</div>