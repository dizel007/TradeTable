<?php
require_once "../connect_db.php";
require_once "../functions/make_arr_from_obj.php";

 $id = $_GET['id'];
 $Our_comment ="";

 $sql = "SELECT * FROM reestrkp where id='$id'";
 $fQuery = $mysqli->query($sql);
 $arr_name = makeArrayFromObj($fQuery) ;
 
  foreach ($arr_name as $key => $value) {
    foreach ($value as $key1 => $value1) {
        if ($key1 == 'Comment') {
            $Our_comment = $value1;
         }
      }
   }

  
  echo "
      <div class=\"dm-overlay\" id=\"win1\">
          <div class=\"dm-table\">
              <div class=\"dm-cell\">
                  <div class=\"dm-modal\">
                      <a href=\"#close\" class=\"close\"></a>
                      <p>Текстовое содержание : ".$Our_comment."</p>
                      
                  <form  action=\"changeDB/update_comment.php?id=";
                  
                        if (isset($id)) echo $id; // добавляем ID  - редактируемой строки
                        echo ("&typeQuery=11");
                        echo "\" method=\"post\">
                            <p>
                              <p>Добавить комментарий : </p>
                                <p>
                                  <textarea name=\"text\" rows=\"10\" cols=\"45\">".$Our_comment.

                                 "</textarea>
                                </p>
                              <p><input type=\"submit\" value=\"Отправить\"></p>
                            </p>
                     </form>
                  </div>
              </div>
          </div>
      </div>";
  

//  $sql = "SELECT * FROM reestrkp where id='$id'";
//  $fQuery = $mysqli->query($sql);
//  $arr_name = makeArrayFromObj($fQuery) ;
 
//   foreach ($arr_name as $key => $value) {
//     foreach ($value as $key1 => $value1) {
//         if ($key1 == 'marker') {
//             $marker = $value1;
//          }
//       }
//    }

// if ($marker == 0 ) {
//   $marker=1;}
//   else {
//     $marker = 0;
//   }

// $sql = "UPDATE reestrkp SET marker = '$marker' WHERE id = '$id'";
// $fQuery = $mysqli->query($sql);



// $sql = "SELECT * FROM users WHERE user_hash = '$_COOKIE[hash]'";
// $user = $mysqli->query($sql);
// while ($row = $user -> fetch_assoc()) 
// {
//        $user_login = $row["user_login"];
//    }
// echo $marker;
