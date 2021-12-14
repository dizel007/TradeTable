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
               $arr_name[$i]['dateContract'] = $row["dateContract"];
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






function MakeArrayFromObjINN ($fQuery) {
 
  $i=0;
  // формируем массив с данными по КП 
  if ($fQuery -> num_rows > 0) {
         while ($row = $fQuery -> fetch_assoc()) 
         {
         for ($k=1; $k<11; $k++) 
               {
               $arr_inn[$i]['id'] = $row["id"];
               $arr_inn[$i]['pp'] = $row["pp"];
               $arr_inn[$i]['inn'] = $row["inn"];
               $arr_inn[$i]['name'] = $row["name"];
               $arr_inn[$i]['fullName'] = $row["fullName"];
               $arr_inn[$i]['telefon'] = $row["telefon"];
               $arr_inn[$i]['email'] = $row["email"];
               $arr_inn[$i]['adress'] = $row["adress"];
               $arr_inn[$i]['contactFace'] = $row["contactFace"];
               $arr_inn[$i]['comment'] = $row["comment"];
 
               }
          $i++;
       }
     }
if (isset($arr_inn)) {
            return $arr_inn;
      }else {
        $false_arr[] = 1;
        return $false_arr;
      }
     
}

/// Получаем массив из таблицы телефонов
function MakeArrayFromObjTelephone ($fQuery) {
 
  $i=0;
  // формируем массив с данными по КП 
  if ($fQuery -> num_rows > 0) {
         while ($row = $fQuery -> fetch_assoc()) 
         {
         for ($k=1; $k<11; $k++) 
               {
               $arr_phone[$i]['id_phone'] = $row["id"];
               $arr_phone[$i]['inn'] = $row["inn"];
               $arr_phone[$i]['telephone'] = $row["telephone"];
               $arr_phone[$i]['comment'] = $row["comment"];
               $arr_phone[$i]['whatsapp'] = $row["whatsapp"];
               $arr_phone[$i]['name'] = $row["name"];
               $arr_phone[$i]['old_phone'] = $row["old_phone"];
               $arr_phone[$i]['date_write'] = $row["date_write"];
               $arr_phone[$i]['actual'] = $row["actual"];
               $arr_phone[$i]['viber'] = $row["viber"];

                
               }
          $i++;
       }
     }
if (isset($arr_phone)) {
            return $arr_phone;
      }else {
        $false_arr[] = 1;
        return $false_arr;
      }
     
}

/// Получаем массив из таблицы телефонов
function MakeArrayFromObjEmail ($fQuery) {
 
  $i=0;
  // формируем массив с данными по КП 
  if ($fQuery -> num_rows > 0) {
         while ($row = $fQuery -> fetch_assoc()) 
         {
         for ($k=1; $k<11; $k++) 
               {
               $arr_emails[$i]['id_email'] = $row["id"];
               $arr_emails[$i]['inn'] = $row["inn"];
               $arr_emails[$i]['email'] = $row["email"];
               $arr_emails[$i]['comment'] = $row["comment"];
               $arr_emails[$i]['date_write'] = $row["date_write"];
               $arr_emails[$i]['actual'] = $row["actual"];

                
               }
          $i++;
       }
     }

if (isset($arr_emails)) {
            return $arr_emails;
      }else {
        $false_arr[] = 1;
        return $false_arr;
      }
     
}
?>