<?php
	// header('Content-Type: application/vnd.ms-excel; charset=utf-8');
	// header("Content-Disposition: attachment;filename=".date("d-m-Y")."-export.xls");
	// header("Content-Transfer-Encoding: binary ");
  
require_once ("connect_DB.php"); // подключение к БД

if (isset($_COOKIE['id']) and isset($_COOKIE['hash']))
{

  $sql = "SELECT *,INET_NTOA(user_ip) AS user_ip FROM users WHERE user_id = '".intval($_COOKIE['id'])."' LIMIT 1";
  $query = $mysqli->query($sql);
  
    $userdata = mysqli_fetch_assoc($query);
// echo "НАШ МАССИВ <br>";
// 		foreach ($userdata as $key => $value) {

// 			echo " = ". $key. " : ".$value." ;<br>";

// 		}
// echo "COOKY HASH : ".$_COOKIE['hash']."<br>";
// echo "COOKY ID : ".$_COOKIE['id']."<br>";
// echo "REMOTE_ADDR : ".$_SERVER['REMOTE_ADDR']."<br>";


    if(($userdata['user_hash'] !== $_COOKIE['hash']) or ($userdata['user_id'] !== $_COOKIE['id'])
  //or (($userdata['user_ip'] !== $_SERVER['REMOTE_ADDR'])  and ($userdata['user_ip'] !== "0"))
      )
    {
        setcookie("id", "", time() - 3600*24*30*12, "/");
        setcookie("hash", "", time() - 3600*24*30*12, "/", null, null, true); // httponly !!!
        //print "Хм, что-то не получилось";
        header("Location: login.php"); exit();
    }
    else
    {

  
        
        
        print "Привет, ".$userdata['user_login'].". Всё работает!";
        
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