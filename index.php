<?php
 
require_once ("connect_db.php"); // подключение к БД

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
      
            date_default_timezone_set('Europe/Moscow');
             // Ставим куки
             $hash= $_COOKIE['hash'];
             $user_id_cook = $_COOKIE['id'];
             setcookie("id", $user_id_cook, time() + 60 * 60 * 24, "/");
             setcookie("hash", $hash, time() + 60 * 60 * 24, "/", null, null, true); // httponly !!!
            
            $user = $userdata['user_login'];
            $userType = $userdata['userType'];
            
            require_once ("bodyparts/include_functions.php"); // подлючаем файл, которые цепляет все функции
            require_once ("bodyparts/header.php"); // header HTML
            require_once ("bodyparts/admin_panel.php"); // панель Администратора
            require_once ("bodyparts/input_part_page_new.php"); // шапка файила

            // require_once ("bodyparts/input_part_page.php"); // шапка файила
            require_once ("bodyparts/main_table.php"); // вывод главной таблицы
            require_once ("bodyparts/up_down_button.php"); // вывод кнопки вверх - вниз 


            // require_once ("bodyparts/modal.php"); // всплывающие окна
            require_once "bodyparts/modal_change_all.php";
            require_once ("bodyparts/modal_change_inn.php"); // всплывающие окна
            require_once ("bodyparts/footer.php"); // подвал страниы
        }
    }
else
{

    header("Location: login.php"); exit();
}
?>