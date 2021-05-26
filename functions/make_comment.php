<?php
function makeComment($my_id_arr, $user_login) {
 
  if (isset($_POST['text'])) 
  { 
    $newPerem = $_POST['text'] ; // цепляем дату внесения комметнария
    $newPerem =  trim ( $newPerem , $character_mask = " \t\n\r\0\x0B"); // убипаем все лишние пробелы и переносы
    if ($newPerem != $my_id_arr[0]['Comment']) { // Проверяем изменился ли коммень
      if ($newPerem !='')  $newPerem ="@!" . date('Y-m-d')."(".$user_login."): ". $newPerem; // цепляем дату внесения комметнария
    }
  }
return $newPerem;
}

?>