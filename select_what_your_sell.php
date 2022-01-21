
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
           $user = $userdata['user_login'];
           $userType = $userdata['userType'];
             
           require_once ("bodyparts/header.php"); // header HTML
       //  require_once ("connect_db.php");
           require_once ("functions/select_from_db.php");
           require_once ("functions/make_arr_from_obj.php");
           require_once ("functions/print_our_table.php");
             
            $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
            $KpCondition ="Купили у нас";
            $arr_name = selectArrByKpCondition($mysqli, $KpCondition);
                 
            echo "КП которые купили у нас :";
            $prodano_do_2022 = 36278280 - 51600; // Продано до 01.01.2022
            $summa =0  - $prodano_do_2022; // 
             // Высчитываем сумму проданных КП
               foreach ($arr_name as $key => $value) {
                 foreach ($value as $key1 => $value1) {
                   if ($key1 == 'KpSum') {
                     $summa = $summa + $value1;
                   }
                 }
               }
              echo " СУММА = ". number_format($summa)."<br>";
              printOurTable($arr_name, $FinishContract,0,10000);
        require_once ("bodyparts/footer.php"); // подвал страниы
      }
     }
 else
 {
      header("Location: login.php"); exit();
 }
 ?>


