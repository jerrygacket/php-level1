<?php

$var1 = (float) readline('Введите Первое число: ');
$var2 = (float) readline('Введите Второе число: ');
$operation = (string) readline('Введите операцию (+, -, *, /): ');

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

function mathOperation($arg1, $arg2, string $operation = '') {
	switch ($operation) {
		case '+':
			$result = sum($arg1, $arg2);
			break;
		case '-':
			$result = subtr($arg1, $arg2);
			break;
		case '/':
			$result = div($arg1, $arg2);
			break;
		case '*':
			$result = mult($arg1, $arg2);
			break;
		default:
			$result = 'неверная операция';
	}
	return $result;
}

$tmp = $var1.' '.$operation.' '.$var2 .' = ';
$operationResult = mathOperation($var1, $var2, $operation);

echo $tmp . $operationResult . PHP_EOL;

