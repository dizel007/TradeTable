<?php
function makeComment($my_id_arr, $user_login) {
 
  if (isset($_POST['text'])) 
  { 
    $newPerem = $_POST['text'] ; // цепляем дату внесения комметнария
    $newPerem =  trim ( $newPerem , $character_mask = " \t\n\r\0\x0B"); // убипаем все лишние пробелы и переносы
    
    if ($newPerem !='')  {
      
      $dateForComment = date('Y-m-d')."(".$user_login."): ";
      $oldPerem = str_replace("@!".$dateForComment, '' ,$my_id_arr[0]['Comment'] ); // удаляем 
      $newPerem ="@!" . $dateForComment. $newPerem."++ ".$oldPerem; // цепляем дату внесения комметнария
    } else {
      $newPerem = $my_id_arr[0]['Comment'];
    }
   }
return $newPerem;
}

?>