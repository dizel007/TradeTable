<?php

require_once ("../bodyparts/header.php"); // header HTML
require_once ("../connect_db.php");
// mb_internal_encoding("UTF-8");  // не работает
$filename = "../myfile1.txt";
if (!file_exists($filename)) {
  echo "Файла для ввода КП в реестр НЕ существует";
  die();
} else {

          echo "СТАРТ ЗАГРУЗКИ ДАННЫХ в БАЗУ ДАННЫХ ............................. <br><br>";
          $handle = fopen ("../myfile1.txt", "r");

          $lines = file('../myfile1.txt');

          //$array = null;

          $i=0;
          if ($handle) {
              while (($buffer = fgets($handle)) !== false) {

                $buffer = substr($buffer, 0, -3);
          $sql = "INSERT INTO `reestrkp` (`pp`, `KpNumber`, `KpData`, `InnCustomer`, `NameCustomer`, `ContactCustomer`, `idKp`, `StatusKp`, `KpImportance`, `Responsible`, `Comment`, `DateNextCall`, `KpCondition`, `KpSum`, `TenderSum`, `FinishContract`, `LinkKp`, `adress`, `id`, `marker`, `konturLink`) VALUES $buffer";

          // echo "XXX(Zapros)===".$buffer."===(Zapros)XXX<br><br>";

          echo "<br>=".$i."========================================(SQL)===================================<br>".$sql.
          "<br>====================================================(SQL)====================================<br><br>";
                $query = $mysqli->query($sql);
                if (!$query){
                         echo "WE ARE DIE <br>";
                         die(mysqli_error($mysqli) );
                         printf("Соединение не удалось: ");
                  }
                  // else {
                  //       echo "WE DO IT MOTHER FUCKER <br>";
                  //       unset($lines[$i]);
                  //       $i++;
                  //       file_put_contents('../myFile1.txt', implode('', $lines));
                  // }
              }
          }
          fclose($handle);
          
          function insert_raw_in_bd ($buffer) {
            $buffer = substr($buffer, 0, -3);
            $sql = "\"INSERT INTO `reestrkp` (`pp`, `KpNumber`, `KpData`, `InnCustomer`, `NameCustomer`, `ContactCustomer`, `idKp`, `StatusKp`, `KpImportance`, `Responsible`, `Comment`, `DateNextCall`, `KpCondition`, `KpSum`, `TenderSum`, `FinishContract`, `LinkKp`, `adress`, `id`, `marker`, `konturLink`) VALUES ".  $buffer. "\"";
          // $query = $mysqli->query($sql);
            echo $sql."<br>";
            // $query = $mysqli->query($sql);
            // if (!$query){
            // die();
            // printf("Соединение не удалось: ");

          }




            echo "<br>ВСЕ ДАННЫЕ ВВЕДЕНЫ....... <br>";
            echo "<br>Файл с первичными данными удален <br>";
            unlink ("../myfile1.txt");
}
?>