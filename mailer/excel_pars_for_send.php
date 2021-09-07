<?php
// Файл показывает содержимое КП
// Основан на библиотеке 'simplexlsx.class.php' . ХЗ как она работает
// 
require_once '../open_excel/simplexlsx.class.php';

$file_xlsx_name = "../".$arr_kp[0]['LinkKp'];	

		if ( $xlsx = SimpleXLSX::parse($file_xlsx_name)) {

			$str=0; // переменная для отчитывание количества строк от начала ексель фаилы
			$stop=0;  // переменная чтобы отсечь все после таблицы

			foreach ( $xlsx->rows() as $k => $r ) {
				if ($k == 0) continue; // skip first row
				if ($str==3) {$kp_name  = $r[6];}

				if ($str==5) {$Zakazchik = $r[9];}
				// if ($str==7) {$Phone = $r[9];}
				if ($str==8) {$Email = $r[9];}

			  if ($str==12) {$ZakupName  = $r[2];}
			  if ($str<13) { $str++; continue;} // пропускаем все что выше таблицы
			  if (empty($r[2])) {$stop++;} // находим конец таблицы с ценам и обрезаем после полной цены
			 $str++; // переменная чтобы найти строку начала таблциы
		 }
		 $ZakupName = substr($ZakupName, 132, -64); // Остается наименование закупки
// Echo <<<HTML
// 		 <b>Заказчик : $Zakazchik </b> <br>
// 		 <br>
// 		 Эл. почта в КП :<br>$Email<br>
// 		 <br>
// 		 $ZakupName<br>
// 		 <br>
// HTML;
	} else {
		echo SimpleXLSX::parse_error();
	}
?>