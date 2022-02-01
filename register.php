<?php
// Страница регистрации нового пользователя

// Соединямся с БД
require_once ("connect_db.php");
// Проверяем, чтбоы был зарегистрированный пользователь
if (isset($_COOKIE['id']) and isset($_COOKIE['hash'])) // Проверяем зарегистрирован ли пользователь
    {
        $sql = "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1";
        $query = $mysqli->query($sql);
        $userdata = mysqli_fetch_assoc($query);

        if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id']))
        {
            setcookie("id", "", time() - 3600*26, "/");
            setcookie("hash", "", time() - 3600*26, "/", null, null, true); // httponly !!!
            header("Location: login.php"); exit();
        }
        else
        {
            $user = $userdata['user_login'];
            $userType = $userdata['userType'];
            if(isset($_POST['submit']))
{

    $err = [];
    // проверям логин
    if(!preg_match("/^[a-zA-Z0-9]+$/",$_POST['login']))
    {
        $err[] = "Логин может состоять только из букв английского алфавита и цифр";
    }
    
    if(strlen($_POST['login']) < 3 or strlen($_POST['login']) > 30)
      {
          $err[] = "Логин должен быть не меньше 3-х символов и не больше 30";
      }

    // проверяем, не сущестует ли пользователя с таким именем

    $EnterUserLogin = $_POST['login'];
    $sql = "SELECT * FROM users WHERE user_login='$EnterUserLogin'";
    $query = $mysqli->query($sql);
        $UsersCount=0;
     // формируем массив с данными по КП 
     if ($query -> num_rows > 0) {
            while ($row = $query -> fetch_assoc()) 
            {
               // $arr[$i] = $row['user_login'];
                $UsersCount++;
            }
        }

        if( $UsersCount > 0)
        {
            $err[] = "Пользователь с таким логином уже существует в базе данных";
        }

    // Если нет ошибок, то добавляем в БД нового пользователя
    if(count($err) == 0)
    {

        $login = $_POST['login'];
        $username = $_POST['user_name'];

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));

        $sql = "INSERT INTO users SET 
                user_login='".$login."',
                user_password='".$password."',
                user_active=1,
                user_name='".$username."'";
       echo "<br>---".$sql."<br>---";
    
        
               $query = $mysqli->query($sql);

               if (!$query){
                 echo "WE ARE DIE22";
                die();
                printf("Соединение не удалось: ");
                }
                // else {
                //   echo "WE DO IT MOTHER FUCKER";
                // }
            
    
       header("Location: index.php"); exit();
    }
    else
    {
        print "<b>При регистрации произошли следующие ошибки:</b><br>";
        foreach($err AS $error)
        {
            print $error."<br>";
        }
    }
}







        }
    }
else
{

    header("Location: login.php"); exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="css/login.css">

    <!-- <title>Инициализация польззователя</title> -->
</head>

<body>
    <div class="container">
        <div class="row">



    <div class="col-3 w-30 mx-auto shadow-lg loginform">
        <form method="POST">
            <br>
            <label for="exampleFormControlInput1" class="form-label">Логин</label>
            <input class="form-control"  name="login" type="text" required>
            
            <label for="exampleFormControlInput1" class="form-label">Фамилия</label>
            <input class="form-control"  name="user_name" type="text" required>

            <label for="exampleFormControlInput1" class="form-label">Пароль</label>
            <input class="form-control"  name="password" type="password" required>
            <br>
            <div class = "center">
               <input class="btn btn-outline-primary" name="submit" type="submit" value="Зарегистрировать">
            </div>
            

        </form>
    </div>

    </div>
    </div>

</body>
</html>