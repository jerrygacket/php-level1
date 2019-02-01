<?php

define ('EVEN_STR', ' – четное число'.PHP_EOL);
define ('ODD_STR', ' – нечетное число'.PHP_EOL);
define ('ZERO_STR', '0 – это ноль'.PHP_EOL);

$a = 0;

do {
	switch ($a%2) {
		case 0:			
			echo ($a == 0 ? ZERO_STR : $a.EVEN_STR);
			break;
		case 1:
			echo $a.ODD_STR;
	}
	$a++;
} while ($a <= 10);
