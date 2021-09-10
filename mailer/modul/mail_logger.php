<?php

$fileMailLogName = date('Y-m-d'); // создаем имя фаила куда будем писать логи ... каждый день новый файил
      
      $file = "../logs/".$fileMailLogName."_mailsend_".".txt";
      $now_date = date('Y-m-d H:i:s');
// Форсурием переменную для записи в ЛОГфайл
      $temp_var = $now_date." Пользователь :".$user_mail." выслал КП на EMAIL: ".$email_from_kp." ID=".$id." Заказчик=".$Zakazchik;;
      $temp_var.=";\n";
      
      // Пишем содержимое в файл,
      // используя флаг FILE_APPEND для дописывания содержимого в конец файла
      // и флаг LOCK_EX для предотвращения записи данного файла кем-нибудь другим в данное время
      
      file_put_contents($file, $temp_var, FILE_APPEND | LOCK_EX); // Все логи подряд

?>