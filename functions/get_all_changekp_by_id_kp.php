<?php

function SelectAllChangeKPByUser ($arr,$mysqli) {
  $j=0;
  foreach ($arr as $value=>$key) {
    $id = $key;
    $sql = "SELECT * FROM `reestrkp` WHERE `id` = $id LIMIT 1";
    $query = $mysqli->query($sql);
    $arr_users_kp = MakeArrayFromObj($query);
    $arr_users_kp_change[] = $arr_users_kp;
    $j++;
  }
// уменьшаем уровень вложенности
  $outArray = call_user_func_array('array_merge', $arr_users_kp_change);

  return $outArray;
}

?>