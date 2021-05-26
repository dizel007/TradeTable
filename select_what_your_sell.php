<?php 
require_once ("bodyparts/header.php"); // header HTML


require_once ("connect_db.php");
require_once ("functions/select_from_db.php");
require_once ("functions/make_arr_from_obj.php");
require_once ("functions/print_our_table.php");

  $FinishContract = 1 ; // всегда показываем СКРЫТЫЕ привязанные закупки
  $KpCondition ="Купили у нас";
  $arr_name = selectArrByKpCondition($mysqli, $KpCondition);
    
  echo "КП которые купили у нас :";
  
 printOurTable($arr_name, $FinishContract);
//////// сюда же добавим компании с этим же инн


require_once ("bodyparts/footer.php"); // подвал страниы
?>