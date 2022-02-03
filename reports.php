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
            $user = $userdata['user_login'];
            $userType = $userdata['userType'];
            
            require_once ("bodyparts/include_functions.php"); // подлючаем файл, которые цепляет все функции
            require_once ("reports/reports_header.php"); // header HTML
            require_once ("reports/reports_admin_panel.php"); // панель Администратора
            require_once ("reports/reports_top_part_page.php"); // шапка файила
            require_once ("reports/reports_table_sells.php"); // панель Администратора
            // require_once ("bodyparts/main_table.php"); // вывод главной таблицы

            // // require_once ("bodyparts/modal.php"); // всплывающие окна
            // require_once "bodyparts/modal_change_all.php";
            // require_once ("bodyparts/modal_change_inn.php"); // всплывающие окна
            require_once ("bodyparts/footer.php"); // подвал страниы
        }
    }
else
{

    header("Location: login.php"); exit();
}
?>