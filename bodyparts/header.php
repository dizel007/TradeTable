<?php
$pageName = "АНМАКС ОНЛАЙН";
if (isset($_GET["id"]) && ($_GET["id"]!="")) {
  $id = $_GET["id"];
  $sql = "SELECT * FROM `reestrkp` WHERE `id` = $id";
  $query = $mysqli->query($sql);
  $item = MakeArrayFromObj($query);
  $pageName =  "КП№".$item[0]['KpNumber']." от ".$item[0]['KpData'];
}
echo <<<HTML
<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>$pageName</title>
    <link rel = "stylesheet" href = "css/bootstrap/css/bootstrap-grid.css">
    <!-- <link rel = "stylesheet" href = "css/bootstrap/css/bootstrap.css"> -->
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">


    <link rel = "stylesheet" href = "css/for_all_class.css">
    <link rel = "stylesheet" href = "css/drawtable.css">
    <link rel = "stylesheet" href = "css/admin_panel.css">
    <link rel = "stylesheet" href = "css/info_company.css">
    <link rel = "stylesheet" href = "css/modal.css"> 
    <link rel = "stylesheet" href = "css/mobile.css">
    <link rel = "stylesheet" href = "css/phone_tab.css">
    <link rel = "stylesheet" href = "css/up_down_button.css">
    
    
    <script type="text/javascript" src="js/jquery/jquery-3.6.0.min.js"></script>
    <!-- скрипт для телефоной маски -->
    <script src="jquery-3.3.1.maskedinput.min.js" type="text/javascript"></script> 
 </head>

<body>
HTML;
?>  