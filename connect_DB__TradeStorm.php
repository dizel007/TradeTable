<?php
    
      $host="https://tradestorm.ru/";//имя  сервера
      $user="u17823";//имя пользователя
      $password="nabif2huves";//пароль
      $db="u17823_anmakskp";//имя  базы данных
      // подключаемся к БД
      //$my_sqli= new mysqli;
      //$my_sqli->query("GRANT ALL PRIVILEGES ON '$db'.* TO '$user'@% IDENTIFIED BY '$password'");
     
      $mysqli = new mysqli ($host, $user, $password, $db) or die("No Connection"); //подключение к серверу
      $mysqli->query("SET NAMES 'utf8'");
      
      if ($mysqli -> connect_error) {
        printf("Соединение не удалось: %s\n", $mysqli -> connect_error);
        exit();
      }
      
?>
