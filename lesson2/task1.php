<?php

//$a = 5;
$a = (int) readline('Введите Первое число: ');
//$b = 3;
$b = (int) readline('Введите Второе число: ');

if ($a >= 0 && $b >= 0) {
	$result = $a - $b;
} elseif ($a < 0 && $b < 0) {
	$result = $a * $b;
} else {
	$result = $a + $b;
}

echo $result.PHP_EOL;
