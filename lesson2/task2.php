<?php

//$a = 5;
$a = (int) readline('Введите число от 0 до 15: ');
switch ($a) {
	case 0:
		echo '0' . PHP_EOL;;
	case 1:
		echo '1' . PHP_EOL;
	case 2:
		echo '2' . PHP_EOL;
	case 3:
		echo '3' . PHP_EOL;
	case 4:
		echo '4' . PHP_EOL;
	case 5:
		echo '5' . PHP_EOL;
	case 6:
		echo '6' . PHP_EOL;
	case 7:
		echo '7' . PHP_EOL;
	case 8:
		echo '8' . PHP_EOL;
	case 9:
		echo '9' . PHP_EOL;
	case 10:
		echo '10' . PHP_EOL;
	case 11:
		echo '11' . PHP_EOL;
	case 12:
		echo '12' . PHP_EOL;
	case 13:
		echo '13' . PHP_EOL;
	case 14:
		echo '14' . PHP_EOL;
	case 15:
		echo '15' . PHP_EOL;
		break;
	default:
		echo 'Значение переменной вне диапазона [0..15]' . PHP_EOL;
}
