<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 09.02.19
 * Time: 11:14
 */
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

function calculateForm() {
    $var1 = (float) $_POST['var1'] ?? 0;
    $var2 = (float) $_POST['var2'] ?? 0;
    $action = ($_POST['action'] ?? '');
    $result = mathOperation($var1, $var2, $action);

    return $var1 . ' ' . $action .  ' '  . $var2  . ' = ' . $result.PHP_EOL;
}