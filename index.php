<?php
 
require_once ("connect_DB.php"); // подключение к БД

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
    {

        $sql = "SELECT * FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1";
        $query = $mysqli->query($sql);
        
            $userdata = mysqli_fetch_assoc($query);


        if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])

        )
        {
            setcookie("id", "", time() - 3600*26, "/");
            setcookie("hash", "", time() - 3600*26, "/", null, null, true); // httponly !!!
            //print "Хм, что-то не получилось";
            header("Location: login.php"); exit();
        }
        else
        {

    
            
            
            print "Пользователь: ".$userdata['user_login'];
            
                            require_once ("bodyparts/Include_functions.php"); // подлючаем файл, которые цепляет все функции
                            require_once ("bodyparts/header.php"); // header HTML
                            require_once ("bodyparts/input_part_page.php"); // шапка файила
                            require_once ("bodyparts/main_table.php"); // вывод главной таблицы
                            require_once ("bodyparts/modal.php"); // всплывающие окна
                            //require_once ("changeDB/update_comment.php");

                            require_once ("bodyparts/footer.php"); // подвал страниы
        }
    }
else
{
   // print "Включите куки";
    header("Location: login.php"); exit();
}
?>