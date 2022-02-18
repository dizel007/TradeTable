<?php


//список месяцев с названиями для замены
// $_monthsList = array(".01." => "января", ".02." => "февраля", 
// ".03." => "марта", ".04." => "апреля", ".05." => "мая", ".06." => "июня", 
// ".07." => "июля", ".08." => "августа", ".09." => "сентября",
// ".10." => "октября", ".11." => "ноября", ".12." => "декабря");

$date_start1 = date("d.m.Y", strtotime($date_start));

// $date_start1 = DateTime::createFromFormat('Y-m-d', $date_start1)->format('d.m.Y');
// $_mD = DateTime::createFromFormat('d.m.Y', $date_start1)->format('.m.');
// $date_start1 = str_replace($_mD, " ".$_monthsList[$_mD]." ", $date_start1);

$date_end1 = date("d.m.Y", strtotime($date_end));
// $date_end1 = DateTime::createFromFormat('Y-m-d', $date_end1)->format('d.m.Y');
// $_mD = DateTime::createFromFormat('d.m.Y', $date_end1)->format('.m.');
// $date_end1 = str_replace($_mD, " ".$_monthsList[$_mD]." ", $date_end1);

?>