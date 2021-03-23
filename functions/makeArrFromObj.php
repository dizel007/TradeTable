<?php


function MakeArrayFromObj ($fQuery) {
 
  $i=0;
  // формируем массив с данными по КП 
  if ($fQuery -> num_rows > 0) {
         while ($row = $fQuery -> fetch_assoc()) 
         {
         //echo "ID: {$row["id"]}; Название: {$row["m_cat_name"]};<hr>";// вывод категорий
         for ($k=1; $k<21; $k++) 
               {
               $arr_name[$i]['pp'] = $row["pp"];
               $arr_name[$i]['KpNumber'] = $row["KpNumber"];
               $arr_name[$i]['KpData'] = $row["KpData"];
               $arr_name[$i]['InnCustomer'] = $row["InnCustomer"];
               $arr_name[$i]['NameCustomer'] = $row["NameCustomer"];
               $arr_name[$i]['ContactCustomer'] = $row["ContactCustomer"];
               $arr_name[$i]['idKp'] = $row["idKp"];
               $arr_name[$i]['StatusKp'] = $row["StatusKp"];
               $arr_name[$i]['KpImportance'] = $row["KpImportance"];
               $arr_name[$i]['Responsible'] = $row["Responsible"];
               $arr_name[$i]['Comment'] = $row["Comment"];
               $arr_name[$i]['DateNextCall'] = $row["DateNextCall"];
               $arr_name[$i]['KpCondition'] = $row["KpCondition"];
               $arr_name[$i]['KpSum'] = $row["KpSum"];
               $arr_name[$i]['TenderSum'] = $row["TenderSum"];
               $arr_name[$i]['FinishContract'] = $row["FinishContract"];
               $arr_name[$i]['LinkKp'] = $row["LinkKp"];
               $arr_name[$i]['Adress'] = $row["adress"];
               $arr_name[$i]['id'] = $row["id"];
               $arr_name[$i]['marker'] = $row["marker"];
               $arr_name[$i]['konturLink'] = $row["konturLink"];
 
               }
          $i++;
       }
     }
if (isset($arr_name)) {
            return $arr_name;
      }else {
        $false_arr[] = 1;
        return $false_arr;
      }
     
}

?>