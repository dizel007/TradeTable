<?php

// Страница авторизации

// Функция для генерации случайной строки
function generateCode($length=6) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
    $code = "";
    $clen = strlen($chars) - 1;
    while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0,$clen)];
    }
    return $code;
}

// Соединямся с БД
//$link=mysqli_connect("localhost", "mysql_user", "mysql_password", "testtable");
require_once ("connect_DB.php");

if(isset($_POST['submit']))
{
    // Вытаскиваем из БД запись, у которой логин равняеться введенному
    $sql = "SELECT user_id, user_password FROM users WHERE user_login='".mysqli_real_escape_string($mysqli,$_POST['login'])."' LIMIT 1";
    
    $query = $mysqli->query($sql);
    
    $data = mysqli_fetch_assoc($query);

    //  echo "<pre>";
    //  printf ($data);
    //  echo "</pre>";

    // Сравниваем пароли
    if($data['user_password'] === md5(md5($_POST['password'])))
    {
        // Генерируем случайное число и шифруем его
        $hash = md5(generateCode(10));

         // Записываем в БД новый хеш авторизации и IP
    $tempUserIP = $data['user_id'];
    $sql = "UPDATE users SET user_hash='$hash' WHERE user_id='$tempUserIP'";
    $query = $mysqli->query($sql);
          
          // Ставим куки
        setcookie("id", $data['user_id'], time()+60*60*24, "/");
        setcookie("hash", $hash, time()+60*60*24, "/", null, null, true); // httponly !!!
           
/// запись в логи, что пользователь зашел на сайт
            $file = 'log.txt';
            $now_date = date('Y-m-d H:i:s');
            /// Вычитываем пользователя
            require_once "connect_DB.php";
            $i=0;
            $sql = ("SELECT * FROM users WHERE user_hash = '$hash'");
            $user = $mysqli->query($sql);
            while ($row = $user -> fetch_assoc()) 
            {
                $user_login = $row["user_login"];
                $i++;
            }

            $temp_var = $now_date."  ". $user_login." вошел на сайт ;\n";
            // Пишем содержимое в файл,
            // используя флаг FILE_APPEND для дописывания содержимого в конец файла
            // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
            file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX);
        // Переадресовываем браузер на страницу проверки нашего скрипта
       
        header("Location: index.php"); exit();
    }
    else
    {
        print "Вы ввели неправильный логин/пароль";
    }
}
?>
<form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<!-- Не прикреплять к IP(не безопасно) <input type="checkbox" name="not_attach_ip"><br> -->
<input name="submit" type="submit" value="Войти">
</form>