<?php

//~ $tmp = strtotime('T0:22');

$hrs = (int) date('G');
//~ $hrs = (int) date('G',$tmp);
switch ($hrs % 10) {
	case 1:
		$hours = ($hrs > 10 && $hrs < 20 ? ' часов ' : ' час ');
		break;
	case 2;
	case 3:
		$hours = ($hrs > 10 && $hrs < 20 ? ' часов ' : ' часа ');
		break;
	default:
		$hours = ' часов ';
}

$mnts = (int) date('i');
//~ $mnts = (int) date('i',$tmp);
switch ($mnts % 10) {
	case 1:
		$minutes = ($mnts > 10 && $mnts < 20 ? ' минут' : ' минута');
		break;
	case 2;
	case 3;
	case 4:
		$minutes = ($mnts > 10 && $mnts < 20  ? ' минут' : ' минуты');
		break;
	default:
		$minutes = ' минут';
}

echo date('G'). $hours . (int) date('i') . $minutes . PHP_EOL;
//~ echo date('G',$tmp). $hours . (int) date('i',$tmp) . $minutes . PHP_EOL;
