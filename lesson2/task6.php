<?php

// возведение в степень
function power($val, int $pow) {
	// ноль в любой степени ноль
	if ($val == 0) {
		return 0;
	}
	
	if ($pow == 0) {
		return 1;
	}
	
	if ($pow == 1) {
		return $val;
	}
	
	if ($pow > 1) {
		return $val * power($val,$pow-1);
	}
}

// подготовка к возведению в степень.
// степень может быть дробной и меньше нуля
// Особенность:
// если дробная чать степени 3 знака и более, и больше .221
// то не хватает памяти.
function getPower($val,$pow) {
	
	// ноль в степени ноль это неопределенность
	if ($val == 0 && $pow == 0) {
		return 'Неопределенность...';
	}
	
	// если степень отрицательная, запоминаем 
	// возводим в положительную, затем 1 делим на результат
	$negativPower = false;
	if ($pow < 0) {
		$pow = abs($pow);
		$negativPower = true;
	}
	
	// если степень дробная, считаем сколько разрядов после запятой
	// потом извлекаем корень 10 в степени count
	$count = 0;
	while ((int) $pow != $pow) {
		$pow = $pow * 10;
		$count++;
	}
	
	// возводим в степень
	$result = power($val,$pow);
	// извлекаем корень 10 в степени $count
	$result = exp(1/power(10,$count)*log($result));
	
	return ($negativPower ? 1/$result : $result);
}

// основная программа
$base = (float) readline('Введите основание: ');
$exp = (float) readline('Введите степень: ');

echo 'Результат данного примера: ' . getPower($base,$exp).PHP_EOL;

echo 'Результат стандартной функции php: ' . $base ** $exp .PHP_EOL;
