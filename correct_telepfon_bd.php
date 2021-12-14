<?php
require_once ("connect_db.php");
$sql = "SELECT * FROM `telephone`";
$query = $mysqli->query($sql);

$phone_new= "------------------";


if ($query -> num_rows > 0) {
       while ($row = $query -> fetch_assoc()) 
       {
      
            $id = $row["id"];
            $phone= $row["telephone"];
            $len_str= strlen($phone);
            $f_phone= substr($phone, 0 ,1);
            if ($f_phone == "8") {
              $phone_new = substr_replace($phone, "7",0,1);

              $sql1 = "UPDATE `telephone` SET  `telephone`= '$phone_new' WHERE `id`='$id'";
        
        $query1 = $mysqli->query($sql1);
            }
              echo "ID=".$id." --- ".$phone." --- ".$phone_new." --- ".$f_phone." --- ".$len_str."<br>"; 
             






              $phone_new= "----------------------";
     }
   }

echo "Sdfgs";


?>