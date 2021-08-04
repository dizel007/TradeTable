<?php
// Файл показывает содержимое КП
// Основан на библиотеке 'simplexlsx.class.php' . ХЗ как она работает
// 
require_once 'simplexlsx.class.php';

$file_xlsx_name ="../". $_GET['LinkKp'];	

		if ( $xlsx = SimpleXLSX::parse($file_xlsx_name)) {

			$str=0; // переменная для отчитывание количества строк от начала ексель фаилы
			$stop=0;  // переменная чтобы отсечь все после таблицы

			foreach ( $xlsx->rows() as $k => $r ) {
				if ($k == 0) continue; // skip first row
				if ($str==3) {$kp_name  = $r[6];}

				if ($str==5) {$Zakazchik = $r[9];}
				if ($str==7) {$Phone = $r[9];}
				if ($str==8) {$Email = $r[9];}

			  if ($str==12) {$ZakupName  = $r[2];}
			  if ($str<13) { $str++; continue;} // пропускаем все что выше таблицы
			  if (empty($r[2])) {$stop++;} // находим конец таблицы с ценам и обрезаем после полной цены
 
			   if ($stop == 5) {$oplata = $r[3]." ".$r[5];} // условия оплаты
				 if ($stop == 6) {$makeTime = $r[3]." ".$r[5];} // срок изготовления
				 if ($stop == 7) {$Dostavka = $r[3]." ".$r[5]."=".$r[12];} // условия отгузки
			 $str++; // переменная чтобы найти строку начала таблциы
		 }


		 echo "<b>Заказчик :".$Zakazchik;"</b><br>";
		 echo "<br><br>";
		 echo "<b>Телефон :".$Phone;"</b><br>";
		 echo "<br>";
		 echo "<b>Эл. почта :".$Email;"</b><br>";
		 echo "<br><br>";

		 $ZakupName = substr($ZakupName, 132, -64);
		 echo "<b>".$ZakupName;"</b><br>";
		 echo "<br>";
		 echo "<br><b>".$kp_name;"</b><br>";
		 
		 echo "<br><br>";

		echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

		list( $cols, ) = $xlsx->dimension();
$str=0; // переменная для отчитывание количества строк от начала ексель фаилы
$stop=0;  // переменная чтобы отсечь все после таблицы
		foreach ( $xlsx->rows() as $k => $r ) {
			 if ($k == 0) continue; // skip first row
	
			 if ($str<13) { $str++; continue;} // пропускаем все что выше таблицы
			 if (empty($r[2])) {$stop++;} // находим конец таблицы с ценам и обрезаем после полной цены

			echo '<tr>';
	
		
			for ( $i = 2; $i < $cols; $i ++ ) {
				
				if (($i==4) or ($i==5) or ($i==6) or ($i==7) or ($i==9) or ($i > 12)) {continue;} // Убираем лишние столбцы
				if ($stop == 1) {$r[11] = "ИТОГО :";}  
				if ($stop == 2) {$r[11] = "НДС20% :";}  
				
					echo '<td>' . ( ( isset( $r[ $i ] ) ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
			}
			echo '</tr>';
			
		  if ($stop==2) {break;}

			$str++; // переменная чтобы найти строку начала таблциы
		}
		echo '</table>';
	
	} else {
		echo SimpleXLSX::parse_error();
	}

	echo "<br><b>".$oplata."</b><br>";
	echo "<b>".$makeTime."</b><br>";
	echo "<b>".$Dostavka."</b><br>";
;;