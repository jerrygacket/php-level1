<?php
define ('PHP_TAB', "\t");

// меняем местами 2 числа
//$a = 5;
$a = readline('Введите Первое число: ');

//$b = 3;
$b = readline('Введите Второе число: ');

echo 'Ваши числа:'.PHP_TAB.$a.' | '.$b.PHP_EOL;

// меняем местами
$a = $a+$b;
$b = $a-$b;
$a = $a-$b;

echo 'Результат:'.PHP_TAB.$a.' | '.$b.PHP_EOL;
