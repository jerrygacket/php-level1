<?php

$var1 = (float) readline('Введите Первое число: ');
$var2 = (float) readline('Введите Второе число: ');

function sum ($a, $b) { // сложение
	return $a + $b;
}

function subtr ($a, $b) { // вычитание
	return $a - $b;
}

function div ($a, $b) { // деление
	return ($b == 0 ? 'Деление на ноль' : $a / $b);
}

function mult ($a, $b) { // умножение
	return $a * $b;
}

echo $var1.' + '.$var2 .' = '.sum($var1, $var2).PHP_EOL;
echo $var1.' - '.$var2 .' = '.subtr($var1, $var2).PHP_EOL;
echo $var1.' / '.$var2 .' = '.div($var1, $var2).PHP_EOL;
echo $var1.' * '.$var2 .' = '.mult($var1, $var2).PHP_EOL;
