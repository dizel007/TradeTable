<?php
// require_once "../connect_DB";
require_once ("../bodyparts/header.php"); // header HTML
require_once ("../connect_DB.php");
// mb_internal_encoding("UTF-8");  // не работает
echo "СТАРТ ЗАГРУЗКИ ДАННЫХ в БАЗУ ДАННЫХ ............................. <br><br>";
$handle = fopen ("../myFile1.txt", "r");

$lines = file('../myFile1.txt');

//$array = null;


$i=0;
if ($handle) {
    while (($buffer = fgets($handle)) !== false) {

      $buffer = substr($buffer, 0, -3);
$sql = "INSERT INTO `reestrkp` (`pp`, `KpNumber`, `KpData`, `InnCustomer`, `NameCustomer`, `ContactCustomer`, `idKp`, `StatusKp`, `KpImportance`, `Responsible`, `Comment`, `DateNextCall`, `KpCondition`, `KpSum`, `TenderSum`, `FinishContract`, `LinkKp`, `adress`, `id`) VALUES $buffer";

echo "XXX(Zapros)===".$buffer."===(Zapros)XXX<br><br>";

echo "ZZZ(SQL)===".$sql."==(SQL)ZZZ<br><br>";

       $query = $mysqli->query($sql);
       if (!$query){
         echo "WE ARE DIE";
        die();
        printf("Соединение не удалось: ");
        }
        else {
          echo "WE DO IT MOTHER FUCKER <br>";
          unset($lines[$i]);
          $i++;
          file_put_contents('../myFile1.txt', implode('', $lines));
        }
    }
}
fclose($handle);
 
// echo "<pre>"; print_r($array)."<br>"; echo "</pre>";




  // if ($handle) {
  //   while (($buffer = fgets($handle, 4096)) !== false) {
  //     echo $buffer;
  //     insert_raw_in_bd ($buffer);
  //   }
  //   if (!feof($handle)) {
  //     echo "ERROR. ALARM BLAYYYYYYYYYYYYYYYYYY";
  //   }
  //   fclose($handle);
  // }

function insert_raw_in_bd ($buffer) {
  $buffer = substr($buffer, 0, -3);
  $sql = "\"INSERT INTO `reestrkp` (`pp`, `KpNumber`, `KpData`, `InnCustomer`, `NameCustomer`, `ContactCustomer`, `idKp`, `StatusKp`, `KpImportance`, `Responsible`, `Comment`, `DateNextCall`, `KpCondition`, `KpSum`, `TenderSum`, `FinishContract`, `LinkKp`, `adress`, `id`) VALUES ".  $buffer. "\"";
 // $query = $mysqli->query($sql);
  echo $sql."<br>";



  // $query = $mysqli->query($sql);
  
  // if (!$query){
  // die();
  // printf("Соединение не удалось: ");

}




  echo "<br>ВСЕ ДАННЫЕ ВВЕДЕНЫ....... <br>";
  echo "<br>Файл с первичными данными удален <br>";
  unlink ("../myFile1.txt");
?>