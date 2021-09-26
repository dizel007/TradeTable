<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel = "stylesheet" href="../css/bootstrap/css/bootstrap.css">
  <link rel = "stylesheet" href="../css/mailsend.css">

  <title>Форма для отправки письма клиенту</title>
</head>
<body>
  <div class="container">
    <div class="row">
<?php
 
require_once ("../connect_db.php"); // подключение к БД

if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) // Проверяем зарегистрирован ли пользователь
    {
        $sql = "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1";
        $query = $mysqli->query($sql);
        $userdata = mysqli_fetch_assoc($query);

        if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
        {
            setcookie("id", "", time() - 3600*26, "/");
            setcookie("hash", "", time() - 3600*26, "/", null, null, true); // httponly !!!
            header("Location: ../login.php"); exit();
        }
        else
        {
            $user_mail = $userdata['user_login'];
            $userType = $userdata['userType'];
            require_once ("msg_box.php"); // подлючаем файл, которые цепляет 
       }
    }
else
{

    header("Location: ../login.php"); exit();
}
?>