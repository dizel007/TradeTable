<?php
// Файл показывает содержимое КП
// Основан на библиотеке 'simplexlsx.class.php' . ХЗ как она работает
// 
require_once 'simplexlsx.class.php';

$file_xlsx_name ="../". $_GET['LinkKp'];	

		if ( $xlsx = SimpleXLSX::parse($file_xlsx_name)) {

		echo '<h2>ТАБЛИЦА ЦЕН из КП</h2>';
		echo '<table border="1" cellpadding="3" style="border-collapse: collapse">';

		list( $cols, ) = $xlsx->dimension();
$str=0;
		foreach ( $xlsx->rows() as $k => $r ) {
					if ($k == 0) continue; // skip first row
				if ($str<13) {
					$str++;
					continue;
				}

			echo '<tr>';
			for ( $i = 3; $i < $cols; $i ++ ) {
				if (($i==4) or ($i==5) or ($i==6) or ($i==7) or ($i==9) or ($i > 12)) {continue;}
				echo '<td>' . ( ( isset( $r[ $i ] ) ) ? $r[ $i ] : '&nbsp;' ) . '</td>';
			}
			echo '</tr>';
			$str++;
		}
		echo '</table>';
	} else {
		echo SimpleXLSX::parse_error();
	}
;;