<?php
// Страница регистрации нового пользователя

// Соединямся с БД
require_once ("connect_db.php");
//$link=mysqli_connect("localhost", "mysql_user", "mysql_password", "testtable");


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

        // Убераем лишние пробелы и делаем двойное хеширование
        $password = md5(md5(trim($_POST['password'])));

        $sql = "INSERT INTO users SET user_login='".$login."', user_password='".$password."'";
       
        //echo "***".$sql."**<br><br>";
        
               $query = $mysqli->query($sql);

               if (!$query){
                 echo "WE ARE DIE";
                die();
                printf("Соединение не удалось: ");
                }
                else {
                  echo "WE DO IT MOTHER FUCKER";
                }
            
    
       header("Location: login.php"); exit();
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
?>

<form method="POST">
Логин <input name="login" type="text" required><br>
Пароль <input name="password" type="password" required><br>
<input name="submit" type="submit" value="Зарегистрироваться">
</form>