<?php
require_once ("connect_DB.php"); // подключение к БД
 
require_once ("bodyparts/Include_functions.php"); // подлючаем файл, которые цепляет все функции

require_once ("bodyparts/header.php"); // header HTML
require_once ("bodyparts/input_part_page.php"); // шапка файила
require_once ("bodyparts/main_table.php"); // вывод главной таблицы
require_once ("bodyparts/modal.php"); // всплывающие окна
//require_once ("changeDB/update_comment.php");

require_once ("bodyparts/footer.php"); // подвал страниы
?>